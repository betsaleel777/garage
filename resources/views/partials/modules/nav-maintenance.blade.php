<ul class="navbar-nav">
   <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
   </li>
   <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('maintenance_index') }}"
         class="nav-link @php if(Route::currentRouteName() === 'maintenance_index') { echo 'text-pink' ;} @endphp">Acceuil</a>
   </li>
   <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('receptions') }}"
         class="nav-link @php if($controller == 'ReceptionsController') { echo 'text-pink' ;} @endphp">Réceptions</a>
   </li>
   <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('diagnostiques') }}"
         class="nav-link @php if($controller == 'DiagnostiquesController') { echo 'text-pink' ;} @endphp">Diagnostiques</a>
   </li>
   <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('essais') }}"
         class="nav-link @php if($controller == 'EssaisController') { echo 'text-pink' ;} @endphp">Essais
         véhicule</a>
   </li>
   <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('reparations') }}"
         class="nav-link @php if($controller == 'ReparationsController') { echo 'text-pink' ;} @endphp">Réparations</a>
   </li>
</ul>
