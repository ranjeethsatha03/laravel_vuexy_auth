<x-app-web-layout>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('settings') }}"
                            class="btn rounded-pill btn-outline-primary waves-effect float-end">{{ __('Back') }}</a>

                        <h4> {{ __('Add Payment Gateway') }} </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('settings') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-sm-3">
                                    <label for="type_of_payment" class="mb-3"> {{ __('Type of Payment') }} </label>
                                    <select id="type_of_payment" name="type_of_payment" class="form-select select2" required>
                                        <option value="paypal">PayPal</option>
                                        <option value="stripe">Stripe</option>
                                        <option value="razorpay">Razorpay</option>
                                        <option value="phonepe">PhonePe</option>
                                        <option value="icici">ICICI</option>
                                    </select>
                                    @error('type_of_payment')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-sm-3">
                                    <label for="nickname" class="mb-3"> {{ __('Nickname') }} </label>
                                    <input type="text" id="nickname" name="nickname" class="form-control"
                                        required />
                                    @error('nickname')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-sm-3">
                                    <label for="notes" class="mb-3"> {{ __('Notes') }} </label>
                                    <textarea id="notes" name="notes" class="form-control"></textarea>
                                    @error('notes')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-sm-3">
                                    <label for="logo" class="mb-3"> {{ __('Logo') }} </label>
                                    <input type="file" id="logo" name="logo" class="form-control" />
                                </div>
                                <div class="mb-3 col-sm-3">
                                    <label for="status" class="mb-3"> {{ __('Status') }} </label>
                                    <select id="status" name="status" class="form-control" required>
                                        <option value="active">{{ __('Active') }}</option>
                                        <option value="inactive">{{ __('Inactive') }}</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-sm-3">
                                    <label for="payment_mode" class="form-label">{{ __('Payment Mode') }}</label>
                                    <select id="payment_mode" name="payment_mode" class="form-select" required>
                                        <option value="live"
                                            {{ old('payment_mode', $paymentGateway->payment_mode ?? '') === 'live' ? 'selected' : '' }}>
                                            {{ __('Live') }}
                                        </option>
                                        <option value="sandbox"
                                            {{ old('payment_mode', $paymentGateway->payment_mode ?? '') === 'sandbox' ? 'selected' : '' }}>
                                            {{ __('Sandbox') }}
                                        </option>
                                    </select>
                                    @error('payment_mode')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-sm-3">
                                    <label for="client_id" class="mb-3"> {{ __('Client ID') }} </label>
                                    <input type="text" id="client_id" name="client_id" class="form-control"
                                        required />
                                    @error('client_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-sm-3">
                                    <label for="client_secret_key" class="mb-3"> {{ __('Client Secret Key') }}
                                    </label>
                                    <input type="text" id="client_secret_key" name="client_secret_key"
                                        class="form-control" required />
                                    @error('client_secret_key')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-sm-3">
                                    <button type="submit"
                                        class="btn btn-primary">{{ __('Save Payment Gateway') }}</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-web-layout>
