<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')

<body class="hold-transition sidebar-mini">
   <div id="app" class="wrapper">
      {{-- navbar --}}
      @include('partials.navbar')
      {{-- sidebar --}}
      @include('partials.sidebar')

      @include('partials.flash')

      @yield('content')
      {{-- configs --}}
      @include('partials.configs')
      {{-- footer --}}
      @include('partials.footer')
   </div>
   <!-- jQuery -->
   <script src="{{ asset('js/app.js') }}"></script>
   <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
   {{-- <script src="https://getbootstrap.com/docs/4.1/assets/js/vendor/popper.min.js">
   </script> --}}
   <!-- Bootstrap 4 -->
   <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <!-- AdminLTE App -->
   <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
   @yield('scripts')
</body>

</html>
