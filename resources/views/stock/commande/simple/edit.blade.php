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
               <div class="col-md-3">
                  <h1 class="m-0 text-dark">Commande: {{ $commande->code }}</h1>
               </div><!-- /.col -->
               <div class="col-md-9">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('stock_index') }}">Tableau du stock</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('commandes_bystock') }}">Tableau des commandes</a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{ route('commande_simple_liste_bystock') }}">Commandes
                           simples</a>
                     </li>
                     <li class="breadcrumb-item active">Commande {{ $commande->code }}</li>
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
               <!-- /.col-md-12-->
               <div class="col-md-12">
                  <div class="card">
                     <div class="card-header">
                     </div>
                     <div class="card-body">
                        <commande-simple-edit-form from='stock' :commande="{{ json_encode($commande) }}"
                           :pieces="{{ json_encode($pieces) }}" :fournisseurs="{{ json_encode($fournisseurs) }}"
                           :magasins="{{ json_encode($magasins) }}">
                        </commande-simple-edit-form>
                     </div>
                  </div>
               </div>
               <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
         </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->
@endsection
