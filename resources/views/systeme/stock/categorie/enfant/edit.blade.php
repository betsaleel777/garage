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
                  <h1 class="m-0 text-dark">Sous-categorie: {{ $sous_categorie->nom }}</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('systeme_index') }}">Acceuil</a></li>
                     <li class="breadcrumb-item"><a
                           href="{{ route('categorie_show', $sous_categorie->parent->id) }}">{{ $sous_categorie->parent->nom }}</a>
                     </li>
                     <li class="breadcrumb-item active">{{ $sous_categorie->nom }}</li>
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
               <div class="col-md-12">
                  <div class="card">
                     <div class="card-header">
                        {{-- <h5 class="m-0">Featured</h5> --}}
                     </div>
                     <div class="card-body">
                        <form enctype="multipart/form-data" method="post" action="{{ route('sous_categorie_update') }}"
                           role="form">
                           @csrf
                           <input hidden type="text" name="sous_categorie" value="{{ $sous_categorie->id }}">
                           <div class="form-group">
                              <label for="nom">Nom complet</label>
                              <input value="{{ $sous_categorie->nom }}" name="nom" class="form-control" id="nom">
                              @error('nom')
                                 <span class="text-danger"> {{ $message }}</span>
                              @enderror
                           </div>
                           <div class="row">
                              <div class="col-md-3 form-group">
                                 @empty($sous_categorie->image)
                                    <h6><span class="badge badge-pill badge-danger">Aucune image</span></h6>
                                 @else
                                    <img width="200" src="{{ url('storage/' . $sous_categorie->image) }}"
                                       alt="{{ $sous_categorie->image }}">
                                 @endempty
                              </div>
                              <preview-image :field="'image'"></preview-image>
                           </div>
                           <div style="text-align: right" class="form-group">
                              <button type="submit" class="btn btn-primary">Enregistrer</button>
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
