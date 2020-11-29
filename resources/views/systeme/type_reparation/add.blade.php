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
                  <h1 class="m-0 text-dark">Nouveau Type de réparations</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('systeme_index') }}">Acceuil</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('types_reparations') }}">Types</a></li>
                     <li class="breadcrumb-item active">Ajouter Type</li>
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
                        {{-- <h5 class="m-0">Featured</h5> --}}
                     </div>
                     <div class="card-body">
                        <form method="post" action="{{ route('types_reparation_store') }}" role="form">
                           @csrf
                           <div class="form-group">
                              <label for="nom">Nom</label>
                              <input value="{{ old('nom') }}" name="nom" class="form-control" id="nom">
                              @error('nom')
                                 <span class="text-danger"> {{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="prix">Prix forfaitaire</label>
                              <input value="{{ old('prix_forfaitaire') }}" name="prix_forfaitaire" class="form-control"
                                 id="prix">
                              @error('prix_forfaitaire')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                           <div style="text-align: right" class="form-group">
                              <button type="submit" class="btn btn-primary">Soumettre</button>
                           </div>
                        </form>
                     </div>
                     <!-- /.card-body -->
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
