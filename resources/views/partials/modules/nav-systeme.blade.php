<ul class="navbar-nav">
   <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
   </li>
   <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('systeme_index') }}"
         class="nav-link @php if(Route::currentRouteName() === 'systeme_index') { echo 'text-pink' ;} @endphp">Acceuil</a>
   </li>
   <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('comptes') }}"
         class="nav-link @php if($controller == 'ComptesController') { echo 'text-pink' ;} @endphp">Comptes</a>
   </li>
   <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('types_reparations') }}"
         class="nav-link @php if($controller == 'TypesReparationsController') { echo 'text-pink' ;} @endphp">Type
         réparation</a>
   </li>
   <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('ateliers') }}"
         class="nav-link @php if($controller == 'AteliersController') { echo 'text-pink' ;} @endphp">
         Ateliers
      </a>
   </li>
</ul>
