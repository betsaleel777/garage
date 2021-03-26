@extends('layouts.default')
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
               <div class="col-sm-6">
                  <h1 class="m-0 text-dark">{{ $commande->code }}</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('finance_index') }}">Tableau des finances</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('commande_simple_liste') }}">Commandes</a>
                     </li>
                     <li class="breadcrumb-item active">{{ $commande->reference }}</li>
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
               <!-- /.col-md-12 -->
               <div class="col-md-12">
                  <div class="card">
                     <div class="card-header">
                        <div class="row">
                           <div class="col-md-2">
                           </div>
                        </div>
                     </div>
                     <div class="card-body">
                        <div class="container">
                           <div class="row">
                              <div class="col-md-8">
                                 @if ($commande->estEnCours())
                                    <span
                                       class="text-primary"><b>{{ Str::upper('COMMANDE ' . $commande->status) }}</b></span>
                                 @elseif($commande->estAnnulee())
                                    <span
                                       class="text-danger"><b>{{ Str::upper('COMMANDE ' . $commande->status) }}</b></span>
                                 @else
                                    <span
                                       class="text-success"><b>{{ Str::upper('COMMANDE ' . $commande->status) }}</b></span>
                                 @endif
                              </div>
                              <div class="col-md-4 text-right">
                                 <span class="text-primary">Crée par {{ $commande->utilisateur->name }},</span><span
                                    class="text-muted"> le {{ $commande->created_at }}</span>
                              </div>
                           </div>
                           <hr>
                           <div class="row">
                              <div class="col-md-4 text-center">
                                 <b>REFERENCE:</b> {{ $commande->reference }}
                              </div>
                              <div class="col-md-4 text-center">
                                 <b>MAGASIN RECEPTEUR:</b> {{ $commande->magasinLinked->nom }}
                              </div>
                              <div class="col-md-4 text-center">
                                 <b>FOURNISSEUR:</b> {{ $commande->fournisseurLinked->nom }}
                              </div>
                              <div class="col-md-12 mt-3">
                                 <div class="card card-light collapsed-card">
                                    <!-- /.card-header -->
                                    <div class="card-header">
                                       <h3 class="card-title">Pieces commandées</h3>
                                       <!-- /.card-tools -->
                                       <div class="card-tools">
                                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-plus"></i>
                                          </button>
                                       </div>
                                       <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- /.card-body -->
                                    <div class="card-body">
                                       <div class="row">
                                          @foreach ($commande->pieces as $piece)
                                             <div class="col-md-4">
                                                <div class="card" style="width: 18rem;">
                                                   <img width="286" height="180" style="object-fit: cover"
                                                      class="card-img-top"
                                                      src="{{ url('/storage/' . $piece->categorieEnfant->image) }}"
                                                      alt="Card image cap">
                                                   <ul style="font-size: 13px" class="list-group list-group-flush">
                                                      <li class="list-group-item">
                                                         <span class="text-muted">
                                                            {{ $piece->reference }}
                                                         </span>
                                                      </li>
                                                      <li class="list-group-item">
                                                         <span class="text-muted">
                                                            {{ $piece->pivot->quantite }} pièce(s) demandée(s)
                                                         </span>
                                                      </li>
                                                      <li class="list-group-item">
                                                         <span class="text-muted">
                                                            {{ $piece->categorieEnfant->nom }} pour:
                                                            {{ ' ' . $piece->pivot->vehiculeLinked->getName() }}
                                                         </span>
                                                      </li>
                                                   </ul>
                                                   <div class="card-body">
                                                      @if (empty($piece->image))
                                                         Aucune visualisation possible
                                                      @else
                                                         <lightbox-component message="'Visualiser la pièce'"
                                                            source="{{ '/storage/' . $piece->image }}">
                                                         </lightbox-component>
                                                      @endif
                                                   </div>
                                                </div>
                                             </div>
                                          @endforeach
                                       </div>
                                    </div>
                                    <!-- /.card-body -->
                                 </div>
                              </div>
                           </div>
                           {{-- pieces jointes --}}
                           <div class="row">
                              <div class="col-md-6 mt-4">
                                 <h5><b>Pièces jointes</b></h5>
                                 <ul>
                                    @forelse ($commande->medias as $media)
                                       <li><i class="fas fa-paperclip text-danger mr-1"></i><a
                                             href="{{ url('/storage/' . $media->media) }}" download>
                                             {{ explode('/', $media->media)[1] }}</a>
                                       </li>
                                    @empty
                                       <li class="text-danger">Pas de fichiers joints</li>
                                    @endforelse
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.card-body -->
               </div>
            </div>
            <!-- /.col-md-12 -->
         </div>
         <!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>
   <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->
@endsection
