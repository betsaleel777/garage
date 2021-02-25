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
                  <h1 class="m-0 text-dark">Modifier {{ $fabricant->nom }}</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('systeme_index') }}">Acceuil système</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('fabricants') }}">fabricants</a></li>
                     <li class="breadcrumb-item active">{{ $fabricant->nom }}</li>
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
                        <form enctype="multipart/form-data" method="post" action="{{ route('fabricant_update') }}"
                           role="form">
                           @csrf
                           <input name="fabricant" type="text" hidden value="{{ $fabricant->id }}">
                           <div class="form-group">
                              <label for="nom">Nom complet</label>
                              <input value="{{ $fabricant->nom }}" name="nom" class="form-control" id="nom">
                              @error('nom')
                                 <span class="text-danger"> {{ $message }}</span>
                              @enderror
                           </div>
                           <div class="row">
                              <div class="col-md-3 form-group">
                                 <img width="200" src="{{ url('storage/' . $fabricant->logo) }}"
                                    alt="{{ $fabricant->logo }}">
                              </div>
                              <preview-image :field="'logo'"></preview-image>
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
