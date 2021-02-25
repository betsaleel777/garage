@extends('layouts.default')
@section('module-navbar')
   @include('partials.modules.nav-maintenance')
@endsection
@section('content')
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Tableau de bord des Essais</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('maintenance_index') }}">Tableau de maintenance</a>
                     </li>
                     <li class="breadcrumb-item active">Tableau des essais</li>
                  </ol>
               </div><!-- /.col -->
            </div><!-- /.row -->
         </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
         <div class="container-fluid">
            <div class="row">
               <!-- /.col-md-6 -->
               <div class="col-lg-12">
                  <div class="card">
                     <div class="card-header">
                        <div class="row">
                           <div class="col-md-8"></div>
                           <div class="col-md-2">
                              <a class="btn btn-primary btn-sm ui-button" href="{{ route('preessai_liste') }}">
                                 <i class="fas fa-list-ul"></i> Essais avant réparations
                              </a>
                           </div>
                           <div class="col-md-2">
                              <a class="btn btn-primary btn-sm ui-button" href="{{ route('postessai_liste') }}">
                                 <i class="fas fa-list-ul"></i> Essais après réparations
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="card-body">
                        {{-- <h6 class="card-title">Special title treatment</h6> --}}
                        <p class="card-text">cette page doit contenir les statistiques pertinantes qui serviront de contenu
                           au dashbord mais uniquement concernant les essais avant et après réparations</p>
                        {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                     </div>
                  </div>
               </div>
               <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
         </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->
@endsection
