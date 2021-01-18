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
                  <h1 class="m-0 text-dark">Piece: {{ $piece->nom }}</h1>
               </div><!-- /.col -->
               <div class="col-sm-4">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('stock_index') }}">Acceuil</a></li>
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
                        <form enctype="multipart/form-data" method="post" action="{{ route('piece_update') }}" role="form">
                           @csrf
                           <input hidden name="piece" type="text" value="{{ $piece->id }}">
                           <div class="form-group">
                              <label for="prix_achat">Prix achat</label>
                              <input value="{{ $piece->prix_achat }}" name="prix_achat" class="form-control"
                                 id="prix_achat">
                              @error('prix_achat')
                                 <span class="text-danger"> {{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="prix_vente">Prix vente</label>
                              <input value="{{ $piece->prix_vente }}" name="prix_vente" class="form-control"
                                 id="prix_vente">
                              @error('prix_vente')
                                 <span class="text-danger"> {{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="emplacement">Emplacement</label>
                              <input value="{{ $piece->emplacement }}" name="emplacement" class="form-control"
                                 id="emplacement">
                              @error('emplacement')
                                 <span class="text-danger"> {{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="magasin">Magasin de stockage</label>
                              <select class="select2 form-control" name="magasin" id="magasin">
                                 @foreach ($magasins as $magasin)
                                    @if ($piece->magasin === $magasin->id)
                                       <option selected value="{{ $magasin->id }}">{{ $magasin->nom }}</option>
                                    @else
                                       <option value="{{ $magasin->id }}">{{ $magasin->nom }}</option>
                                    @endif
                                 @endforeach
                              </select>
                              @error('magasin')
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
@section('scripts')
   <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
   <script>
      $(function() {
         $('.select2').select2({
            theme: 'bootstrap4'
         })
      })

   </script>
@endsection
