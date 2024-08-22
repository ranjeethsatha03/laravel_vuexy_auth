<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Http;

class PaymentGatewayController extends Controller
{
    public function paypal(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypalsuccess'),
                "cancel_url" => route('paypalcancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->price
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] !== null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    session()->put('product_name', $request->product_name);
                    session()->put('quantity', $request->quantity);
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('paypalcancel');
        }
    }

    public function paypalsuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $payment = new Payment;
            $payment->payment_id = $response['id'];
            $payment->product_name = session()->get('product_name');
            $payment->quantity = session()->get('quantity');
            $payment->amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $payment->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code']; // Fixed typo here
            $payment->payer_name = $response['payer']['name']['given_name'];
            $payment->payer_email = $response['payer']['email_address'];
            $payment->payment_status = $response['status'];
            $payment->payment_method = "PayPal";
            $payment->save();

            session()->forget('product_name');
            session()->forget('quantity');

            return redirect()->route('paypalsuccess')->with('success', 'Payment was successful!');
        } else {
            return redirect()->route('paypalcancel');
        }
    }

    public function paypalcancel()
    {
        return "Payment was Cancelled";
    }

    public function razorpay(Request $request)
    {
        if (isset($request->razorpay_payment_id) && ($request->razorpay_payment_id != '')) {
            $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
            $payment = $api->payment->fetch($request->razorpay_payment_id);
            $response = $payment->capture(['amount' => $payment->amount]);

            $payment = new Payment();
            $payment->payment_id = $response['id'];
            $payment->product_name = $response['notes']['product_name'];
            $payment->quantity = $response['notes']['quantity'];
            $payment->amount = $response['amount'] / 100;
            $payment->currency = $response['currency'];
            $payment->customer_name = $response['notes']['customer_name'];
            $payment->customer_email = $response['notes']['customer_email'];
            $payment->payment_status = $response['status'];
            $payment->payment_method = 'Razorpay';
            $payment->save();

            return redirect()->route('razorpaysuccess');
        } else {
            return redirect()->route('razorpaycancel');
        }
    }

    public function razorpaysuccess()
    {
        return "Payment was Successful";
    }

    public function razorpaycancel()
    {
        return "Payment was Cancelled";
    }

    public function stripe(Request $request)
    {

        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
        $response = $stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $request->product_name,
                        ],
                        'unit_amount' => $request->price * 100,
                    ],
                    'quantity' => $request->quantity,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('stripesuccess') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripecancel'),
        ]);
        if (isset($response->id) && $response->id != '') {
            session()->put('product_name', $request->product_name);
            session()->put('quantity', $request->quantity);
            session()->put('price', $request->price);
            return redirect($response->url);
        } else {
            return redirect()->route('stripecancel');
        }
    }

    public function stripesuccess(Request $request)
    {
        if (isset($request->session_id)) {
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);

            $payment = new Payment();
            $payment->payment_id = $response->id;
            $payment->product_name = session()->get('product_name');
            $payment->quantity = session()->get('quantity');
            $payment->amount = session()->get('price');
            $payment->currency = $response->currency;
            $payment->customer_name = $response->customer_details->name;
            $payment->customer_email = $response->customer_details->email;
            $payment->payment_status = $response->status;
            $payment->payment_method = 'Stripe';
            $payment->save();


            return "Payment was Successful";

            session()->forget('product_name');
            session()->forget('quantity');
            session()->forget('price');
        } else {
            return redirect()->route('stripecancel');
        }
    }

    public function stripecancel()
    {
        return "Payment was Cancelled";
    }

    public function phonepe(Request $request)
    {
        $baseUrl = config('phonepe.base_url');
        $merchantId = config('phonepe.merchant_id');
        $merchantKey = config('phonepe.merchant_key');
        $saltKey = config('phonepe.salt_key');

        $orderId = uniqid(); // Generate a unique order ID
        $amount = $request->price * 100; // Amount in paise (assuming INR currency)

        $data = [
            'merchantId' => $merchantId,
            'transactionId' => $orderId,
            'amount' => $amount,
            'merchantOrderId' => $orderId,
            'redirectUrl' => route('phonepesuccess'),
        ];

        $checksum = hash_hmac('sha256', json_encode($data), $saltKey);

        $response = Http::withHeaders([
            'X-VERIFY' => $checksum . '###' . $saltKey,
            'Content-Type' => 'application/json',
        ])->post($baseUrl . '/v3/transaction/initiate', $data);

        $responseBody = $response->json();

        if (isset($responseBody['success']) && $responseBody['success'] == true) {
            $paymentUrl = $responseBody['data']['instrumentResponse']['redirectUrl'];
            session()->put('product_name', $request->product_name);
            session()->put('quantity', $request->quantity);
            return redirect()->away($paymentUrl);
        } else {
            return redirect()->route('phonepecancel')->with('error', 'Payment initiation failed.');
        }
    }

    public function phonepesuccess(Request $request)
    {
        $response = $request->all();

        if ($response['code'] == 'PAYMENT_SUCCESS') {
            $payment = new Payment();
            $payment->payment_id = $response['transactionId'];
            $payment->product_name = session()->get('product_name');
            $payment->quantity = session()->get('quantity');
            $payment->amount = $response['amount'] / 100; // Convert back to INR
            $payment->currency = 'INR';
            $payment->customer_name = $response['payerName'];
            $payment->customer_email = $response['payerEmail'];
            $payment->payment_status = 'Completed';
            $payment->payment_method = 'PhonePe';
            $payment->save();

            session()->forget('product_name');
            session()->forget('quantity');

            return redirect()->route('phonepesuccess')->with('success', 'Payment was successful!');
        } else {
            return redirect()->route('phonepecancel');
        }
    }

    public function phonepecancel()
    {
        return "Payment was Cancelled";
    }

    public function icici(Request $request)
    {
        $baseUrl = config('icici.base_url');
        $merchantId = config('icici.merchant_id');
        $merchantKey = config('icici.merchant_key');

        $orderId = uniqid(); // Generate a unique order ID
        $amount = $request->price * 100; // Amount in paise (assuming INR currency)

        $data = [
            'merchantId' => $merchantId,
            'orderId' => $orderId,
            'amount' => $amount,
            'currency' => 'INR',
            'returnUrl' => route('icicisuccess'),
            'cancelUrl' => route('icicicancel'),
            // Add other required fields as per ICICI API
        ];

        $checksum = hash_hmac('sha256', json_encode($data), $merchantKey);

        $response = Http::withHeaders([
            'X-VERIFY' => $checksum . '###' . $merchantKey,
            'Content-Type' => 'application/json',
        ])->post($baseUrl . '/payment/initiate', $data);

        $responseBody = $response->json();

        if (isset($responseBody['success']) && $responseBody['success'] == true) {
            $paymentUrl = $responseBody['paymentUrl'];
            session()->put('product_name', $request->product_name);
            session()->put('quantity', $request->quantity);
            return redirect()->away($paymentUrl);
        } else {
            return redirect()->route('icicicancel')->with('error', 'Payment initiation failed.');
        }
    }

    public function icicisuccess(Request $request)
    {
        $response = $request->all();

        if ($response['status'] == 'success') {
            $payment = new Payment();
            $payment->payment_id = $response['transactionId'];
            $payment->product_name = session()->get('product_name');
            $payment->quantity = session()->get('quantity');
            $payment->amount = $response['amount'] / 100; // Convert back to INR
            $payment->currency = 'INR';
            $payment->customer_name = $response['customerName'];
            $payment->customer_email = $response['customerEmail'];
            $payment->payment_status = 'Completed';
            $payment->payment_method = 'ICICI';
            $payment->save();

            session()->forget('product_name');
            session()->forget('quantity');

            return redirect()->route('icicisuccess')->with('success', 'Payment was successful!');
        } else {
            return redirect()->route('icicicancel');
        }
    }

    public function icicicancel()
    {
        return "Payment was Cancelled";
    }
}
