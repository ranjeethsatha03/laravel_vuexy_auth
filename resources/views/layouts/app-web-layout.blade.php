<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets') }}" data-base-url="{{ url('/') }}" data-framework="laravel" data-template="vertical-menu-theme-default-light">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>{{ $settings['system_title'] ?? 'Default Title' }}</title>
  <meta name="description" content="{{ $settings['meta_description'] ?? 'Default Description' }}">
  <meta property="og:title" content="{{ $settings['og_title'] ?? 'Default OG Title' }}">
  <meta property="og:description" content="{{ $settings['og_description'] ?? 'Default OG Description' }}">
  <meta property="og:image" content="{{ $settings['og_image'] ?? 'default.jpg' }}">
  <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ asset('uploads/' . ($settings['system_logo'] ?? 'default-logo.png')) }}">
  <link rel="canonical" href="https://1.envato.market/vuexy_admin">

  <!-- Fonts and Theme CSS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
 
  <!-- Include Scripts -->
  <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
  <script src="{{ asset('assets/js/config.js') }}"></script>

  <script>
    window.templateCustomizer = new TemplateCustomizer({
      cssPath: '',
      themesPath: '',
      defaultShowDropdownOnHover: true,
      displayCustomizer: true,
      lang: 'en',
      pathResolver: function(path) {
        var resolvedPaths = {
          'core.css': '{{ asset('assets/vendor/css/rtl/core.css') }}',
          'core-dark.css': '{{ asset('assets/vendor/css/rtl/core-dark.css') }}',
          'theme-default.css': '{{ asset('assets/vendor/css/rtl/theme-default.css') }}',
          'theme-default-dark.css': '{{ asset('assets/vendor/css/rtl/theme-default-dark.css') }}',
          'theme-bordered.css': '{{ asset('assets/vendor/css/rtl/theme-bordered.css') }}',
          'theme-bordered-dark.css': '{{ asset('assets/vendor/css/rtl/theme-bordered-dark.css') }}',
          'theme-semi-dark.css': '{{ asset('assets/vendor/css/rtl/theme-semi-dark.css') }}',
          'theme-semi-dark-dark.css': '{{ asset('assets/vendor/css/rtl/theme-semi-dark-dark.css') }}',
        }
        return resolvedPaths[path] || path;
      },
      controls: ["rtl", "style", "layoutType", "showDropdownOnHover", "layoutNavbarFixed", "layoutFooterFixed", "themes"],
    });
  </script>
</head>

<body>
 
  <!-- Layout Wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

      <!-- Sidebar -->
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          {{--  <a href="{{ url('#') }}" class="app-brand-link">  --}}
            <span class="app-brand-logo demo">
              <!-- SVG Logo Here -->
            </span>
            <span class="app-brand-text demo menu-text fw-bold">Vuexy</span>
          {{--  </a>  --}}
          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
          </a>
        </div>
        <div class="menu-inner-shadow"></div>
        <ul class="menu-inner py-1">
          <li class="menu-item">
            <a href="{{ url('/dashboard') }}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-smart-home"></i>
              <div>Home</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ url('/users') }}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-user"></i>
              <div>Users</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ url('/settings') }}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-settings"></i>
              <div>Settings</div>
            </a>
          </li>
        </ul>
      </aside>
      <!-- / Sidebar -->

      <!-- Layout Page -->
      <div class="layout-page">
        <!-- Navbar -->
        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="ti ti-menu-2 ti-sm"></i>
            </a>
          </div>
          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Style Switcher -->
            <div class="navbar-nav align-items-center">
              <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                <i class='ti ti-sm'></i>
              </a>
            </div>
            <!-- / Style Switcher -->
            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="{{ Route::has('profile.show') ? route('profile.show') : 'javascript:void(0);' }}">
                      <div class="d-flex">
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block">
                            @if (Auth::check())
                            {{ ucfirst(Auth::user()->name) }}
                            @else
                            John Doe
                            @endif
                          </span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ url('/profile') }}">
                      <i class="ti ti-user-check me-2 ti-sm"></i>
                      <span class="align-middle">My Profile</span>
                    </a>
                  </li>
                  <li>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                    <a class="dropdown-item" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="ti ti-logout me-2 ti-sm"></i>
                      <span class="align-middle">Logout</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- / User -->
            </ul>
          </div>
        </nav>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            @yield('content')

            <div>
              {{ $slot  }}
                  </div>
          
          </div>
          <!-- / Content -->

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
              <div class="mb-2 mb-md-0">
                ©
                <script>
                  document.write(new Date().getFullYear());
                </script>
                , made with ❤️ by
                <a href="https://pixinvent.com" target="_blank" class="footer-link fw-bolder">Pixinvent</a>
              </div>
            </div>
          </footer>
          <!-- / Footer -->
        </div>
        <!-- / Content wrapper -->
      </div>
      <!-- / Layout Page -->
    </div>
  </div>
  <!-- / Layout Wrapper -->

  <!-- Core Scripts -->

  <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
