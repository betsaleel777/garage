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
                  <h1 class="m-0 text-dark">Nouveau Fournisseur</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('systeme_index') }}">Acceuil</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('fournisseurs') }}">Fournisseurs</a></li>
                     <li class="breadcrumb-item active">Créer Fournisseur</li>
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
               <div class="col-md-6">
                  <div class="card">
                     <div class="card-header">
                        {{-- <h5 class="m-0">Featured</h5> --}}
                     </div>
                     <div class="card-body">
                        <form method="post" action="{{ route('fournisseur_update') }}" role="form">
                           @csrf
                           <input hidden name="fournisseur" value="{{ $fournisseur->id }}">
                           <div class="form-group">
                              <label for="nom">Nom complet</label>
                              <input value="{{ $fournisseur->nom }}" name="nom" class="form-control" id="nom">
                              @error('nom')
                                 <span class="text-danger"> {{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="contact">Contact</label>
                              <input value="{{ $fournisseur->contact }}" name="contact" class="form-control" id="contact">
                              @error('contact')
                                 <span class="text-danger"> {{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" value="{{ $fournisseur->email }}" name="email" class="form-control"
                                 id="email">
                              @error('email')
                                 <span class="text-danger"> {{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="siege">Lieu du Siège</label>
                              <input value="{{ $fournisseur->siege }}" name="siege" class="form-control" id="siege">
                              @error('siege')
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
               <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
         </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->
@endsection
