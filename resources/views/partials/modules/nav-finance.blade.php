<ul class="navbar-nav">
   <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
   </li>
   <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('finance_index') }}" class="nav-link @php
         if (Route::currentRouteName() === 'finance_index') {
             echo 'text-pink';
         }
      @endphp">Acceuil</a>
   </li>
   <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('commandes') }}" class="nav-link @php
         if ($controller == 'CommandesController' || $controller == 'CommandesSimplesController' || $controller == 'CommandesReparationsController') {
             echo 'text-pink';
         }
      @endphp">Commandes
      </a>
   </li>
   {{-- <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('essais') }}"
         class="nav-link @php if($controller == 'EssaisController' or $controller == 'PreessaisController' or $controller == 'PostessaisController') { echo 'text-pink' ;} @endphp">Essais
         @if (!empty(Session::get('essais')))
            <span class="count-notif badge badge-pill badge-primary">
               {{ Session::get('essais') }}
            </span>
         @endif
      </a>
   </li>
   <li class="nav-item d-none d-sm-inline-block"> --}}
</ul>
