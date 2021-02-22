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
                  <h1 class="m-0 text-dark">Modifier {{ $zone }}</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('systeme_index') }}">Acceuil</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('zones') }}">zones</a></li>
                     <li class="breadcrumb-item active">{{ $zone->nom }}</li>
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
                        <form method="post" action="{{ route('zone_update') }}" role="form">
                           @csrf
                           <input name="type" hidden type="text" value="{{ $zone->id }}">
                           <div class="form-group">
                              <label for="nom">Nom</label>
                              <input value="{{ $zone->nom }}" name="nom" class="form-control" id="nom">
                              @error('nom')
                                 <span class="text-danger"> {{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="ident">Identifiant</label>
                              <input value="{{ $zone->identifiant }}" name="identifiant" class="form-control" id="ident">
                              @error('identifiant')
                                 <span class="text-danger">{{ $message }}</span>
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
