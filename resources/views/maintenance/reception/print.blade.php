@extends('layouts.default')
@section('module-navbar')
   @include('partials.modules.nav-maintenance')
@endsection
@section('content')
   <div class="wrapper">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="com-md-4 col-sm-4">
                     <h1 class="m-0 text-dark">Détails de réception</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-8 col-md-8">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('maintenance_index') }}">Tableau de maintenance</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('receptions') }}">Tableau des réceptions</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('reception_liste') }}">Réceptions</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('reception_show', $reception) }}">Détails</a></li>
                        <li class="breadcrumb-item active">{{ 'Imprimer: ' . $reception->code }}</li>
                     </ol>
                  </div><!-- /.col -->
               </div><!-- /.row -->
            </div><!-- /.container-fluid -->
         </div>
         <!-- /.content-header -->

         <!-- Main content -->
         <section class="reception">
            <div class="content">
               <div class="container-fluid">
                  <div class="row">
                     <!-- /.col-md-6 -->
                     <div class="col-lg-12">
                        <div class="card">
                           <div class="card-header">
                              <center>
                                 <h5>
                                    <b>FICHE DE RECEPTION OR: {{ $reception->code }} DU
                                       {{ $reception->created_at->format('d-m-Y') }}
                                    </b>
                                 </h5>
                              </center>
                           </div>
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-6">
                                    <h5>IDENTIFICATION DU CLIENT</h5>
                                    @if ($reception->personneLinked->nature() === 'particulier')
                                       <table style="width:100%" class="table table-bordered">
                                          <tbody>
                                             <tr>
                                                <th style="width:10%">Client</th>
                                                <td style="width:90%">{{ $reception->personneLinked->nom_complet }}</td>
                                             </tr>
                                             <tr>
                                                <th style="width:10%">Email</th>
                                                <td style="width:90%">{{ $reception->personneLinked->email }}</td>
                                             </tr>
                                             <tr>
                                                <th style="width:10%">Contact</th>
                                                <td style="width:90%">{{ $reception->personneLinked->telephone }}</td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    @endif
                                    @if ($reception->personneLinked->nature() === 'assurance')
                                       <table style="width: 100%" class="table table-bordered">
                                          <tbody>
                                             <tr>
                                                <th style="width:10%">Assurance</th>
                                                <td style="width:90%">{{ $reception->personneLinked->nom_assurance }}
                                                </td>
                                             </tr>
                                             <tr>
                                                <th style="width:10%">Représentant</th>
                                                <td style="width:90%">
                                                   {{ $reception->personneLinked->representant_assurance }}</td>
                                             </tr>
                                             <tr>
                                                <th style="width:10%">Email</th>
                                                <td style="width:90%">{{ $reception->personneLinked->email_assurance }}
                                                </td>
                                             </tr>
                                             <tr>
                                                <th style="width:10%">Contact</th>
                                                <td style="width:90%">
                                                   {{ $reception->personneLinked->contact_assurance }}</td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    @endif
                                    @if ($reception->personneLinked->nature() === 'entreprise')
                                       <table style="width: 100%" class="table table-bordered">
                                          <tbody>
                                             <tr>
                                                <th style="width:10%">Entreprise</th>
                                                <td style="width:90%">{{ $reception->personneLinked->nom_entreprise }}
                                                </td>
                                             </tr>
                                             <tr>
                                                <th style="width:10%">Représentant</th>
                                                <td style="width:90%">
                                                   {{ $reception->personneLinked->representant_entreprise }}</td>
                                             </tr>
                                             <tr>
                                                <th style="width:10%">Email</th>
                                                <td style="width:90%">{{ $reception->personneLinked->email_entreprise }}
                                                </td>
                                             </tr>
                                             <tr>
                                                <th style="width:10%">Contact</th>
                                                <td style="width:90%">
                                                   {{ $reception->personneLinked->contact_entreprise }}</td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    @endif
                                 </div>
                                 <div class="col-md-6">
                                    <h5>IDENTIFICATION DU VEHICULE</h5>
                                    <table class="show-table">
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
                              <h5>CHECKLIST</h5>
                              <div style="margin-bottom: 1%" class="row">
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
                                 <div class="col-md-6">
                                    <h5>RESSENTI DU CLIENT</h5>
                                    <dd>{{ $reception->ressenti }}</dd>
                                 </div>
                                 <div class="col-md-6">
                                    <img style="padding: 12% ; margin-top: 2%; margin-left:4%"
                                       src="{{ asset('images/dessein.png') }}" width="508" height="369" alt="dessein">
                                 </div>
                              </div>
                              {{-- commentaire de reception avec pieces jointes --}}
                              <h5>COMMENTAIRE DU RECEPTIONISTE</h5>
                              <hr>
                              @if (!empty($reception->commentaire->contenu))
                                 {{-- commentaire de reception --}}
                                 <div style="margin-bottom: 2%" class="row">
                                    <div class="col-md-12">
                                       <dd>{{ $reception->commentaire->contenu }}</dd>
                                    </div>
                                 </div>
                              @endif
                           </div>
                           <div class="card-footer">
                              <span class="text-muted">boite postal + siège + téléphone + RCCM + CC + site + Numéro de
                                 compte bancaire
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </div>
@endsection
@section('scripts')
   <script type="text/javascript">
      window.addEventListener("load", window.print());

   </script>
@endsection
