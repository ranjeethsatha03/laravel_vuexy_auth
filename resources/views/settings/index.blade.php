<x-app-web-layout>
        <div class="alert alert-success" id="successMessage" style="display: none;"></div>
        <div class="card mb-4">
            <h5 class="card-header">{{ __('general_settings') }}</h5>
            <div class="card-body">
                <form id="settingsForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-sm-6">
                            <label for="systemTitle" class="form-label">{{ __('system_title') }}</label>
                            <input type="text" id="systemTitle" name="system_title" class="form-control"
                                placeholder="Enter System Title" value="{{ $settings['system_title'] ?? '' }}" />
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="systemLogo" class="form-label">{{ __('system_logo') }}</label>
                            <input type="file" class="form-control" id="systemLogo" name="system_logo"
                                accept="image/*" />
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="phoneNumber" class="form-label">{{ __('phone_number') }}</label>
                            <input type="tel" id="phoneNumber" name="phone_number" class="form-control"
                                placeholder="Enter Phone Number" value="{{ $settings['phone_number'] ?? '' }}" />
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="email" class="form-label">{{ __('email') }}</label>
                            <input class="form-control" type="email" id="email" name="email"
                                placeholder="Enter Email" value="{{ $settings['email'] ?? '' }}" />
                        </div>
                        <div class="mb-3 col-sm-6">
                          <label for="currencyCode" class="form-label">{{ __('currency_code') }}</label>
                          <select id="currencyCode" name="currency_code" class="form-select select2">
                              @foreach($countries as $country)
                                  <option value="{{ $country->currency_code }}"
                                      {{ (isset($settings['currency_code']) && $settings['currency_code'] === $country->currency_code) ? 'selected' : '' }}>
                                      {{ $country->currency_code }} ({{ $country->country_name }})
                                  </option>
                              @endforeach
                          </select>
                      </div>
                        <div class="mb-3 col-sm-6">
                            <label for="frontendLayout" class="form-label">{{ __('frontend_layout') }}</label>
                            <select id="frontendLayout" class="form-select select2" name="frontend_layout">
                                <option value="Regular"
                                    {{ $settings['frontend_layout'] === 'Regular' ? 'selected' : '' }}>Regular</option>
                                <option value="Custom"
                                    {{ $settings['frontend_layout'] === 'Custom' ? 'selected' : '' }}>Custom</option>
                            </select>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="dateFormat" class="form-label">{{ __('date_format') }}</label>
                            <input type="text" class="form-control" id="dateFormat" name="date_format"
                                placeholder="Enter Date Format" value="{{ $settings['date_format'] ?? '' }}" />
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="dedicatedIP" class="form-label">{{ __('dedicated_ip') }}</label>
                            <input class="form-control" type="text" id="dedicatedIP" name="dedicated_ip"
                                placeholder="Enter Dedicated IP" value="{{ $settings['dedicated_ip'] ?? '' }}" />
                        </div>
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mb-4">
            <h5 class="card-header">{{ __('payment_setting') }}</h5>
            <div class="card-body">
                <form id="paymentSettingsForm" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-sm-6">
                            <label for="activePaymentGateway"
                                class="form-label">{{ __('active_payment_gateway') }}</label>
                            <input type="text" id="activePaymentGateway" name="active_payment_gateway"
                                class="form-control" placeholder="Enter Active Payment Gateway"
                                value="{{ $settings['active_payment_gateway'] ?? '' }}" />
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="stripeCredentials" class="form-label">{{ __('stripe_credentials') }}</label>
                            <input class="form-control" type="text" id="stripeCredentials"
                                name="stripe_credentials" placeholder="Enter Stripe Credentials"
                                value="{{ $settings['stripe_credentials'] ?? '' }}" />
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="paypalCredentials" class="form-label">{{ __('paypal_credentials') }}</label>
                            <input type="text" id="paypalCredentials" name="paypal_credentials"
                                class="form-control" placeholder="Enter PayPal Credentials"
                                value="{{ $settings['paypal_credentials'] ?? '' }}" />
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="razorpayCredentials"
                                class="form-label">{{ __('razorpay_credentials') }}</label>
                            <input class="form-control" type="text" id="razorpayCredentials"
                                name="razorpay_credentials" placeholder="Enter Razorpay Credentials"
                                value="{{ $settings['razorpay_credentials'] ?? '' }}" />
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="paystackCredentials"
                                class="form-label">{{ __('paystack_credentials') }}</label>
                                <input class="form-control mobile-number" type="text" id="paystackCredentials"
                                    name="paystack_credentials" placeholder="Enter Paystack Credentials"
                                    value="{{ $settings['paystack_credentials'] ?? '' }}" />
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="paydunyaCredentials"
                                class="form-label">{{ __('paydunya_credentials') }}</label>
                                <input class="form-control mobile-number" type="text" id="paydunyaCredentials"
                                    name="paydunya_credentials" placeholder="Enter Paydunya Credentials"
                                    value="{{ $settings['paydunya_credentials'] ?? '' }}" />
                        </div>
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mb-4">
            <h5 class="card-header">{{ __('seo_setting') }}</h5>
            <div class="card-body">
                <form id="seoSettingsForm" method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-sm-12">
                            <label for="metaTitle" class="form-label">{{ __('meta_title') }}</label>
                            <input type="text" id="metaTitle" name="meta_title" class="form-control"
                                placeholder="Enter Meta Title" value="{{ $settings['meta_title'] ?? '' }}" />
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label for="metaDescription" class="form-label">{{ __('meta_description') }}</label>
                            <input class="form-control" type="text" id="metaDescription" name="meta_description"
                                placeholder="Enter Meta Description"
                                value="{{ $settings['meta_description'] ?? '' }}" />
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label for="ogTitle" class="form-label">{{ __('og_title') }}</label>
                            <input type="text" id="ogTitle" name="og_title" class="form-control"
                                placeholder="Enter OG Title" value="{{ $settings['og_title'] ?? '' }}" />
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label for="ogDescription" class="form-label">{{ __('og_description') }}</label>
                            <input class="form-control" type="text" id="ogDescription" name="og_description"
                                placeholder="Enter OG Description" value="{{ $settings['og_description'] ?? '' }}" />
                        </div>
                        <div class="mb-3 col-sm-6">
                          <label for="ogImage" class="form-label">{{ __('og_image') }}</label>
                          <input type="file" class="form-control" id="ogImage" name="og_image" accept="image/*" />
                        </div>                      
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
         <div class="card mb-4">
    <h5 class="card-header">{{ __('analytics_setting') }}</h5>
    <div class="card-body">
        <form id="analyticsSettingsForm" method="POST" action="{{ route('settings.update') }}">
            @csrf
            <div class="row">
                <div class="mb-3 col-sm-12">
                    <label for="googleAnalytics" class="form-label">{{ __('google_analytics_id') }}</label>
                    <input type="text" id="googleAnalytics" name="google_analytics" class="form-control"
                        placeholder="Enter Google Analytics ID" value="{{ $settings['google_analytics'] ?? '' }}" />
                </div>
                <div class="mb-3 col-sm-12">
                    <label for="facebookPixel" class="form-label">{{ __('facebook_pixel_id') }}</label>
                    <input class="form-control" type="text" id="facebookPixel" name="facebook_pixel"
                        placeholder="Enter Facebook Pixel ID"
                        value="{{ $settings['facebook_pixel'] ?? '' }}" />
                </div>
                <div class="mb-3 col-sm-12">
                    <label for="chatScript" class="form-label">{{ __('chat_script') }}</label>
                    <textarea id="chatScript" name="chat_script" class="form-control"
                        placeholder="Enter Chat Script">{{ $settings['chat_script'] ?? '' }}</textarea>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">{{ __('Submit') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

</x-app-web-layout>
    <script>
        $(document).ready(function() {
            function submitForm(formId, successMessage) {
                $(formId).on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        url: '{{ route('settings.update') }}',
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.success) {
                                showMessage(successMessage || 'Settings updated successfully!');
                            } else {
                                showMessage(response.message || 'An error occurred.');
                            }
                        },
                        error: function(xhr, status, error) {
                            showMessage('An error occurred: ' + xhr.responseText);
                        }
                    });
                });
            }
            submitForm('#settingsForm', 'General settings updated successfully!');
            submitForm('#paymentSettingsForm', 'Payment settings updated successfully!');
            submitForm('#seoSettingsForm', 'SEO settings updated successfully!');
            submitForm('#analyticsSettingsForm', 'Analytics settings updated successfully!');


            function showMessage(message) {
                $('#successMessage').text(message).fadeIn().delay(3000).fadeOut();
            }
        });
    </script>
