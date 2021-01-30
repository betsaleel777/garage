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
               <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Modifier {{ $magasin->nom }}</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('systeme_index') }}">Acceuil</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('magasins') }}">Magasins</a></li>
                     <li class="breadcrumb-item active">{{ $magasin->nom }}</li>
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
               <div class="col-md-3"></div>
               <div class="col-md-6">
                  <div class="card">
                     <div class="card-header">
                        {{-- <h5 class="m-0">Featured</h5> --}}
                     </div>
                     <div class="card-body">
                        <form method="post" action="{{ route('magasin_update') }}" role="form">
                           @csrf
                           <input hidden type="text" name="magasin" value="{{ $magasin->id }}">
                           <div class="form-group">
                              <label for="nom">Nom complet</label>
                              <input value="{{ $magasin->nom }}" name="nom" class="form-control" id="nom">
                              @error('nom')
                                 <span class="text-danger"> {{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="lieu">Lieu</label>
                              <input value="{{ $magasin->lieu }}" name="lieu" class="form-control" id="lieu">
                              @error('lieu')
                                 <span class="text-danger"> {{ $message }}</span>
                              @enderror
                           </div>
                           <div style="text-align: right" class="form-group">
                              <button type="submit" class="btn btn-primary">Enregistrer</button>
                           </div>
                        </form>
                     </div>
                     <!-- /.card-body -->
                  </div>
               </div>
               <div class="col-md-3"></div>
               <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
         </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->
@endsection
