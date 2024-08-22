<!DOCTYPE html>
<html lang="en" class="light-style" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets') }}/" data-base-url="{{ url('/') }}" data-framework="laravel" data-template="vertical-menu-theme-default-light">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  {{--  <title>Login Basic - Pages | Vuexy - Bootstrap Admin Template</title>  --}}
  <title>{{ $settings['system_title'] ?? 'Default Title' }}</title>
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
  <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="canonical" href="https://example.com">
  {{--  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />  --}}
  <link rel="icon" href="{{ asset('uploads/' . ($settings['system_logo'] ?? 'default-logo.png')) }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" />
  {{--  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />  --}}
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" />
  
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />


  <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />


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
  {{ $slot }}
  <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
</body>
</html>
