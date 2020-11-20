<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')

<body>
   <div id="app">
      @include('partials.sidebar')
   </div>
   @include('partials.footer')
</body>
</html>
