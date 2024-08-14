<x-app-blank-layout>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">

            <!-- Register Card -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <img src="{{ asset('assets/img/favicon/favicon.ico') }}" alt="Favicon" class="app-brand-icon" />
                        <span class="app-brand-text demo text-body fw-bolder">Vuexy</span>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2">Forgot your password?</h4>
                    <p class="mb-2">Enter email to receive password reset link.</p>
                    <form id="formAuthentication" class="mb-3" action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <button class="btn btn-primary d-grid w-100">Email Password Reset Link</button>
                        </div>

                    </form>
                </div>
            </div>
            <!-- Register Card -->
        </div>
    </div>
</x-app-blank-layout>
