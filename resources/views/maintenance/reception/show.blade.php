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
               <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Détails de réception</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('acceuil') }}">Acceuil principale</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('reception_liste') }}">Réceptions</a></li>
                     <li class="breadcrumb-item active">{{ $reception->code }}</li>
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
               <div class="col-lg-12">
                  <div class="card">
                     @if (!$reception->est_valide())
                        <div class="card-header">
                           <div class="row">
                              <div class="col-md-10"></div>
                              <div class="col-md-2">
                                 <a class="btn btn-success ui-button" href="{{ route('reception_valider', $reception) }}">
                                    <i class="fas fa-lg fa-check-circle"></i>
                                    valider
                                 </a>
                              </div>
                           </div>
                        </div>
                     @endif
                     <div class="row">
                        <div class="col-md-8">
                           <a target="_blank" class="btn btn-primary" href="{{ route('reception_print', $reception) }}">
                              <i class="fas fa-print"></i> imprimer
                           </a>
                        </div>
                        <div class="col-md-4">
                           <h4><b>Date de réception:</b><span> {{ $reception->created_at->format('d-m-Y') }}</span></h4>
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
                                          <td>{{ $reception->personneLinked->representant_assurance }}</td>
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
                                          <td>{{ $reception->personneLinked->representant_entreprise }}</td>
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
                        <div style="margin-bottom: 2%" class="row">
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
                        </div>
                        <div class="row">
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
                                       <td>{{ $reception->vehicule->date_assurance->format('d-m-Y') }}</td>
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
                                       <td>{{ $enjoliveurs }}</td>
                                    </tr>
                                    <tr class="active-row">
                                       <th>Niveau de carburant</th>
                                       <td>{{ $reception->vehicule->niveau_carburant }}</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                           <div class="col-md-6">
                              <img style="padding: 12% ; margin-top: 2%; margin-left:4%"
                                 src="{{ asset('images/dessein.png') }}" width="508" height="369" alt="dessein">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
