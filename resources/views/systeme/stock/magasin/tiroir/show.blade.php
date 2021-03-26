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
                  <h1 class="m-0 text-dark">{{ $tiroir->nom }}</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('systeme_index') }}">Acceuil systeme</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('magasins') }}">Magasins</a></li>
                     @if ($tiroir->etagereLinked->zoneLinked)
                        <li class="breadcrumb-item"><a
                              href="{{ route('magasin_show', $tiroir->etagereLinked->zoneLinked->magasinlinked->id) }}">
                              {{ $tiroir->etagereLinked->zoneLinked->magasinlinked->nom }}</a></li>
                     @else
                        <li class="breadcrumb-item"><a
                              href="{{ route('magasin_show', $tiroir->etagereLinked->magasinlinked->id) }}">
                              {{ $tiroir->etagereLinked->magasinlinked->nom }}</a></li>
                     @endif
                     <li class="breadcrumb-item active">{{ $tiroir->nom }}</li>
                  </ol>
               </div><!-- /.col -->
            </div><!-- /.row -->
         </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
         <div class="container-fluid">
            <div class="card">
               <div class="card-header">
                  CONTENU DE L'EMPLACEMENT
               </div>
               <div class="card-body">
                  <div class="row">
                     @forelse ($tiroir->pieces as $piece)
                        <div class="col-md-3">
                           <div class="card" style="width: 18rem;">
                              <img width="286" height="180" style="object-fit: cover" class="card-img-top"
                                 src="{{ url('/storage/' . $piece->categorieEnfant->image) }}" alt="Card image cap">
                              <ul style="font-size: 13px" class="list-group list-group-flush">
                                 <li class="list-group-item">
                                    <span class="text-muted">
                                       {{ $piece->reference }}
                                    </span>
                                 </li>
                                 <li class="list-group-item">
                                    <span class="text-muted">
                                       pièce {{ $piece->type_piece }} et {{ $piece->etat_piece }}
                                    </span>
                                 </li>
                                 <li class="list-group-item">
                                    <span class="text-muted">
                                       {{ $piece->categorieEnfant->nom }} disponible pour les vehicules:
                                       @foreach ($piece->vehicules as $vehicule)
                                          <ul>
                                             <li>{{ $vehicule->getName() }}</li>
                                          </ul>
                                       @endforeach
                                    </span>
                                 </li>
                              </ul>
                              <div class="card-body">
                                 @if (empty($piece->image))
                                    Pas d'image pour cette pièce
                                 @else
                                    <lightbox-component message="'Visualiser la pièce'"
                                       source="{{ '/storage/' . $piece->image }}">
                                    </lightbox-component>
                                 @endif
                              </div>
                           </div>
                        </div>
                     @empty
                        <div class="col-md-12">
                           <div class="alert alert-warning" role="alert">
                              <h4 class="alert-heading">Cet emplacement ne contient auncune piece</h4>
                              <p>
                                 Vous pouvez affecter des pièces à un emplacement (tiroir) lors de la création de
                                 celles-ci, ou alors vous pouvez
                                 modifier l'emplacement d'une pièce existante.
                              </p>
                              <hr>
                              <p class="mb-0">
                                 voir la rubrique: <a class="alert-link" href="{{ route('pieces') }}"> 'pieces' du module
                                    stock</a>
                              </p>
                           </div>
                        </div>
                     @endforelse
                  </div>
               </div>
            </div>
         </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->
@endsection
