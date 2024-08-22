<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\PaymentSetting;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = DB::table('settings')->get()->keyBy('key');
        $settings = $settings->mapWithKeys(function ($item) {
            return [$item->key => $item->value];
        });

        $countries = DB::table('countries')->get();
        $paymentSettings = PaymentSetting::all();

        return view('settings.index', [
            'settings' => $settings,
            'countries' => $countries,
            'paymentSettings' => $paymentSettings
        ]);
    }

    public function update(Request $request)
    {
        $settings = $request->except('_token');
        if ($request->hasFile('system_logo')) {
            $file = $request->file('system_logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $settings['system_logo'] = $filename;
        }
        foreach ($settings as $key => $value) {
            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $value]
            );
        }
        return response()->json(['success' => true, 'message' => 'Settings Updated Successfully.']);
    }

    public function updatePaymentSettings(Request $request)
    {
        $data = $request->all();
        foreach ($data as $key => $value) {
            DB::table('payment_settings')->updateOrInsert(
                ['id' => $key],
                $value
            );
        }

        return response()->json(['success' => true, 'message' => 'Payment Settings Updated Successfully.']);
    }

    public function create()
    {
        return view('settings.create');
    }

    public function storePaymentGateway(Request $request)
    {
        $validated = $request->validate([
            'type_of_payment' => 'required|string',
            'nickname' => 'required|string',
            'notes' => 'nullable|string',
            'logo' => 'nullable|file|image',
            'status' => 'required|string',
            'payment_mode' => 'required|string',
            'client_id' => 'required|string',
            'client_secret_key' => 'required|string',
        ]);
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos');
            $validated['logo'] = $logoPath;
        }
        PaymentSetting::create($validated);
        return redirect()->route('settings.index')->with('status', 'Payment Gateway added successfully.');
    }


    public function editPaymentGateway($id)
    {
        $paymentGateway = PaymentSetting::find($id);
        if (!$paymentGateway) {
            return redirect()->route('settings.index')->with('status', 'Payment Gateway not found.');
        }
        return view('settings.edit', ['paymentGateway' => $paymentGateway]);
    }

    public function updatePaymentGateway(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'nickname' => 'required|string|max:255',
                'notes' => 'nullable|string',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'required|string',
                'type_of_payment' => 'required|string',
                'payment_mode' => 'required|string',
                'client_id' => 'required|string',
                'client_secret_key' => 'required|string',
            ]);

            $existingPaymentGateway = PaymentSetting::find($id);

            if (!$existingPaymentGateway) {
                return redirect()->route('settings.index')->with('status', 'Payment Gateway not found.');
            }

            if ($request->hasFile('logo')) {
                if ($existingPaymentGateway->logo) {
                    Storage::disk('public')->delete($existingPaymentGateway->logo);
                }
                $logoPath = $request->file('logo')->store('payment_logos', 'public');
                $validatedData['logo'] = $logoPath;
            } else {
                $validatedData['logo'] = $existingPaymentGateway->logo;
            }

            $existingPaymentGateway->update($validatedData);

            return redirect()->route('settings.index')->with('status', 'Payment Gateway updated successfully.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->route('settings.index')->with('status', 'Failed to update Payment Gateway.');
        }
    }

    public function destroyPaymentGateway($id)
    {
        try {
            $paymentGateway = PaymentSetting::find($id);

            if (!$paymentGateway) {
                return redirect()->route('settings.index')->with('status', 'Payment Gateway not found.');
            }

            // Delete the logo file if it exists
            if ($paymentGateway->logo) {
                Storage::disk('public')->delete($paymentGateway->logo);
            }

            // Delete the payment gateway record
            $paymentGateway->delete();

            return redirect()->route('settings.index')->with('status', 'Payment Gateway deleted successfully.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->route('settings.index')->with('status', 'Failed to delete Payment Gateway.');
        }
    }
}
