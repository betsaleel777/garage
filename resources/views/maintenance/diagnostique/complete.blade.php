@php
use Carbon\Carbon;
@endphp
@extends('layouts.default')
@section('module-navbar')
   @include('partials.modules.nav-maintenance')
@endsection
@section('content')
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-md-6">
                  <h1 class="m-0 text-dark">Réception: {{ $reception->code }}</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('diagnostiques') }}">Tableau Diagnostics</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('diagnostique_liste') }}">Liste Diagnostics</a></li>
                     <li class="breadcrumb-item active">Completer</li>
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
               {{-- reception infos --}}
               <div class="col-md-12">
                  <div class="card card-primary collapsed-card">
                     <div class="card-header">
                        <h3 class="card-title">Rapport de Reception</h3>
                        <div class="card-tools">
                           <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-plus"></i>
                           </button>
                        </div>
                        <!-- /.card-tools -->
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <!-- Main content -->
                        <div class="content">
                           <div class="container-fluid">
                              <div class="row">
                                 <div class="col-md-8">
                                    <span>
                                       <h5><b>Receptioniste:</b></h5> {{ $reception->utilisateur->name }}
                                    </span>
                                 </div>
                                 <div class="col-md-4">
                                    <h4><b>Date de réception:</b><span>
                                          {{ $reception->created_at->format('d-m-Y') }}</span></h4>
                                    <h4 class="text-danger"><b>Numéro OR:</b><span> {{ $reception->code }}</span>
                                    </h4>
                                 </div>
                              </div>
                              <div class="card-body">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <h3>IDENTIFICATION DU CLIENT</h3>
                                       @if ($reception->personneLinked->nature() === 'particulier')
                                          <table style="width: 75%" class="table table-bordered">
                                             <tbody>
                                                <tr>
                                                   <th>Client</th>
                                                   <td>{{ $reception->personneLinked->nom_complet }}</td>
                                                </tr>
                                                <tr>
                                                   <th>Email</th>
                                                   <td>{{ $reception->personneLinked->email }}</td>
                                                </tr>
                                                <tr>
                                                   <th>Contact</th>
                                                   <td>{{ $reception->personneLinked->telephone }}</td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       @endif
                                       @if ($reception->personneLinked->nature() === 'assurance')
                                          <table style="width: 50%" class="table table-bordered">
                                             <tbody>
                                                <tr>
                                                   <th>Assurance</th>
                                                   <td>{{ $reception->personneLinked->nom_assurance }}</td>
                                                </tr>
                                                <tr>
                                                   <th>Représentant</th>
                                                   <td>{{ $reception->personneLinked->representant_assurance }}
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <th>Email</th>
                                                   <td>{{ $reception->personneLinked->email_assurance }}</td>
                                                </tr>
                                                <tr>
                                                   <th>Contact</th>
                                                   <td>{{ $reception->personneLinked->contact_assurance }}</td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       @endif
                                       @if ($reception->personneLinked->nature() === 'entreprise')
                                          <table class="table table-bordered">
                                             <tbody>
                                                <tr>
                                                   <th>Entreprise</th>
                                                   <td>{{ $reception->personneLinked->nom_entreprise }}</td>
                                                </tr>
                                                <tr>
                                                   <th>Représentant</th>
                                                   <td>{{ $reception->personneLinked->representant_entreprise }}
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <th>Email</th>
                                                   <td>{{ $reception->personneLinked->email_entreprise }}</td>
                                                </tr>
                                                <tr>
                                                   <th>Contact</th>
                                                   <td>{{ $reception->personneLinked->contact_entreprise }}</td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       @endif
                                    </div>
                                    <div class="col-md-6">
                                       <h3>RESSENTI DU CLIENT</h3>
                                       <dd>{{ $reception->ressenti }}</dd>
                                    </div>
                                 </div>
                                 <hr>
                                 <h3>CHECKLIST</h3>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <table class="show-table">
                                          <thead>
                                             <tr>
                                                <th>COMPARTIMENTS</th>
                                                <th>ETAT</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr class="active-row">
                                                <td colspan="2"><b>Intérieur</b></td>
                                             </tr>
                                             <tr>
                                                <td>Eclairage intérieur</td>
                                                <td>{{ $reception->etat->eclairage_int }}</td>
                                             </tr>
                                             <tr>
                                                <td>Rétroviseur</td>
                                                <td>{{ $reception->etat->retroviseurs_int }}</td>
                                             </tr>
                                             <tr>
                                                <td>Klaxon</td>
                                                <td>{{ $reception->etat->klaxon }}</td>
                                             </tr>
                                             <tr>
                                                <td>Essuies glaces</td>
                                                <td>{{ $reception->etat->essuies_glace }}</td>
                                             </tr>
                                             <tr>
                                                <td>Radio</td>
                                                <td>{{ $reception->etat->radio }}</td>
                                             </tr>
                                             <tr>
                                                <td>Climatisation</td>
                                                <td>{{ $reception->etat->climatisation }}</td>
                                             </tr>
                                             <tr>
                                                <td>Frein de stationnement</td>
                                                <td>{{ $reception->etat->frein_stationnement }}</td>
                                             </tr>
                                             <tr>
                                                <td>Sièges</td>
                                                <td>{{ $reception->etat->sieges }}</td>
                                             </tr>
                                             <tr>
                                                <td>Tableau de bord</td>
                                                <td>{{ $reception->etat->tableau_bord }}</td>
                                             </tr>
                                             <tr>
                                                <td>lève vitre</td>
                                                <td>{{ $reception->etat->leve_vitre }}</td>
                                             </tr>
                                             <tr>
                                                <td>Vérouillage des portes</td>
                                                <td>{{ $reception->etat->verrouillage_portes }}</td>
                                             </tr>
                                             <tr>
                                                <td>Ouverture des portes intérieur</td>
                                                <td>{{ $reception->etat->ouverture_portes_int }}</td>
                                             </tr>
                                             <tr class="active-row">
                                                <td colspan="2"><b>Extérieur</b></td>
                                             </tr>
                                             <tr>
                                                <td>Roues</td>
                                                <td>{{ $reception->etat->roues }}</td>
                                             </tr>
                                             <tr>
                                                <td>Feux arrières</td>
                                                <td>{{ $reception->etat->feux_arrieres }}</td>
                                             </tr>
                                             <tr>
                                                <td>Balais éssuies glaces av</td>
                                                <td>{{ $reception->etat->balais_essuies_glace_av }}</td>
                                             </tr>
                                             <tr>
                                                <td>Balais éssuies glaces ar</td>
                                                <td>{{ $reception->etat->balais_essuies_glace_ar }}</td>
                                             </tr>
                                             <tr>
                                                <td>Trappe de carburant</td>
                                                <td>{{ $reception->etat->trape_carburant }}</td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                    <div class="col-md-6">
                                       <table class="show-table">
                                          <tbody>
                                             <tr>
                                                <td>Ouverture des portes extérieur</td>
                                                <td>{{ $reception->etat->ouverture_portes_ext }}</td>
                                             </tr>
                                             <tr>
                                                <td>Sièges</td>
                                                <td>{{ $reception->etat->sieges }}</td>
                                             </tr>
                                             <tr>
                                                <td>Clé de contact</td>
                                                <td>{{ $reception->etat->cle_contact }}</td>
                                             </tr>
                                             <tr>
                                                <td>Rétroviseus extérieur</td>
                                                <td>{{ $reception->etat->retroviseurs_ext }}</td>
                                             </tr>
                                             <tr>
                                                <td>Clignotants</td>
                                                <td>{{ $reception->etat->clignotants }}</td>
                                             </tr>
                                             <tr>
                                                <td>Veilleuses</td>
                                                <td>{{ $reception->etat->veilleuses }}</td>
                                             </tr>
                                             <tr>
                                                <td>Feux de croisement</td>
                                                <td>{{ $reception->etat->feux_croisement }}</td>
                                             </tr>
                                             <tr>
                                                <td>feux STOP</td>
                                                <td>{{ $reception->etat->feux_stop }}</td>
                                             </tr>
                                             <tr>
                                                <td>Feux de recul</td>
                                                <td>{{ $reception->etat->feux_recul }}</td>
                                             </tr>
                                             <tr>
                                                <td>Feux antibrouillards</td>
                                                <td>{{ $reception->etat->feux_antibrouillard }}</td>
                                             </tr>
                                             <tr>
                                                <td>Cric</td>
                                                <td>{{ $reception->etat->cric }}</td>
                                             </tr>
                                             <tr>
                                                <td>Roue de secours</td>
                                                <td>{{ $reception->etat->roues_secours }}</td>
                                             </tr>
                                             <tr>
                                                <td>Manivelles</td>
                                                <td>{{ $reception->etat->manivelle }}</td>
                                             </tr>
                                             <tr>
                                                <td>Trousses</td>
                                                <td>{{ $reception->etat->trousse }}</td>
                                             </tr>
                                             <tr class="active-row">
                                                <td colspan="2"><b>Sous le capot</b></td>
                                             </tr>
                                             <tr>
                                                <td>Huile de moteur</td>
                                                <td>{{ $reception->etat->huile_moteur }}</td>
                                             </tr>
                                             <tr>
                                                <td>Huile de frein</td>
                                                <td>{{ $reception->etat->huile_frein }}</td>
                                             </tr>
                                             <tr>
                                                <td>Huile de direction</td>
                                                <td>{{ $reception->etat->huile_direction }}</td>
                                             </tr>
                                             <tr>
                                                <td>Liquide de refroidissement</td>
                                                <td>{{ $reception->etat->liquide_refroidissement }}</td>
                                             </tr>
                                             <tr>
                                                <td>Liquide lave glace</td>
                                                <td>{{ $reception->etat->liquide_lave_glace }}</td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                    <div class="col-md-6">
                                       <h3>IDENTIFICATION DU VEHICULE</h3>
                                       <table class="show-table">
                                          <tbody>
                                             <tr class="active-row">
                                                <th>Déposant</th>
                                                <td>{{ $reception->vehicule->nom_deposant }}</td>
                                             </tr>
                                             <tr class="active-row">
                                                <th>Véhicule</th>
                                                <td>
                                                   {{ $reception->vehicule->marque . ' ' . $reception->vehicule->modele . ' ' . $reception->vehicule->type_vehicule . ' ' . $reception->vehicule->annee . ' ' . $reception->vehicule->couleur }}
                                                </td>
                                             </tr>
                                             <tr class="active-row">
                                                <th>Immatriculation</th>
                                                <td>{{ $reception->vehicule->immatriculation }}</td>
                                             </tr>
                                             <tr class="active-row">
                                                <th>Chassis</th>
                                                <td>{{ $reception->vehicule->chassis }}</td>
                                             </tr>
                                             <tr class="active-row">
                                                <th>DMC</th>
                                                <td>{{ $reception->vehicule->dmc }}</td>
                                             </tr>
                                             <tr class="active-row">
                                                <th>Date SITCA</th>
                                                <td>{{ $reception->vehicule->date_sitca->format('d-m-Y') }}</td>
                                             </tr>
                                             <tr class="active-row">
                                                <th>Date assurance</th>
                                                <td>{{ $reception->vehicule->date_assurance->format('d-m-Y') }}
                                                </td>
                                             </tr>
                                             <tr class="active-row">
                                                <th>Kilométrage actuel</th>
                                                <td>{{ $reception->vehicule->kilometrage_actuel }}</td>
                                             </tr>
                                             <tr class="active-row">
                                                <th>Prochaîne vidange</th>
                                                <td>{{ $reception->vehicule->prochaine_vidange }}</td>
                                             </tr>
                                             <tr class="active-row">
                                                <th>Enjoliveur</th>
                                                <td>{{ $reception->vehicule->enjoliveur }}</td>
                                             </tr>
                                             <tr class="active-row">
                                                <th>Niveau de carburant</th>
                                                <td>{{ $reception->vehicule->niveau_carburant }}</td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>

                           </div>
                        </div>

                     </div>
                     <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
               </div>
               <!-- /.col-md-12 -->
               {{-- essais infos --}}
               <div class="col-md-12">
                  <div class="card card-primary collapsed-card">
                     <div class="card-header">
                        <h3 class="card-title">Rapport d'essai avant réparation</h3>
                        <div class="card-tools">
                           <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                 class="fas fa-plus"></i>
                           </button>
                        </div>
                        <!-- /.card-tools -->
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <div class="form-group">
                           <div class="row">
                              <div class="col-md-8">
                                 <span><b>Essayeur:</b> {{ $reception->preessai->utilisateur->name }}</span>
                              </div>
                              <div style="text-align: right" class="col-md-4">
                                 <i class="far fa-sm fa-clock"></i>
                                 <small
                                    class="text-muted">{{ $reception->preessai->created_at->diffForHumans(['parts' => 3, 'short' => true]) }}</small>
                              </div>
                           </div>
                           <textarea class="form-control" disabled cols="30"
                              rows="6">{{ $reception->preessai->commentaire }}</textarea>
                        </div>
                     </div>
                     <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
               </div>
               {{-- prediagnostique --}}
               <div class="col-md-12">
                  <div class="card card-primary collapsed-card">
                     <div class="card-header">
                        <h3 class="card-title">Checklist de Pré-diagnostique</h3>
                        <div class="card-tools">
                           <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                 class="fas fa-plus"></i>
                           </button>
                        </div>
                        <!-- /.card-tools -->
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        @empty($reception->prediagnostique)
                           <form action="{{ route('prediagnostique_store') }}" method="POST">
                              @csrf
                              <input name="reception" value="{{ $reception->id }}" type="text" hidden>
                              <h5 class="text-primary"><b>Inspection</b></h5>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="protection_interne">Protection interne</label>
                                       <textarea name="protection_interne" class="form-control" id="protection_interne"
                                          cols="30" rows="6">{{ old('protection_interne') }}</textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="housse_protection">Housse de protection</label>
                                       <textarea name="housse_protection" class="form-control" id="housse_protection"
                                          cols="30" rows="6">{{ old('housse_protection') }}</textarea>
                                    </div>
                                 </div>
                              </div>
                              <h5 class="text-primary"><b>Contrôle d'intérieur</b></h5>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="eclairage_int">Eclairage intérieur</label>
                                       <textarea name="eclairage_int" class="form-control" id="eclairage_int" cols="30"
                                          rows="6">{{ old('eclairage_int') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="eclairage_int">Eclairage intérieur</label>
                                       <textarea name="eclairage_int" class="form-control" id="eclairage_int" cols="30"
                                          rows="6">{{ old('eclairage_int') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="klaxon">Klaxon</label>
                                       <textarea name="klaxon" class="form-control" id="klaxon" cols="30"
                                          rows="6">{{ old('klaxon') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="pedale_frein">Jeu de pédale de frein</label>
                                       <textarea name="pedale_frein" class="form-control" id="pedale_frein" cols="30"
                                          rows="6">{{ old('pedale_frein') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="pedale_embreillage">Jeu de pédale d'embrayage</label>
                                       <textarea name="pedale_embreillage" class="form-control" id="pedale_embreillage"
                                          cols="30" rows="6">{{ old('pedale_embreillage') }}</textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="frein_main">Frein à main</label>
                                       <textarea name="frein_main" class="form-control" id="frein_main" cols="30"
                                          rows="6">{{ old('frein_main') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="ceintures_securite">Etat de fonctionnement des ceintures de
                                          securite</label>
                                       <textarea name="ceintures_securite" class="form-control" id="ceintures_securite"
                                          cols="30" rows="6">{{ old('ceintures_securite') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="feux_phares">Feux et phares</label>
                                       <textarea placeholder="Etat de fonctionnement des feux et phares (frein,parking, ...)"
                                          name="feux_phares" class="form-control" id="feux_phares" cols="30"
                                          rows="6">{{ old('feux_phares') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="balais_eg">balais essuies glace</label>
                                       <textarea
                                          placeholder="fonctionnement des balais essuies glace , moteur et bocal lave glace"
                                          name="balais_eg" class="form-control" id="balais_eg" cols="30"
                                          rows="6">{{ old('balais_eg') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="leve_vitre">Fonctionnement des leves vitre</label>
                                       <textarea name="leve_vitre" class="form-control" id="leve_vitre" cols="30"
                                          rows="6">{{ old('leve_vitre') }}</textarea>
                                    </div>
                                 </div>
                              </div>
                              <h5 class="text-primary"><b>Contrôle extérieur</b></h5>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="eraflures">Eraflures</label>
                                       <textarea name="eraflures" class="form-control" id="eraflures" cols="30"
                                          rows="6">{{ old('eraflures') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="corrosion_rouille">Corrosion, rouille</label>
                                       <textarea name="corrosion_rouille" class="form-control" id="corrosion_rouille"
                                          cols="30" rows="6">{{ old('corrosion_rouille') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="elements_endommages">Elements endommagés</label>
                                       <textarea name="elements_endommages" class="form-control" id="elements_endommages"
                                          cols="30" rows="6">{{ old('elements_endommages') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="clarte_feux_phares">Clarte des feux et phares</label>
                                       <textarea name="clarte_feux_phares" class="form-control" id="clarte_feux_phares"
                                          cols="30" rows="6">{{ old('clarte_feux_phares') }}</textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="etat_balais_eg">Etat des balais essuies glace</label>
                                       <textarea name="etat_balais_eg" class="form-control" id="etat_balais_eg" cols="30"
                                          rows="6">{{ old('etat_balais_eg') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="trape_carburant">Trappe à carburant</label>
                                       <textarea name="trape_carburant" class="form-control" id="trape_carburant" cols="30"
                                          rows="6">{{ old('trape_carburant') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="poignees_portes">Les poignees de portes</label>
                                       <textarea name="poignees_portes" class="form-control" id="poignees_portes" cols="30"
                                          rows="6">{{ old('poignees_portes') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="pneux_pression_usure">Etat des pneux, pression et profondeur
                                          d'usure</label>
                                       <textarea name="pneux_pression_usure" class="form-control" id="pneux_pression_usure"
                                          cols="30" rows="6">{{ old('pneux_pression_usure') }}</textarea>
                                    </div>
                                 </div>
                              </div>
                              <h5 class="text-primary"><b>Sous le capot</b></h5>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="niveaux_liquides">niveau des liquides</label>
                                       <textarea placeholder="moteur, frein, direction, réfroidissement ..."
                                          name="niveaux_liquides" class="form-control" id="niveaux_liquides" cols="30"
                                          rows="6">{{ old('niveaux_liquides') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="raccords_durite">Raccords et durite de carburant</label>
                                       <textarea name="raccords_durite" class="form-control" id="raccords_durite" cols="30"
                                          rows="6">{{ old('raccords_durite') }}</textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="batterie_cosses">Etat de la batterie et des cosses</label>
                                       <textarea name="batterie_cosses" class="form-control" id="batterie_cosses" cols="30"
                                          rows="6">{{ old('batterie_cosses') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="etat_radiateur">Etat du radiateur</label>
                                       <textarea name="etat_radiateur" class="form-control" id="etat_radiateur" cols="30"
                                          rows="6">{{ old('etat_radiateur') }}</textarea>
                                    </div>
                                 </div>
                              </div>
                              <h5 class="text-primary"><b>Sous le carosserie</b></h5>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="disques_tambours_frein">Plaquettes, disque et tambours de frein</label>
                                       <textarea name="disques_tambours_frein" class="form-control"
                                          id="disques_tambours_frein" cols="30"
                                          rows="6">{{ old('disques_tambours_frein') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="pneux_int">Intérieur des pneux</label>
                                       <textarea name="pneux_int" class="form-control" id="pneux_int" cols="30"
                                          rows="6">{{ old('pneux_int') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="suspensions">Suspensions</label>
                                       <textarea name="suspensions" class="form-control" id="suspensions" cols="30"
                                          rows="6">{{ old('suspensions') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="volant_direction">Volant, direction</label>
                                       <textarea name="volant_direction" class="form-control" id="volant_direction" cols="30"
                                          rows="6">{{ old('volant_direction') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="pot_echappement">Pot d'échappement</label>
                                       <textarea name="pot_echappement" class="form-control" id="pot_echappement" cols="30"
                                          rows="6">{{ old('pot_echappement') }}</textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="silent_bloc">Etat des silents blocs</label>
                                       <textarea name="silent_bloc" class="form-control" id="silent_bloc" cols="30"
                                          rows="6">{{ old('silent_bloc') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="tuyauterie_frein">Tuyauterie frein</label>
                                       <textarea name="tuyauterie_frein" class="form-control" id="tuyauterie_frein" cols="30"
                                          rows="6">{{ old('tuyauterie_frein') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="fuite_huile">Fuite d'huile</label>
                                       <textarea name="fuite_huile" class="form-control" id="fuite_huile" cols="30"
                                          rows="6">{{ old('fuite_huile') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="sous_carrosserie">Etat générale sous la carosserie</label>
                                       <textarea name="sous_carrosserie" class="form-control" id="sous_carrosserie" cols="30"
                                          rows="6">{{ old('sous_carrosserie') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="test_routier">Test routier</label>
                                       <textarea name="test_routier" class="form-control" id="test_routier" cols="30"
                                          rows="6">{{ old('test_routier') }}</textarea>
                                    </div>
                                 </div>
                              </div>
                              <div style="text-align: right" class="form-group">
                                 <button type="submit" class="btn btn-primary">
                                    Enregistrer
                                 </button>
                              </div>
                           </form>
                        @else
                           <form action="{{ route('prediagnostique_update') }}" method="POST">
                              @csrf
                              <input hidden name="prediadnostique" value="{{ $reception->prediagnostique->id }}" type="text">
                              <input name="reception" value="{{ $reception->id }}" type="text" hidden>
                              <h5 class="text-primary"><b>Inspection</b></h5>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="protection_interne">protection interne</label>
                                       <textarea name="protection_interne" class="form-control" id="protection_interne"
                                          cols="30" rows="6">{{ $reception->prediagnostique->protection_interne }}</textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="housse_protection">Housse de protection</label>
                                       <textarea name="housse_protection" class="form-control" id="housse_protection"
                                          cols="30" rows="6">{{ $reception->prediagnostique->housse_protection }}</textarea>
                                    </div>
                                 </div>
                              </div>
                              <h5 class="text-primary"><b>Contrôle d'intérieur</b></h5>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="eclairage_int">Eclairage intérieur</label>
                                       <textarea name="eclairage_int" class="form-control" id="eclairage_int" cols="30"
                                          rows="6">{{ $reception->prediagnostique->eclairage_int }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="eclairage_int">Eclairage intérieur</label>
                                       <textarea name="eclairage_int" class="form-control" id="eclairage_int" cols="30"
                                          rows="6">{{ $reception->prediagnostique->eclairage_int }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="klaxon">Klaxon</label>
                                       <textarea name="klaxon" class="form-control" id="klaxon" cols="30"
                                          rows="6">{{ $reception->prediagnostique->klaxon }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="pedale_frein">Jeu de pédale de frein</label>
                                       <textarea name="pedale_frein" class="form-control" id="pedale_frein" cols="30"
                                          rows="6">{{ $reception->prediagnostique->pedale_frein }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="pedale_embreillage">Jeu de pédale d'embrayage</label>
                                       <textarea name="pedale_embreillage" class="form-control" id="pedale_embreillage"
                                          cols="30" rows="6">{{ $reception->prediagnostique->pedale_embreillage }}</textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="frein_main">Frein à main</label>
                                       <textarea name="frein_main" class="form-control" id="frein_main" cols="30"
                                          rows="6">{{ $reception->prediagnostique->frein_main }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="ceintures_securite">Etat de fonctionnement des ceintures de
                                          securite</label>
                                       <textarea name="ceintures_securite" class="form-control" id="ceintures_securite"
                                          cols="30" rows="6">{{ $reception->prediagnostique->ceintures_securite }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="feux_phares">Feux et phares</label>
                                       <textarea placeholder="Etat de fonctionnement des feux et phares (frein,parking, ...)"
                                          name="feux_phares" class="form-control" id="feux_phares" cols="30"
                                          rows="6">{{ $reception->prediagnostique->feux_phares }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="balais_eg">balais essuies glace</label>
                                       <textarea
                                          placeholder="fonctionnement des balais essuies glace , moteur et bocal lave glace"
                                          name="balais_eg" class="form-control" id="balais_eg" cols="30"
                                          rows="6">{{ $reception->prediagnostique->balais_eg }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="leve_vitre">Fonctionnement des leves vitre</label>
                                       <textarea name="leve_vitre" class="form-control" id="leve_vitre" cols="30"
                                          rows="6">{{ $reception->prediagnostique->leve_vitre }}</textarea>
                                    </div>
                                 </div>
                              </div>
                              <h5 class="text-primary"><b>Contrôle extérieur</b></h5>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="eraflures">Eraflures</label>
                                       <textarea name="eraflures" class="form-control" id="eraflures" cols="30"
                                          rows="6">{{ $reception->prediagnostique->eraflures }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="corrosion_rouille">Corrosion, rouille</label>
                                       <textarea name="corrosion_rouille" class="form-control" id="corrosion_rouille"
                                          cols="30" rows="6">{{ $reception->prediagnostique->corrosion_rouille }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="elements_endommages">Elements endommagés</label>
                                       <textarea name="elements_endommages" class="form-control" id="elements_endommages"
                                          cols="30" rows="6">{{ $reception->prediagnostique->elements_endommages }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="clarte_feux_phares">Clarte des feux et phares</label>
                                       <textarea name="clarte_feux_phares" class="form-control" id="clarte_feux_phares"
                                          cols="30" rows="6">{{ $reception->prediagnostique->clarte_feux_phares }}</textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="etat_balais_eg">Etat des balais essuies glace</label>
                                       <textarea name="etat_balais_eg" class="form-control" id="etat_balais_eg" cols="30"
                                          rows="6">{{ $reception->prediagnostique->etat_balais_eg }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="trape_carburant">Trappe à carburant</label>
                                       <textarea name="trape_carburant" class="form-control" id="trape_carburant" cols="30"
                                          rows="6">{{ $reception->prediagnostique->trape_carburant }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="poignees_portes">Les poignees de portes</label>
                                       <textarea name="poignees_portes" class="form-control" id="poignees_portes" cols="30"
                                          rows="6">{{ $reception->prediagnostique->poignees_portes }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="pneux_pression_usure">Etat des pneux, pression et profondeur
                                          d'usure</label>
                                       <textarea name="pneux_pression_usure" class="form-control" id="pneux_pression_usure"
                                          cols="30"
                                          rows="6">{{ $reception->prediagnostique->pneux_pression_usure }}</textarea>
                                    </div>
                                 </div>
                              </div>
                              <h5 class="text-primary"><b>Sous le capot</b></h5>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="niveaux_liquides">niveau des liquides</label>
                                       <textarea placeholder="moteur, frein, direction, réfroidissement ..."
                                          name="niveaux_liquides" class="form-control" id="niveaux_liquides" cols="30"
                                          rows="6">{{ $reception->prediagnostique->niveaux_liquides }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="raccords_durite">Raccords et durite de carburant</label>
                                       <textarea name="raccords_durite" class="form-control" id="raccords_durite" cols="30"
                                          rows="6">{{ $reception->prediagnostique->raccords_durite }}</textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="batterie_cosses">Etat de la batterie et des cosses</label>
                                       <textarea name="batterie_cosses" class="form-control" id="batterie_cosses" cols="30"
                                          rows="6">{{ $reception->prediagnostique->batterie_cosses }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="etat_radiateur">Etat du radiateur</label>
                                       <textarea name="etat_radiateur" class="form-control" id="etat_radiateur" cols="30"
                                          rows="6">{{ $reception->prediagnostique->etat_radiateur }}</textarea>
                                    </div>
                                 </div>
                              </div>
                              <h5 class="text-primary"><b>Sous le carosserie</b></h5>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="disques_tambours_frein">Plaquettes, disque et tambours de frein</label>
                                       <textarea name="disques_tambours_frein" class="form-control"
                                          id="disques_tambours_frein" cols="30"
                                          rows="6">{{ $reception->prediagnostique->disques_tambours_frein }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="pneux_int">Intérieur des pneux</label>
                                       <textarea name="pneux_int" class="form-control" id="pneux_int" cols="30"
                                          rows="6">{{ $reception->prediagnostique->pneux_int }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="suspensions">Suspensions</label>
                                       <textarea name="suspensions" class="form-control" id="suspensions" cols="30"
                                          rows="6">{{ $reception->prediagnostique->suspensions }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="volant_direction">Volant, direction</label>
                                       <textarea name="volant_direction" class="form-control" id="volant_direction" cols="30"
                                          rows="6">{{ $reception->prediagnostique->volant_direction }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="pot_echappement">Pot d'échappement</label>
                                       <textarea name="pot_echappement" class="form-control" id="pot_echappement" cols="30"
                                          rows="6">{{ $reception->prediagnostique->pot_echappement }}</textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="silent_bloc">Etat des silents blocs</label>
                                       <textarea name="silent_bloc" class="form-control" id="silent_bloc" cols="30"
                                          rows="6">{{ $reception->prediagnostique->silent_bloc }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="tuyauterie_frein">Tuyauterie frein</label>
                                       <textarea name="tuyauterie_frein" class="form-control" id="tuyauterie_frein" cols="30"
                                          rows="6">{{ $reception->prediagnostique->tuyauterie_frein }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="fuite_huile">Fuite d'huile</label>
                                       <textarea name="fuite_huile" class="form-control" id="fuite_huile" cols="30"
                                          rows="6">{{ $reception->prediagnostique->fuite_huile }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="sous_carrosserie">Etat générale sous la carrosserie</label>
                                       <textarea name="sous_carrosserie" class="form-control" id="sous_carrosserie" cols="30"
                                          rows="6">{{ $reception->prediagnostique->sous_carrosserie }}</textarea>
                                    </div>
                                    <div class="form-group">
                                       <label for="test_routier">Test routier</label>
                                       <textarea name="test_routier" class="form-control" id="test_routier" cols="30"
                                          rows="6">{{ $reception->prediagnostique->test_routier }}</textarea>
                                    </div>
                                 </div>
                              </div>
                              <div style="text-align: right" class="form-group">
                                 <button type="submit" class="btn btn-primary">
                                    Enregistrer
                                 </button>
                              </div>
                           </form>
                        @endempty
                     </div>
                     <!-- /.card-body -->

                  </div>
                  <!-- /.card -->
               </div>
               {{-- anciennes interventions --}}
               <div class="col-md-12">
                  <div class="card  collapsed-card">
                     <div class="card-header">
                        <h3 class="card-title">Interventions de Diagnostique</h3>
                        <div class="card-tools">
                           <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                 class="fas fa-plus"></i>
                           </button>
                        </div>
                        <!-- /.card-tools -->
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <old-intervention :interventions="{{ $interventions }}"></old-intervention>
                     </div>
                     <!-- /.card-body -->
                  </div>
               </div>
               {{-- formulaire intervention diagnostique --}}
               <div class="col-md-12">
                  <form-diagnostique :ateliers="{{ $ateliers }}" :reception="{{ $reception->id }}"></form-diagnostique>
               </div>
            </div>
            <!-- /.row -->

         </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->
@endsection
