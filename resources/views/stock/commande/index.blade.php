@extends('layouts.default')
@section('module-navbar')
   @include('partials.modules.nav-stock')
@endsection
@section('content')
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Acceuil Commande</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('stock_index') }}">Tableau du stock</a></li>
                     <li class="breadcrumb-item active">Commandes</li>
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
                           <div class="col-md-10"></div>
                           <div class="col-md-2">
                              <a class="btn btn-primary btn-sm ui-button"
                                 href="{{ route('commande_simple_liste_bystock') }}">
                                 <i class="fas fa-list fa-sm"></i> liste des commandes</a>
                           </div>
                        </div>
                     </div>
                     <div class="card-body">
                        <h6 class="card-title">Special title treatment</h6>
                        <p class="card-text">cette page doit contenir les statistiques pertinantes qui serviront de contenu
                           au dashboard mais uniquement concernant les commandes (tout les modules commandes (simple et
                           reparation))
                        </p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
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
