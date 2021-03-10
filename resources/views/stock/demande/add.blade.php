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
                  <h1 class="m-0 text-dark">Création de demande</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('stock_index') }}">Tableau du stock</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('demande_stock') }}">Demandes</a></li>
                     <li class="breadcrumb-item active">Créer demande</li>
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
               <!-- col-md-12 -->
               <div class="col-md-12">
                  <div class="card">
                     <div class="card-header">
                     </div>
                     <div class="card-body">
                        <create-demande-form :magasins="{{ json_encode($magasins) }}"
                           :reparations="{{ json_encode($reparations) }}" :pieces="{{ json_encode($pieces) }}">
                        </create-demande-form>
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
