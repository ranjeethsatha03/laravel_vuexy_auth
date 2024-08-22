<x-app-web-layout>
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="card mb-4">
        <h5 class="card-header" data-bs-toggle="collapse" data-bs-target="#generalSettingsForm" aria-expanded="false"
            aria-controls="generalSettingsForm">
            {{ __('general_settings') }}
            <span class="dropdown-icon">
                <i class="fas fa-chevron-down" style="float: right;"></i>
            </span>
        </h5>
        <div id="generalSettingsForm" class="collapse">
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
                                @foreach ($countries as $country)
                                    <option value="{{ $country->currency_code }}"
                                        {{ isset($settings['currency_code']) && $settings['currency_code'] === $country->currency_code ? 'selected' : '' }}>
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
    </div>

    @if (auth()->user()->hasPermission('view payment setting'))

    

    <div class="card mb-4">
        <h5 class="card-header" data-bs-toggle="collapse" data-bs-target="#paymentSettingsForm" aria-expanded="false"
            aria-controls="paymentSettingsForm">
            {{ __('payment_gateway_settings') }}
            <span class="dropdown-icon">
                <i class="fas fa-chevron-down" style="float: right;"></i>
            </span>
        </h5>
        <div id="paymentSettingsForm" class="collapse">
            <div class="d-flex justify-content-end mb-3">
                @if (auth()->user()->hasPermission('create payment setting'))
                <a href="{{ url('settings/create') }}"
                    class="btn btn-primary float-end">{{ __('add_payment_gateway') }}</a>
                    @endif
            </div>
            <div class="card-body">
                <div class="card-datatable table-responsive">
                    <table class="datatables-users table border-top">
                        <thead>
                            <tr>
                                <th class="text-left px-4 py-2">{{ __('id') }}</th>
                                <th class="text-left px-4 py-2">{{ __('nickname') }}</th>
                                <th class="text-left px-4 py-2">{{ __('notes') }}</th>
                                <th class="text-left px-4 py-2">{{ __('logo') }}</th>
                                <th class="text-left px-4 py-2">{{ __('status') }}</th>
                                <th class="text-left px-4 py-2">{{ __('type_of_payment') }}</th>
                                <th class="text-left px-4 py-2">{{ __('payment_mode') }}</th>
                                <th class="text-left px-4 py-2">{{ __('client_ID') }}</th>
                                <th class="text-left px-4 py-2">{{ __('client_secret_key') }}</th>
                                <th class="text-left px-4 py-2">{{ __('action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paymentSettings as $setting)
                            <tr>
                                <td>{{ $setting->id }}</td>
                                <td>{{ $setting->nickname }}</td>
                                <td>{{ $setting->notes }}</td>
                                <td><img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" width="50" /></td>
                                <td>{{ $setting->status }}</td>
                                <td>{{ $setting->type_of_payment }}</td>
                                <td>{{ $setting->payment_mode }}</td>
                                <td>{{ $setting->client_id }}</td>
                                <td>{{ $setting->client_secret_key }}</td>
                                <td class="text-left px-4 py-2">
                                    @if (auth()->user()->hasPermission('update payment setting') || auth()->user()->hasPermission('delete payment setting'))

                                    <button type="button" class="btn rounded-pill btn-outline-primary waves-effect dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">{{ __('action') }}</button>
                        
                                    <ul class="dropdown-menu">
                                        @if (auth()->user()->hasPermission('update payment setting'))
                                        <li>
                                            <a class="dropdown-item" href="{{ route('settings.payment_gateway.edit', $setting->id) }}">{{ __('edit') }}</a>
                                        </li>
                                        @endif
                                        @if (auth()->user()->hasPermission('delete payment setting'))
                                        <li>
                                            <a class="dropdown-item" href="{{ route('settings.payment_gateway.destroy', $setting->id) }}">{{ __('delete') }}</a>
                                        </li>
                                        @endif
                                    </ul>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
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
