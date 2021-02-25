@extends('layouts.default')
@section('module-navbar')
   @include('partials.modules.nav-systeme')
@endsection
@section('content')
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-md-6">
                  <h1 class="m-0 text-dark">Zone: {{ $zone->nom }}</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('systeme_index') }}">Acceuil système</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('magasins') }}">Magasins</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('zone_magasin', $zone->magasin) }}">Zones</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('etagere_zone', $zone) }}">Etageres</a></li>
                     <li class="breadcrumb-item active">créer etagere dans {{ $zone->nom }}</li>
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
               <div class="col-md-2"></div>
               <!-- /.col-md-8 -->
               <div class="col-md-8">
                  <div class="card">
                     <div class="card-header">
                        {{-- <h5 class="m-0">Featured</h5> --}}
                     </div>
                     <div class="card-body">
                        <create-etagere-manuel :zone="{{ $zone->id }}"></create-etagere-manuel>
                     </div>
                     <!-- /.card-body -->
                  </div>
               </div>
               <!-- /.col-md-8 -->
               <div class="col-md-2"></div>
            </div>
            <!-- /.row -->
         </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->
@endsection
