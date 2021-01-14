<ul class="navbar-nav">
   <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
   </li>
   <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('stock_index') }}"
         class="nav-link @php if(Route::currentRouteName() === 'stock_index') { echo 'text-pink' ;} @endphp">Acceuil</a>
   </li>
   <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('pieces') }}"
         class="nav-link @php if($controller == 'PiecesController') { echo 'text-pink' ;} @endphp">Pieces
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
   <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('diagnostiques') }}"
         class="nav-link @php if($controller == 'DiagnostiquesController') { echo 'text-pink' ;} @endphp">Diagnostiques
         @if (!empty(Session::get('diagnostiques')))
            <span class="count-notif badge badge-pill badge-primary">
               {{ Session::get('diagnostiques') }}
            </span>
         @endif
      </a>
   </li>
   <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('reparations') }}"
         class="nav-link @php if($controller == 'ReparationsController') { echo 'text-pink' ;} @endphp">Réparations
         @if (!empty(Session::get('reparations')))
            <span class="count-notif badge badge-pill badge-primary">
               {{ Session::get('reparations') }}
            </span>
         @endif
      </a>
   </li> --}}
</ul>
