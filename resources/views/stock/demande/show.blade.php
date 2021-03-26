@extends('layouts.default')
@section('style')
   <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href=" {{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }} ">
   <link rel="stylesheet" href=" {{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }} ">
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
               <div class="col-sm-6">
                  <h1 class="m-0 text-dark">{{ Str::upper($demande->nom) }}</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('stock_index') }}">Tableau du stock</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('demande_stock') }}">Demandes</a></li>
                     <li class="breadcrumb-item active">{{ $demande->code }}</li>
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
                                 @if ($demande->urgenceFaible())
                                    <span
                                       class="text-success"><b>{{ Str::upper('URGENCE ' . $demande->urgence) }}</b></span>
                                 @elseif($demande->urgenceMaximale())
                                    <span
                                       class="text-danger"><b>{{ Str::upper('URGENCE ' . $demande->urgence) }}</b></span>
                                 @elseif($demande->urgenceElevee())
                                    <span
                                       class="text-warning"><b>{{ Str::upper('URGENCE ' . $demande->urgence) }}</b></span>
                                 @else
                                    <span
                                       class="text-primary"><b>{{ Str::upper('URGENCE ' . $demande->urgence) }}</b></span>
                                 @endif
                              </div>
                              <div class="col-md-4 text-right">
                                 <span class="text-primary">Crée par {{ $demande->utilisateur->name }},</span><span
                                    class="text-muted"> le {{ $demande->created_at }}</span>
                              </div>
                           </div>
                           <hr>
                           {{-- elements descriptifs --}}
                           <div class="row">
                              <div class="col-md-3 text-left">
                                 <b>MOTIF:</b> {{ $demande->motif }}
                              </div>
                              <div class="col-md-3 text-left">
                                 <b>DESTINATAIRE:</b> {{ $demande->destinataire }}
                              </div>
                              <div class="col-md-3 text-left">
                              </div>
                              <div class="col-md-3 text-left"></div>
                              <div class="col-md-12 mt-3">
                                 <div class="card card-light collapsed-card">
                                    <div class="card-header">
                                       <h3 class="card-title">Pieces demandées</h3>
                                       <div class="card-tools">
                                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-plus"></i>
                                          </button>
                                       </div>
                                       <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                       <div class="row">
                                          @foreach ($demande->pieces as $piece)
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
                                                            {{ $piece->categorieEnfant->nom }} pour
                                                            {{ $piece->pivot->vehiculeLinked->getName() }}
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
                                          @endforeach
                                       </div>
                                    </div>
                                    <!-- /.card-body -->
                                 </div>
                              </div>
                           </div>
                           {{-- liste des commandes liées à cette demande --}}
                           <div class="row">
                              <div class="col-md-12 mt-4">
                                 <p>
                                 <h5><b>Commande(s) effectuée(s) pour cette demande de pièce</b></h5>
                                 <table id="commandes" class="table table-bordered table-hover mb-2">
                                    <thead>
                                       <tr>
                                          <th>#</th>
                                          <th>Code</th>
                                          <th>Pour le magasin</th>
                                          <th>Adressée à</th>
                                          <th>Status</th>
                                          <th>Date</th>
                                          <th>Utilisateur</th>
                                          <th>Options</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($demande->commandes as $key => $commande)
                                          <tr>
                                             <td>{{ $key + 1 }}</td>
                                             <td>{{ $commande->code }}</td>
                                             <td>{{ $commande->magasinLinked->nom }}</td>
                                             <td>{{ $commande->fournisseurLinked->nom }}</td>
                                             <td>
                                                @if ($commande->estEnCours())
                                                   <span class="badge badge-primary">{{ $commande::EN_COURS }}</span>
                                                @elseif ($commande->estLivree())
                                                   <span class="badge badge-success">{{ $commande::LIVREE }}</span>
                                                @else
                                                   <span class="badge badge-danger">{{ $commande::ANNULEE }}</span>
                                                @endif
                                             </td>
                                             <td>{{ $commande->created_at->format('d-m-Y') }}</td>
                                             <td>{{ $commande->utilisateur->name }}</td>
                                             <td>
                                                <a href="#" data-toggle="modal" data-target="#piece{{ $commande->id }}">
                                                   <i class="fas fa-lg fa-eye"></i>
                                                </a>
                                             </td>
                                          </tr>
                                          {{-- fenetre modale des pièces commandées --}}
                                          <div class="modal fade" id="piece{{ $commande->id }}" tabindex="-1"
                                             role="dialog" aria-labelledby="pieceLabel" aria-hidden="true">
                                             <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <h5 class="modal-title" id="pieceLabel">Pièces pour la commande
                                                         {{ $commande->code }}</h5>
                                                      <button type="button" class="close" data-dismiss="modal"
                                                         aria-label="Close">
                                                         <span aria-hidden="true">&times;</span>
                                                      </button>
                                                   </div>
                                                   <div class="modal-body">
                                                      <ul>
                                                         @foreach ($commande->pieces as $piece)
                                                            @php
                                                               $lienImage = '/storage' . '/' . $piece->image;
                                                            @endphp
                                                            <li>
                                                               <lightbox-component
                                                                  message="'{{ $piece->nom . ' pour ' }}
                                                                                                                                                                                                         {{ $piece->pivot->vehiculeLinked->getName() }}
                                                                                                                                                                                                         {{ '(x' . $piece->pivot->quantite . ')' }}'"
                                                                  source="{{ $lienImage }}">
                                                               </lightbox-component>
                                                            </li>
                                                         @endforeach
                                                      </ul>
                                                   </div>
                                                   <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary btn-sm"
                                                         data-dismiss="modal">
                                                         Quitter
                                                      </button>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       @endforeach
                                    </tbody>
                                 </table>
                                 </p>
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
