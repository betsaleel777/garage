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
                  <div class="col-sm-6">
                     <h1 class="m-0 text-dark">Détails de réception</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('acceuil') }}">Acceuil principale</a></li>
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
                                 <h5><b>FICHE DE RECEPTION</b></h5>
                              </center>
                           </div>
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-8">
                                    <span>logo</span>
                                 </div>
                                 <div class="col-md-4">
                                    <h5><b>Date de réception:</b><span>
                                          {{ $reception->created_at->format('d-m-Y') }}</span>
                                    </h5>
                                    <h5 class="text-danger"><b>Numéro OR:</b><span>
                                          {{ $reception->code }}</span>
                                    </h5>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-6">
                                    <h3>IDENTIFICATION DU CLIENT</h3>
                                    @if ($reception->personneLinked->nature() === 'particulier')
                                       <table style="width: 75%" class="table">
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
                                       <dt class="col-md-3">Entreprise:</dt>
                                       <dd class="col-md-8">{{ $reception->personneLinked->nom_entreprise }}</dd>
                                       <dt class="col-md-3">Représentant:</dt>
                                       <dd class="col-md-8">{{ $reception->personneLinked->representant_entreprise }}</dd>
                                       <dt class="col-md-3">Email:</dt>
                                       <dd class="col-md-8">{{ $reception->personneLinked->email_entreprise }}</dd>
                                       <dt class="col-md-3">Contact:</dt>
                                       <dd class="col-md-8">{{ $reception->personneLinked->contact_entreprise }}</dd>
                                    @endif
                                 </div>
                                 <div class="col-md-6">
                                    <h3>RESSENTI DU CLIENT</h3>
                                    <dd>{{ $reception->ressenti }}</dd>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <h3>CHECKLIST</h3>
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
         {{-- @if (!empty($reception->preessai))
            <section>
               <div class="content">
                  <div class="container-fluid">
                     <div class="row">
                        <!-- /.col-md-6 -->
                        <div class="col-md-12">
                           <div class="card">
                              <div class="row">
                                 <div class="col-md-10">
                                    <h3> FICHE DE PRE-DIAGNOSTIQUE</h3>
                                 </div>
                                 <div style="text-align: right" class="col-md-2">
                                    <h4>{{ $reception->preessai->date_preessais->format('d-m-Y') }}</h4>
                                 </div>
                              </div>
                              <div class="card-body">
                                 <table class="show-table">
                                    <thead>
                                       <tr>
                                          <th style="width:30%">INSPECTION</th>
                                          <th>COMMENTAIRES</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>Mettre le kit de protection interne</td>
                                          <td>{{ $reception->preessai->protection_interne }}</td>
                                       </tr>
                                       <tr>
                                          <td>Mettre la housse de protection</td>
                                          <td>{{ $reception->preessai->housse_protection }}</td>
                                       </tr>
                                       <tr>
                                          <td class="active-row" colspan="2">
                                             <b>CONTROLE INTERIEUR</b>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>Eclairage intérieur</td>
                                          <td>{{ $reception->preessai->eclairage_int }}</td>
                                       </tr>
                                       <tr>
                                          <td>Klaxon</td>
                                          <td>{{ $reception->preessai->klaxon }}</td>
                                       </tr>
                                       <tr>
                                          <td>Jeu de pédale de frein</td>
                                          <td>{{ $reception->preessai->pedale_frein }}</td>
                                       </tr>
                                       <tr>
                                          <td>Jeu de pédale embrayage</td>
                                          <td>{{ $reception->preessai->pedale_embreillage }}</td>
                                       </tr>
                                       <tr>
                                          <td>Frein à main</td>
                                          <td>{{ $reception->preessai->frein_main }}</td>
                                       </tr>
                                       <tr>
                                          <td>Fonctionnement des ceintures de sécurité</td>
                                          <td>{{ $reception->preessai->housse_protection }}</td>
                                       </tr>
                                       <tr>
                                          <td>Fonctionnement des feux et phares</td>
                                          <td>{{ $reception->preessai->housse_protection }}</td>
                                       </tr>
                                       <tr>
                                          <td>Mettre la housse de protection</td>
                                          <td>{{ $reception->preessai->housse_protection }}</td>
                                       </tr>
                                       <tr>
                                          <td>Fonctionnement balais E/G, moteur, bocale lave glace</td>
                                          <td>{{ $reception->preessai->housse_protection }}</td>
                                       </tr>
                                       <tr>
                                          <td>Fonctionnement des lèves vitres</td>
                                          <td>{{ $reception->preessai->housse_protection }}</td>
                                       </tr>
                                       <tr>
                                          <td class="active-row" colspan="2">
                                             <b>CONTROLE EXTERIEUR</b>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>Eraflures</td>
                                          <td>{{ $reception->preessai->eraflures }}</td>
                                       </tr>
                                       <tr>
                                          <td>Corrosion, rouille</td>
                                          <td>{{ $reception->preessai->corrosion_rouille }}</td>
                                       </tr>
                                       <tr>
                                          <td>Elements endommagés</td>
                                          <td>{{ $reception->preessai->elements_endommages }}</td>
                                       </tr>
                                       <tr>
                                          <td>Clarté des feux et phares</td>
                                          <td>{{ $reception->preessai->feux_phares }}</td>
                                       </tr>
                                       <tr>
                                          <td>Etat des balais E/G</td>
                                          <td>{{ $reception->preessai->etat_balais_eg }}</td>
                                       </tr>
                                       <tr>
                                          <td>Trappe à carburant</td>
                                          <td>{{ $reception->preessai->trape_carburant }}</td>
                                       </tr>
                                       <tr>
                                          <td>Poignées portes</td>
                                          <td>{{ $reception->preessai->eraflures }}</td>
                                       </tr>
                                       <tr>
                                          <td>Pneux, pression, profondeur d'usure</td>
                                          <td>{{ $reception->preessai->pneux_pression_usure }}</td>
                                       </tr>
                                       <tr>
                                          <td class="active-row" colspan="2">
                                             <b>SOUS LE CAPOT</b>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>Niveau des liquides</td>
                                          <td>{{ $reception->preessai->niveaux_liquides }}</td>
                                       </tr>
                                       <tr>
                                          <td>Raccords et durite de carburant</td>
                                          <td>{{ $reception->preessai->raccords_durite }}</td>
                                       </tr>
                                       <tr>
                                          <td>Etat de la batterie et des cosses</td>
                                          <td>{{ $reception->preessai->batterie_cosses }}</td>
                                       </tr>
                                       <tr>
                                          <td>Etat du radiateur</td>
                                          <td>{{ $reception->preessai->etat_radiateur }}</td>
                                       </tr>
                                       <tr>
                                          <td class="active-row" colspan="2">
                                             <b>SOUS LA CAROSSERIE</b>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>Plaquettes, disques et tambours de frein</td>
                                          <td>{{ $reception->preessai->disques_tambours_frein }}</td>
                                       </tr>
                                       <tr>
                                          <td>Intérieur des pneus</td>
                                          <td>{{ $reception->preessai->pneux_int }}</td>
                                       </tr>
                                       <tr>
                                          <td>Suspensions</td>
                                          <td>{{ $reception->preessai->suspensions }}</td>
                                       </tr>
                                       <tr>
                                          <td>Direction, Volant</td>
                                          <td>{{ $reception->preessai->volant_direction }}</td>
                                       </tr>
                                       <tr>
                                          <td>Pot d’échappement</td>
                                          <td>{{ $reception->preessai->pot_echappement }}</td>
                                       </tr>
                                       <tr>
                                          <td>Etat des silent-blocs</td>
                                          <td>{{ $reception->preessai->silent_bloc }}</td>
                                       </tr>
                                       <tr>
                                          <td>Tuyauterie de frein</td>
                                          <td>{{ $reception->preessai->tuyauterie_frein }}</td>
                                       </tr>
                                       <tr>
                                          <td>Fuite d’huile</td>
                                          <td>{{ $reception->preessai->fuite_huile }}</td>
                                       </tr>
                                       <tr>
                                          <td>Etat general sous la carrosserie</td>
                                          <td>{{ $reception->preessai->sous_carrosserie }}</td>
                                       </tr>
                                       <tr>
                                          <td class="active-row" colspan="2">
                                             <b>TEST ROUTIER NECESSAIRE</b>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>Ressenti test routier</td>
                                          <td>{{ $reception->preessai->test_routier }}</td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="card-footer">
                                 <span class="text-footer-print">BOITE POSTALE + SIEGE SOCIAL + TELEPHONE</span>
                                 <span class="text-footer-print">NUMERO RCCM + NUMERO CC + SITE WEB</span>
                                 <span class="text-footer-print">NOM DE BANQUE + NUMERO DE COMPTE </span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         @endif --}}
      </div>
   </div>
@endsection
@section('scripts')
   <script type="text/javascript">
      window.addEventListener("load", window.print());

   </script>
@endsection
