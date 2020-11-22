<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')

<body class="hold-transition sidebar-mini">
   <div id="app" class="wrapper">
      {{-- navbar --}}
      @include('partials.navbar')
      {{-- sidebar --}}
      @include('partials.sidebar')
      @yield('content')
      {{-- configs --}}
      @include('partials.configs')
      {{-- footer --}}
      @include('partials.footer')
   </div>
   <!-- jQuery -->
   @yield('vuejs')
   <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
   <!-- Bootstrap 4 -->
   <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <!-- AdminLTE App -->
   <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
   @yield('scripts')
</body>

</html>
