@extends('layouts.default')
@section('style')
   <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
   <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
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
               <div class="col-sm-8">
                  <div class="row">
                     {{-- <div class="col-md-2">
                        <img width="100" height="100" src="{{ url('storage/' . $piece->categorieLinked->image) }}"
                           alt="{{ $piece->categorieLinked->nom }}">
                     </div> --}}
                     <div class="col-md-6">
                        <h1 class="m-0 text-dark">Piece: {{ $piece->reference }}</h1>
                     </div>
                  </div>
               </div><!-- /.col -->
               <div class="col-sm-4">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('stock_index') }}">Tableau du stock</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('pieces') }}">Pièces</a></li>
                     <li class="breadcrumb-item active">{{ $piece->code }}</li>
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
                        <form enctype="multipart/form-data" method="post" action="{{ route('piece_update') }}"
                           role="form">
                           @csrf
                           <input hidden name="piece" type="text" value="{{ $piece->id }}">
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-4"></div>
                                 <div class="col-md-4">
                                    <img class="img-thumbnail" src="{{ url('storage/' . $piece->image) }}"
                                       alt="{{ $piece->reference }}">
                                    <center><span
                                          class="text-dark"><b>{{ $piece->reference }}</b>:{{ $piece->categorieEnfant->nom }}</span>
                                    </center>
                                 </div>
                                 <div class="col-md-4"></div>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="image">Image</label>
                              <input id="image" type="file" name="image">
                           </div>
                           <div class="form-group">
                              <label for="description">Description</label>
                              <textarea name="description" class="form-control" id="description" cols="30"
                                 rows="4">{{ $piece->description }}</textarea>
                              @error('description')
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
