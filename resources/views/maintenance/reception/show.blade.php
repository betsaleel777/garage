@extends('layouts.default')
@section('module-navbar')
   @include('partials.modules.nav-maintenance')
@endsection
@section('style')
   <link href="{{ asset('dist/css/venobox.min.css') }}" rel="stylesheet" />
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
                     <li class="breadcrumb-item"><a href="{{ route('maintenance_index') }}">Tableau de maintenance</a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{ route('receptions') }}">Tableau des réceptions</a></li>
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
                     <div class="card-header">
                        <div class="row">
                           <div class="col-md-10"></div>
                           <div class="col-md-2">
                              <a target="_blank" class="btn btn-primary"
                                 href="{{ route('reception_print', $reception) }}">
                                 <i class="fas fa-print"></i> imprimer
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-4">
                           <h4><b>Date de réception:</b><span> {{ $reception->created_at->format('d-m-Y') }}</span></h4>
                           <h4 class="text-danger"><b>Numéro OR:</b><span> {{ $reception->code }}</span>
                           </h4>
                        </div>
                     </div>
                     <div class="card-body">
                        <div class="row">
                           {{-- identification du client --}}
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
                           {{-- identification du véhicule --}}
                           <div class="col-md-6">
                              <h3>IDENTIFICATION DU VEHICULE</h3>
                              <table class="show-table-short">
                                 <tbody>
                                    <tr class="active-row">
                                       <th>Déposant</th>
                                       <td>{{ $reception->vehicule->nom_deposant }}</td>
                                    </tr>
                                    <tr class="active-row">
                                       <th>Véhicule</th>
                                       <td>
                                          {{ $reception->vehicule->auto->marque . ' ' . $reception->vehicule->auto->modele . ' ' . $reception->vehicule->auto->type_vehicule . ' ' . $reception->vehicule->auto->annee . ' ' . $reception->vehicule->auto->couleur }}
                                       </td>
                                    </tr>
                                    <tr class="active-row">
                                       <th>Immatriculation</th>
                                       <td>{{ $reception->vehicule->auto->immatriculation }}</td>
                                    </tr>
                                    <tr class="active-row">
                                       <th>Chassis</th>
                                       <td>{{ $reception->vehicule->auto->chassis }}</td>
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
                        </div>
                        <hr>
                        {{-- checklist --}}
                        <div class="row">
                           <div class="col-md-4">
                              <h3>CHECKLIST</h3>
                           </div>
                           <div style="text-align: right" class="col-md-8">
                              <span class="text-muted">{ I: inexistant , B: bon, P: passable, M: mauvais }</span>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <table class="show-table">
                                 <thead>
                                    <tr>
                                       <th>COMPARTIMENTS</th>
                                       <th>I</th>
                                       <th>B</th>
                                       <th>P</th>
                                       <th>M</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr class="active-row">
                                       <td colspan="5"><b>Intérieur</b></td>
                                    </tr>
                                    <tr>
                                       <td>Eclairage intérieur</td>
                                       <td>
                                          @if ($reception->etat->eclairage_int === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->eclairage_int === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->eclairage_int === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->eclairage_int === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Rétroviseur</td>
                                       <td>
                                          @if ($reception->etat->retroviseurs_int === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->retroviseurs_int === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->retroviseurs_int === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->retroviseurs_int === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Klaxon</td>
                                       <td>
                                          @if ($reception->etat->klaxon === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->klaxon === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->klaxon === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->klaxon === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Essuies glaces</td>
                                       <td>
                                          @if ($reception->etat->essuies_glace === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->essuies_glace === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->essuies_glace === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->essuies_glace === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Radio</td>
                                       <td>
                                          @if ($reception->etat->radio === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->radio === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->radio === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->radio === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Climatisation</td>
                                       <td>
                                          @if ($reception->etat->climatisation === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->climatisation === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->climatisation === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->climatisation === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Frein de stationnement</td>
                                       <td>
                                          @if ($reception->etat->frein_stationnement === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->frein_stationnement === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->frein_stationnement === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->frein_stationnement === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Sièges</td>
                                       <td>
                                          @if ($reception->etat->sieges === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->sieges === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->sieges === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->sieges === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Tableau de bord</td>
                                       <td>
                                          @if ($reception->etat->tableau_bord === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->tableau_bord === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->tableau_bord === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->tableau_bord === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>lève vitre</td>
                                       <td>
                                          @if ($reception->etat->leve_vitre === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->leve_vitre === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->leve_vitre === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->leve_vitre === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Vérouillage des portes</td>
                                       <td>
                                          @if ($reception->etat->verrouillage_portes === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->verrouillage_portes === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->verrouillage_portes === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->verrouillage_portes === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Ouverture des portes intérieur</td>
                                       <td>
                                          @if ($reception->etat->ouverture_portes_int === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->ouverture_portes_int === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->ouverture_portes_int === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->ouverture_portes_int === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr class="active-row">
                                       <td colspan="5"><b>Extérieur</b></td>
                                    </tr>
                                    <tr>
                                       <td>Roues</td>
                                       <td>
                                          @if ($reception->etat->roues === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->roues === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->roues === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->roues === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Feux arrières</td>
                                       <td>
                                          @if ($reception->etat->feux_arrieres === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->feux_arrieres === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->feux_arrieres === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->feux_arrieres === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Balais éssuies glaces av</td>
                                       <td>
                                          @if ($reception->etat->balais_essuies_glace_av === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->balais_essuies_glace_av === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->balais_essuies_glace_av === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->balais_essuies_glace_av === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Balais éssuies glaces ar</td>
                                       <td>
                                          @if ($reception->etat->balais_essuies_glace_ar === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->balais_essuies_glace_ar === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->balais_essuies_glace_ar === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->balais_essuies_glace_ar === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Trappe de carburant</td>
                                       <td>
                                          @if ($reception->etat->trape_carburant === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->trape_carburant === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->trape_carburant === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->trape_carburant === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>*</td>
                                       <td>*</td>
                                       <td>*</td>
                                       <td>*</td>
                                       <td>*</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                           <div class="col-md-6">
                              <table class="show-table">
                                 <thead>
                                    <tr>
                                       <th>COMPARTIMENTS</th>
                                       <th>I</th>
                                       <th>B</th>
                                       <th>P</th>
                                       <th>M</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>Ouverture des portes extérieur</td>
                                       <td>
                                          @if ($reception->etat->ouverture_portes_ext === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->ouverture_portes_ext === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->ouverture_portes_ext === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->ouverture_portes_ext === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Sièges</td>
                                       <td>
                                          @if ($reception->etat->sieges === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->sieges === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->sieges === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->sieges === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Clé de contact</td>
                                       <td>
                                          @if ($reception->etat->cle_contact === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->cle_contact === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->cle_contact === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->cle_contact === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Rétroviseurs extérieur</td>
                                       <td>
                                          @if ($reception->etat->retroviseurs_ext === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->retroviseurs_ext === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->retroviseurs_ext === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->retroviseurs_ext === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Clignotants</td>
                                       <td>
                                          @if ($reception->etat->clignotants === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->clignotants === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->clignotants === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->clignotants === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Veilleuses</td>
                                       <td>
                                          @if ($reception->etat->veilleuses === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->veilleuses === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->veilleuses === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->veilleuses === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Feux de croisement</td>
                                       <td>
                                          @if ($reception->etat->feux_croisement === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->feux_croisement === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->feux_croisement === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->feux_croisement === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>feux STOP</td>
                                       <td>
                                          @if ($reception->etat->feux_stop === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->feux_stop === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->feux_stop === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->feux_stop === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Feux de recul</td>
                                       <td>
                                          @if ($reception->etat->feux_recul === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->feux_recul === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->feux_recul === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->feux_recul === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Feux antibrouillards</td>
                                       <td>
                                          @if ($reception->etat->feux_antibrouillard === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->feux_antibrouillard === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->feux_antibrouillard === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->feux_antibrouillard === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Cric</td>
                                       <td>
                                          @if ($reception->etat->cric === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->cric === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->cric === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->cric === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Roue de secours</td>
                                       <td>
                                          @if ($reception->etat->roues_secours === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->roues_secours === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->roues_secours === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->roues_secours === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Manivelles</td>
                                       <td>
                                          @if ($reception->etat->manivelle === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->manivelle === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->manivelle === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->manivelle === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Trousses</td>
                                       <td>
                                          @if ($reception->etat->trousse === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->trousse === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->trousse === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->trousse === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr class="active-row">
                                       <td colspan="5"><b>Sous le capot</b></td>
                                    </tr>
                                    <tr>
                                       <td>Huile de moteur</td>
                                       <td>
                                          @if ($reception->etat->huile_moteur === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->huile_moteur === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->huile_moteur === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->huile_moteur === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Huile de frein</td>
                                       <td>
                                          @if ($reception->etat->huile_frein === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->huile_frein === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->huile_frein === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->huile_frein === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Huile de direction</td>
                                       <td>
                                          @if ($reception->etat->huile_direction === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->huile_direction === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->huile_direction === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->huile_direction === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Liquide de refroidissement</td>
                                       <td>
                                          @if ($reception->etat->liquide_refroidissement === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->liquide_refroidissement === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->liquide_refroidissement === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->liquide_refroidissement === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Liquide lave glace</td>
                                       <td>
                                          @if ($reception->etat->liquide_lave_glace === 'inexistant')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->liquide_lave_glace === 'bon')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->liquide_lave_glace === 'passable')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                       <td>
                                          @if ($reception->etat->liquide_lave_glace === 'mauvais')
                                             <span class="text-primary"><i class="fas fa-check"></i></span>
                                          @endif
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="row">
                           {{-- ressenti du client --}}
                           <div class="col-md-6">
                              <h3>RESSENTI DU CLIENT</h3>
                              <dd>{{ $reception->ressenti }}</dd>
                           </div>
                           {{-- schéma du véhicule en morceaux --}}
                           <div class="col-md-6">
                              <img style="padding: 12% ; margin-top: 2%; margin-left:4%"
                                 src="{{ asset('images/dessein.png') }}" width="508" height="369" alt="dessein">
                           </div>
                        </div>
                        {{-- commentaire de reception avec pieces jointes --}}
                        @if (!empty($reception->commentaire->contenu) or !empty($boxData) or !empty($dowloadables))
                           <h3>COMMENTAIRE DU RECEPTIONISTE</h3>
                           <hr>
                           {{-- commentaire de reception --}}
                           <div style="margin-bottom: 2%" class="row">
                              <div class="col-md-6">
                                 <dd>{{ $reception->commentaire->contenu }}</dd>
                              </div>
                              <div class="col-md-6">
                                 @if (!empty($boxData))
                                    @foreach ($boxData as $item)
                                       @if ($item['type'] === 'image')
                                          <a class="venobox" data-gall="myGallery" title="{{ $item['caption'] }}"
                                             href="{{ url('storage/' . $item['src']) }}">
                                             <img width="100" height="100" src="{{ url('storage/' . $item['src']) }}" />
                                          </a>
                                       @else
                                          <a class="venobox" data-gall="myGallery" data-autoplay="true" data-vbtype="video"
                                             href="{{ url('storage/' . $item['src']) }}">
                                             {{ $item['caption'] }}
                                          </a>
                                       @endif
                                    @endforeach
                                 @endif
                                 @if (!empty($downloadables))
                                    <p>
                                    <h6>Documents</h6>
                                    <ul>
                                       @foreach ($downloadables as $item)
                                          <li>
                                             <a href="{{ url('storage/media_reception/' . $item['media']) }}" download>
                                                {{ $item['nom'] }}
                                             </a>
                                          </li>
                                       @endforeach
                                    </ul>
                                    </p>
                                 @endif
                              </div>
                           </div>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
@section('scripts')
   <script src="{{ asset('dist/js/venobox.min.js') }}"></script>
   <script>
      $('.venobox').venobox({
         // color of navigation arroes
         arrowsColor: '#B6B6B6',

         // same as data-autoplay
         autoplay: false,

         // background color
         bgcolor: '#fff',

         // border
         border: '0',

         // background color of close button
         closeBackground: '#161617',

         // colr of close button
         closeColor: "#d2d2d2",

         // frame width/height
         framewidth: '',
         frameheight: '',

         // show items as a gallery
         gallItems: false,

         // infinite loop
         infinigall: false,

         // custom controls
         htmlClose: '&times;',
         htmlNext: '<span>Next</span>',
         htmlPrev: '<span>Prev</span>',

         // shows counter
         numeratio: false,

         // background color of counter
         numerationBackground: '#161617',

         // counter color
         numerationColor: '#d2d2d2',

         // 'top' || 'bottom'
         numerationPosition: 'top',

         // close the lightbox by clicking the background overlay
         overlayClose: true,

         // color of the background overlay
         overlayColor: 'rgba(23,23,23,0.85)',

         // available: 'rotating-plane' | 'double-bounce' | 'wave' | 'wandering-cubes' | 'spinner-pulse' | 'chasing-dots' | 'three-bounce' | 'circle' | 'cube-<a href="https://www.jqueryscript.net/tags.php?/grid/">grid</a>' | 'fading-circle' | 'folding-cube'
         spinner: 'double-bounce',

         // spinner color
         spinColor: '#d2d2d2',

         // same as data-title
         titleattr: 'title',

         // title background color
         titleBackground: '#161617',

         // title color
         titleColor: '#d2d2d2',

         // 'top' || 'bottom'
         titlePosition: 'top'
      });

   </script>
@endsection
