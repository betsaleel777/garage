 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
       <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
       <span class="brand-text font-weight-light">{{ 'surcusale' }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
       <!-- Sidebar user panel (optional) -->
       <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
             <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
             <a href="#" class="d-block">{{ Session::get('user_name') }}</a>
          </div>
       </div>

       <!-- Sidebar Menu -->
       <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
             <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
             <li class="nav-item">
                <a href="{{ route('acceuil') }}"
                   class="nav-link @php if(Route::currentRouteName() === 'acceuil') { echo 'active' ;} @endphp ">
                   <i class="nav-icon fas fa-tachometer-alt"></i>
                   <p>
                      Tableau de bord
                   </p>
                </a>
             </li>
             <li class="nav-item">
                <a href="#"
                   class="nav-link @php if(Route::currentRouteName() === 'crm_index') { echo 'active' ;} @endphp">
                   <i class="nav-icon fas fa-th"></i>
                   <p>
                      CRM
                      {{-- <span class="right badge badge-danger">New</span>
                      --}}
                   </p>
                </a>
             </li>
             <li class="nav-item">
                <a href="{{ route('maintenance_index') }}"
                   class="nav-link @php if(Route::currentRouteName() === 'maintenance_index') { echo 'active' ;} @endphp">
                   <i class="nav-icon fas fa-th"></i>
                   <p>
                      Maintenance
                      {{-- <span class="right badge badge-danger">New</span>
                      --}}
                   </p>
                </a>
             </li>
             <li class="nav-item">
                <a href="#"
                   class="nav-link @php if(Route::currentRouteName() === 'stock_index') { echo 'active'; } @endphp">
                   <i class="nav-icon fas fa-th"></i>
                   <p>
                      Stock
                      {{-- <span class="right badge badge-danger">New</span>
                      --}}
                   </p>
                </a>
             </li>
             <li class="nav-item">
                <a href="#"
                   class="nav-link @php if(Route::currentRouteName() === 'finance_index') { echo 'active'; } @endphp">
                   <i class="nav-icon fas fa-th"></i>
                   <p>
                      Finance
                      {{-- <span class="right badge badge-danger">New</span>
                      --}}
                   </p>
                </a>
             </li>
             <li class="nav-item">
                <a href="#"
                   class="nav-link @php if(Route::currentRouteName() === 'rapport_index') { echo 'active'; } @endphp">
                   <i class="nav-icon fas fa-th"></i>
                   <p>
                      Rapport
                   </p>
                </a>
             </li>
             <li class="nav-item">
                <a href="{{ route('systeme_index') }}"
                   class="nav-link @php if(Route::currentRouteName() === 'systeme_index') { echo 'active'; } @endphp">
                   <i class="nav-icon fas fa-cogs"></i>
                   <p>
                      Système
                   </p>
                </a>
             </li>
          </ul>
       </nav>
       <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
 </aside>
