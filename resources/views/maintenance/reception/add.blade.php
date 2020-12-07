@extends('layouts.default')
@section('style')
   <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
   <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
   <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection
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
                  <h1 class="m-0 text-dark">Nouvelle Réception</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('receptions') }}">Tableau de bord</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('reception_liste') }}">Liste réception</a></li>
                     <li class="breadcrumb-item active">Créer réception</li>
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
                        {{-- <h5 class="m-0">Featured</h5> --}}
                     </div>
                     <div class="card-body">
                        <form action="{{ route('reception_store') }}" method="POST">
                           @csrf
                           <client-form></client-form>
                           <h5 class="text-primary">Informations du véhicule</h5>
                           <hr />
                           <div class="form-group">
                              <label for="enjoliveur">Enjoliveur</label>
                              <input value="{{ old('enjoliveur') }}" name="enjoliveur" class="form-control"
                                 id="enjoliveur" />
                              @error('enjoliveur')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="immatriculation">Immatriculation</label>
                              <input value="{{ old('immatriculation') }}" name="immatriculation" class="form-control"
                                 id="immatriculation" />
                              @error('immatriculation')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="vehicule">Véhicule (fabriquant model)</label>
                              <input value="{{ old('vehicule') }}" name="vehicule" class="form-control" id="vehicule" />
                              @error('vehicule')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="chassis">Chassis</label>
                              <input value="{{ old('chassis') }}" name="chassis" class="form-control" id="chassis" />
                              @error('chassis')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="dmc">dmc</label>
                              <input value="{{ old('dmc') }}" name="dmc" class="form-control" id="dmc" />
                              @error('dmc')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="date_sitca">Date SITCA</label>
                              <div class="input-group date" id="date_sitca" data-target-input="nearest">
                                 <input value="{{ old('date_sitca') }}" name="date_sitca" type="text"
                                    class="form-control datetimepicker-input" data-target="#date_sitca" />
                                 <div class="input-group-append" data-target="#date_sitca" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                 </div>
                              </div>
                              @error('date_sitca')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="date_assurance">Date d'assurance</label>
                              <div class="input-group date" id="date_assurance" data-target-input="nearest">
                                 <input value="{{ old('date_assurance') }}" name="date_assurance" type="text"
                                    class="form-control datetimepicker-input" data-target="#date_assurance" />
                                 <div class="input-group-append" data-target="#date_assurance"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                 </div>
                              </div>
                              @error('date_assurance')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="kilometrage_actuel">Kilometrage Actuel</label>
                              <input value="{{ old('kilometrage_actuel') }}" name="kilometrage_actuel" class="form-control"
                                 id="kilometrage_actuel" />
                              @error('kilometrage_actuel')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="prochaine_vidange">Prochaine Vidange</label>
                              <input value="{{ old('prochaine_vidange') }}" name="prochaine_vidange" class="form-control"
                                 id="prochaine_vidange" />
                              @error('prochaine_vidange')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="niveau">Niveau de Carburant</label>
                              <select class="form-control" name="niveau_carburant" id="niveau">
                                 <option selected disabled> .....</option>
                                 @foreach ($niveaux as $niveau)
                                    <option @if (old('niveau_carburant') == $niveau)
                                       selected
                                 @endif value="{{ $niveau }}">{{ $niveau }}</option>
                                 @endforeach
                              </select>
                              @error('niveau_carburant')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="nom_deposant">Nom du déposant</label>
                              <input value="{{ old('nom_deposant') }}" name="nom_deposant" class="form-control"
                                 id="nom_deposant" />
                              @error('nom_deposant')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="ressenti">Ressenti du client</label>
                              <textarea value="{{ old('ressenti') }}" name="ressenti" class="form-control" id="ressenti"
                                 cols="30" rows="6"></textarea>
                              @error('ressenti')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="date_reception">Date Réception</label>
                              <div class="input-group date" id="date_reception" data-target-input="nearest">
                                 <input value="{{ old('date_reception') }}" name="date_reception" type="text"
                                    class="form-control datetimepicker-input" data-target="#date_reception" />
                                 <div class="input-group-append" data-target="#date_reception"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                 </div>
                              </div>
                              @error('date_reception')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="type">Type de réparation</label>
                              <select class="form-control select2" name="type_reparation" id="type">
                                 <option selected disabled> .....</option>
                                 @foreach ($types as $id => $type)
                                    <option @if (old('type_reparation') == $id)
                                       selected
                                 @endif value="{{ $id }}">{{ $type }}</option>
                                 @endforeach
                              </select>
                              @error('type_reparation')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                           <div class="row">
                              <div class="col-md-10">
                                 <h5 class="text-primary">Etat du véhicule</h5>
                              </div>
                              <div class="col-md-2">
                                 <button type="button" onclick="welldone()" class="btn btn-primary ui-button">
                                    <i class="fas fa-check"></i> Tout bon
                                 </button>
                              </div>
                           </div>
                           <hr />
                           <div id="etat" class="row">
                              <div class="col-md-6">
                                 <h6>Intérieur</h6>
                                 <div class="form-group">
                                    <label for="eclairage">Eclairage</label>
                                    <select name="eclairage_int" class="form-control" id="eclairage">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('eclairage_int') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('eclairage_int')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="retroviseur">Rétroviseur</label>
                                    <select name="retroviseurs_int" class="form-control" id="retroviseur">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('retroviseurs_int') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('retroviseur_int')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="klaxon">Klaxon</label>
                                    <select name="klaxon" class="form-control" id="klaxon">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('klaxon') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('klaxon')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="essuies_glace">Essuies glaces</label>
                                    <select name="essuies_glace" class="form-control" id="essuies_glace">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('essuies_glace') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('essuies_glace')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="radio">Radio</label>
                                    <select name="radio" class="form-control" id="radio">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('radio') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('radio')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="climatisation">Climatisation</label>
                                    <select name="climatisation" class="form-control" id="climatisation">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('climatisation') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('climatisation')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="frein_stationnement">Frein de stationnement</label>
                                    <select name="frein_stationnement" class="form-control" id="frein_stationnement">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('frein_stationnement') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('frein_stationnement')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="sieges">sieges</label>
                                    <select name="sieges" class="form-control" id="sieges">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('sieges') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('sieges')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="tableau_bord">Tableau de bord</label>
                                    <select name="tableau_bord" class="form-control" id="tableau_bord">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('tableau_bord') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('tableau_bord')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="leve_vitre">Leve-vitre</label>
                                    <select name="leve_vitre" class="form-control" id="leve_vitre">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('leve_vitre') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('leve_vitre')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="verouillage_portes">Vérouillage Portes</label>
                                    <select name="verouillage_portes" class="form-control" id="verouillage_portes">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('verouillage_portes') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('verouillage_portes')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="ouverture_portes">Ouverture Portes</label>
                                    <select name="ouverture_portes_int" class="form-control" id="ouverture_portes">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('ouverture_portes_int') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('ouverture_portes_int')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 {{-- <h6>Sous le capot</h6> --}}
                                 <div class="form-group">
                                    <label for="huile_moteur">Huile de moteur</label>
                                    <select name="huile_moteur" class="form-control" id="huile_moteur">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('huile_moteur') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('huile_moteur')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="huile_frein">Huile de frein</label>
                                    <select name="huile_frein" class="form-control" id="huile_frein">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('huile_frein') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('huile_frein')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="huile_direction">Huile de direction</label>
                                    <select name="huile_direction" class="form-control" id="huile_direction">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('huile_direction') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('huile_direction')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="liquide_refroidissement">Liquide de refroidissement</label>
                                    <select name="liquide_refroidissement" class="form-control"
                                       id="liquide_refroidissement">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('liquide_refroidissement') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('liquide_refroidissement')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="liquide_lave_glace">Liquide lave glace</label>
                                    <select name="liquide_lave_glace" class="form-control" id="liquide_lave_glace">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('liquide_lave_glace') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('liquide_lave_glace')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <h6>Extérieur</h6>
                                 <div class="form-group">
                                    <label for="roues">Roues</label>
                                    <select name="roues" class="form-control" id="roues">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('roues') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('roues')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="feux_arriere">Feux arrieres</label>
                                    <select name="feux_arrieres" class="form-control" id="feux_arriere">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('feux_arrieres') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('feux_arrieres')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="balais_essuies_glace_av">Balais essuies glace avant</label>
                                    <select name="balais_essuies_glace_av" class="form-control"
                                       id="balais_essuies_glace_av">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('balais_essuies_glace_av') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('balais_essuies_glace_av')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="balais_essuies_glace_ar">balais essuies glace arrière</label>
                                    <select name="balais_essuies_glace_ar" class="form-control"
                                       id="balais_essuies_glace_ar">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('balais_essuies_glace_ar') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('balais_essuies_glace_ar')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="trape_carburant">Trape carburant</label>
                                    <select name="trape_carburant" class="form-control" id="trape_carburant">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('trape_carburant') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('trape_carburant')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="ouverture_portes_ext">Ouverture portes extérieur</label>
                                    <select name="ouverture_portes_ext" class="form-control" id="ouverture_portes_ext">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('ouverture_portes_ext') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('ouverture_portes_ext')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="retroviseurs_ext">Rétroviseurs extérieur</label>
                                    <select name="retroviseurs_ext" class="form-control" id="retroviseurs_ext">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('retroviseurs_ext') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('retroviseurs_ext')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="cle_contact">Clé de contact</label>
                                    <select name="cle_contact" class="form-control" id="cle_contact">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('cle_contact') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('cle_contact')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="clignotants">Clignotants</label>
                                    <select name="clignotants" class="form-control" id="clignotants">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('clignotants') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('clignotants')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="veilleuses">Veilleuses</label>
                                    <select name="veilleuses" class="form-control" id="veilleuses">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('veilleuses') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('veilleuses')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="feux_croisement">Feux de croisement</label>
                                    <select name="feux_croisement" class="form-control" id="feux_croisement">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('feux_croisement') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('feux_croisement')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="feux_recul">Feux de recul</label>
                                    <select name="feux_recul" class="form-control" id="feux_recul">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('feux_croisement') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('feux_recul')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="feux_stop">Feux stop</label>
                                    <select name="feux_stop" class="form-control" id="feux_stop">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('feux_stop') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('feux_stop')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="feux_antibrouillard">Feux antibrouillard</label>
                                    <select name="feux_antibrouillard" class="form-control" id="feux_antibrouillard">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('feux_antibrouillard') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('feux_antibrouillard')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="cric">cric</label>
                                    <select name="cric" class="form-control" id="cric">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('cric') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('cric')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="roues_secours">Roues secours</label>
                                    <select name="roues_secours" class="form-control" id="roues_secours">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('roues_secours') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('roues_secours')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="manivelle">Manivelle</label>
                                    <select name="manivelle" class="form-control" id="manivelle">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('manivelle') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('manivelle')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="trousse">Trousse</label>
                                    <select name="trousse" class="form-control" id="trousse">
                                       <option selected disabled> ....</option>
                                       @foreach ($etats as $etat)
                                          <option @if (old('trousse') === $etat)
                                             selected
                                       @endif value="{{ $etat }}">{{ $etat }}</option>
                                       @endforeach
                                    </select>
                                    @error('trousse')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                           <div style="text-align: right" class="form-group">
                              <button type="submit" class="btn btn-primary">
                                 soumettre
                              </button>
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
@section('scripts')
   <script src="{{ asset('js/addutils.js') }}"></script>
   <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
   <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
   <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
   <script>
      $(function() {
         $('#date_sitca').datetimepicker({
            format: 'DD/MM/YYYY'
         });
         $('#date_assurance').datetimepicker({
            format: 'DD/MM/YYYY'
         });
         $('#date_reception').datetimepicker({
            format: 'DD/MM/YYYY'
         });
         $('.select2').select2({
            theme: 'bootstrap4'
         })
      })

   </script>
@endsection
