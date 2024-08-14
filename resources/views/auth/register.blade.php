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
          <h4 class="mb-2">Adventure starts here 🚀</h4>
          <p class="mb-2">Make your app management easy and fun!</p>

          <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-2">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}" required autofocus>
              @error('name')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-2">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
              @error('email')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-2 form-password-toggle">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" autocomplete="new-password" required>
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
              @error('password')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-2 form-password-toggle">
              <label class="form-label" for="password_confirmation">Confirm Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password_confirmation" autocomplete="new-password" required>
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
            </div>

            <div class="mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required>
                <label class="form-check-label" for="terms-conditions">
                  I agree to
                  <a href="{{ url('/pages/privacy-policy') }}" target="_blank">privacy policy & terms</a>
                </label>
              </div>
            </div>

            <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>
          </form>

          <p class="text-center">
            <span>Already have an account?</span>
            <a href="{{ route('login') }}">
              <span>Sign in instead</span>
            </a>
          </p>

          <div class="divider my-4">
            <div class="divider-text">or</div>
          </div>

          <div class="d-flex justify-content-center">
            <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
              <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
            </a>

            <a href="{{ route('google-auth') }}" class="btn btn-icon btn-label-google-plus me-3">
              <i class="tf-icons fa-brands fa-google fs-5"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon btn-label-twitter">
              <i class="tf-icons fa-brands fa-twitter fs-5"></i>
            </a>
          </div>
        </div>
      </div>
      <!-- Register Card -->
  </div>
</div>
</x-app-blank-layout>
