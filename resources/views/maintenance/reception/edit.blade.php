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
                  <h1 class="m-0 text-dark">Modifier {{ $reception->code }}</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('receptions') }}">Tableau de bord</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('reception_liste') }}">Liste réception</a></li>
                     <li class="breadcrumb-item active">{{ $reception->code }}</li>
                  </ol>
               </div><!-- /.col -->
            </div><!-- /.row -->
         </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

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
                        <form action="{{ route('reception_update') }}" method="POST">
                           @csrf
                           <input hidden type="text" name="reception" value="{{ $reception->id }}">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="personne">Client</label>
                                    <select name="personne" id="personne" class="form-control select2">
                                       <option selected disabled> .....</option>
                                       @foreach ($personnes as $id => $matricule)
                                          <option @if ($reception->personne == $id)
                                             selected
                                       @endif value="{{ $id }}">{{ $matricule }}</option>
                                       @endforeach
                                    </select>
                                    @error('personne')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 {{-- checklist --}}
                                 <div class="row">
                                    <div class="col-md-4">
                                       <h5 class="text-primary">Checklist</h5>
                                    </div>
                                    <div class="col-md-8">
                                       <span class="text-muted">{ B: bon, P: passable, M: mauvais, I: inexistant }</span>
                                    </div>
                                 </div>
                                 <hr>
                                 <div class="row">
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="eclairage">Eclairage</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="eclairage_int"
                                                id="inlineRadio1" value="bon" @if ($reception->etat->eclairage_int === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="inlineRadio1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="eclairage_int"
                                                id="inlineRadio2" value="passable" @if ($reception->etat->eclairage_int === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="inlineRadio2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="eclairage_int"
                                                id="inlineRadio3" value="mauvais" @if ($reception->etat->eclairage_int === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="inlineRadio3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="eclairage_int"
                                                id="inlineRadio4" value="inexistant" @if ($reception->etat->eclairage_int === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="inlineRadio4">I</label>
                                          </div>
                                          @error('eclairage_int')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="retroviseur">Rétroviseur</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="retroviseurs_int" id="b1"
                                                value="bon" @if ($reception->etat->retroviseurs_int === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="b1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="retroviseurs_int" id="b2"
                                                value="passable" @if ($reception->etat->retroviseurs_int === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="b2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="retroviseurs_int" id="b3"
                                                value="mauvais" @if ($reception->etat->retroviseurs_int === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="b3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="retroviseurs_int" id="b4"
                                                value="inexistant" @if ($reception->etat->retroviseurs_int === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="b4">I</label>
                                          </div>
                                          @error('retroviseurs_int')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Klaxon</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="klaxon" id="c1" value="bon"
                                                @if ($reception->etat->klaxon === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="c1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="klaxon" id="c2"
                                                value="passable" @if ($reception->etat->klaxon === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="c2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="klaxon" id="c3"
                                                value="mauvais" @if ($reception->etat->klaxon === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="c3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="klaxon" id="c4"
                                                value="inexistant" @if ($reception->etat->klaxon === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="c4">I</label>
                                          </div>
                                          @error('klaxon')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Essuies glace</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="essuies_glace" id="d1"
                                                value="bon" @if ($reception->etat->essuies_glace === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="d1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="essuies_glace" id="d2"
                                                value="passable" @if ($reception->etat->essuies_glace === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="d2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="essuies_glace" id="d3"
                                                value="mauvais" @if ($reception->etat->essuies_glace === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="d3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="essuies_glace" id="d4"
                                                value="inexistant" @if ($reception->etat->essuies_glace === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="d4">I</label>
                                          </div>
                                          @error('essuies_glace')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Radio</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="radio" id="e1" value="bon"
                                                @if ($reception->etat->radio === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="e1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="radio" id="e2"
                                                value="passable" @if ($reception->etat->radio === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="e2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="radio" id="e3"
                                                value="mauvais" @if ($reception->etat->radio === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="e3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="radio" id="e4"
                                                value="inexistant" @if ($reception->etat->radio === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="e4">I</label>
                                          </div>
                                          @error('radio')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Climatisation</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="climatisation" id="f1"
                                                value="bon" @if ($reception->etat->climatisation === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="f1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="climatisation" id="f2"
                                                value="passable" @if ($reception->etat->climatisation === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="f2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="climatisation" id="f3"
                                                value="mauvais" @if ($reception->etat->climatisation === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="f3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="climatisation" id="f4"
                                                value="inexistant" @if ($reception->etat->climatisation === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="f4">I</label>
                                          </div>
                                          @error('climatisation')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Frein de stationnement</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="frein_stationnement"
                                                id="c1" value="bon" @if ($reception->etat->frein_stationnement === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="c1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="frein_stationnement"
                                                id="c2" value="passable" @if ($reception->etat->frein_stationnement === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="c2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="frein_stationnement"
                                                id="c3" value="mauvais" @if ($reception->etat->frein_stationnement === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="c3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="frein_stationnement"
                                                id="c4" value="inexistant" @if ($reception->etat->frein_stationnement === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="c4">I</label>
                                          </div>
                                          @error('frein_stationnement')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Sièges</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="sieges" id="g1" value="bon"
                                                @if ($reception->etat->sieges === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="g1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="sieges" id="g2"
                                                value="passable" @if ($reception->etat->sieges === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="g2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="sieges" id="g3"
                                                value="mauvais" @if ($reception->etat->sieges === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="g3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="sieges" id="g4"
                                                value="inexistant" @if ($reception->etat->sieges === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="g4">I</label>
                                          </div>
                                          @error('sieges')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Tableau de bord</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="tableau_bord" id="h1"
                                                value="bon" @if ($reception->etat->tableau_bord === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="h1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="tableau_bord" id="h2"
                                                value="passable" @if ($reception->etat->tableau_bord === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="h2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="tableau_bord" id="h3"
                                                value="mauvais" @if ($reception->etat->tableau_bord === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="h3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="tableau_bord" id="h4"
                                                value="inexistant" @if ($reception->etat->tableau_bord === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="h4">I</label>
                                          </div>
                                          @error('tableau_bord')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Lève de vitre</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="leve_vitre" id="i1"
                                                value="bon" @if ($reception->etat->leve_vitre === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="i1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="leve_vitre" id="i2"
                                                value="passable" @if ($reception->etat->leve_vitre === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="i2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="leve_vitre" id="i3"
                                                value="mauvais" @if ($reception->etat->leve_vitre === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="i3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="leve_vitre" id="i4"
                                                value="inexistant" @if ($reception->etat->leve_vitre === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="i4">I</label>
                                          </div>
                                          @error('leve_vitre')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Vérrouillage des portes</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="verrouillage_portes"
                                                id="j1" value="bon" @if ($reception->etat->verrouillage_portes === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="j1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="verrouillage_portes"
                                                id="j2" value="passable" @if ($reception->etat->verrouillage_portes === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="j2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="verrouillage_portes"
                                                id="j3" value="mauvais" @if ($reception->etat->verrouillage_portes === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="j3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="verrouillage_portes"
                                                id="j4" value="inexistant" @if ($reception->etat->verrouillage_portes === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="j4">I</label>
                                          </div>
                                          @error('verrouillage_portes')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Ouverture des portes int</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="ouverture_portes_int"
                                                id="k1" value="bon" @if ($reception->etat->ouverture_portes_int === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="k1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="ouverture_portes_int"
                                                id="k2" value="passable" @if ($reception->etat->ouverture_portes_int === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="k2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="ouverture_portes_int"
                                                id="k3" value="mauvais" @if ($reception->etat->ouverture_portes_int === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="k3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="ouverture_portes_int"
                                                id="k4" value="inexistant" @if ($reception->etat->ouverture_portes_int === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="k4">I</label>
                                          </div>
                                          @error('ouverture_portes_int')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Huile de moteur</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="huile_moteur" id="l1"
                                                value="bon" @if ($reception->etat->huile_moteur === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="l1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="huile_moteur" id="l2"
                                                value="passable" @if ($reception->etat->huile_moteur === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="l2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="huile_moteur" id="l3"
                                                value="mauvais" @if ($reception->etat->huile_moteur === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="l3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="huile_moteur" id="l4"
                                                value="inexistant" @if ($reception->etat->huile_moteur === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="l4">I</label>
                                          </div>
                                          @error('huile_moteur')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Huile de frein</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="huile_frein" id="m1"
                                                value="bon" @if ($reception->etat->huile_frein === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="m1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="huile_frein" id="m2"
                                                value="passable" @if ($reception->etat->huile_frein === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="m2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="huile_frein" id="m3"
                                                value="mauvais" @if ($reception->etat->huile_frein === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="m3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="huile_frein" id="m4"
                                                value="inexistant" @if ($reception->etat->huile_frein === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="m4">I</label>
                                          </div>
                                          @error('huile_frein')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Huile de direction</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="huile_direction" id="n1"
                                                value="bon" @if ($reception->etat->huile_direction === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="n1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="huile_direction" id="n2"
                                                value="passable" @if ($reception->etat->huile_direction === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="n2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="huile_direction" id="n3"
                                                value="mauvais" @if ($reception->etat->huile_direction === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="n3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="huile_direction" id="n4"
                                                value="inexistant" @if ($reception->etat->huile_direction === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="n4">I</label>
                                          </div>
                                          @error('huile_direction')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Liquide refroidissement</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="liquide_refroidissement"
                                                id="o1" value="bon" @if ($reception->etat->liquide_refroidissement === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="o1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="liquide_refroidissement"
                                                id="o2" value="passable" @if ($reception->etat->liquide_refroidissement === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="o2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="liquide_refroidissement"
                                                id="o3" value="mauvais" @if ($reception->etat->liquide_refroidissement === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="o3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="liquide_refroidissement"
                                                id="o4" value="inexistant" @if ($reception->etat->liquide_refroidissement === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="o4">I</label>
                                          </div>
                                          @error('liquide_refroidissement')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Liquide lave glace</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="liquide_lave_glace" id="p1"
                                                value="bon" @if ($reception->etat->liquide_lave_glace === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="p1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="liquide_lave_glace" id="p2"
                                                value="passable" @if ($reception->etat->liquide_lave_glace === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="p2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="liquide_lave_glace" id="p3"
                                                value="mauvais" @if ($reception->etat->liquide_lave_glace === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="p3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="liquide_lave_glace" id="p4"
                                                value="inexistant" @if ($reception->etat->liquide_lave_glace === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="p4">I</label>
                                          </div>
                                          @error('liquide_lave_glace')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Roues</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="roues" id="q1" value="bon"
                                                @if ($reception->etat->roues === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="q1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="roues" id="q2"
                                                value="passable" @if ($reception->etat->roues === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="q2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="roues" id="q3"
                                                value="mauvais" @if ($reception->etat->roues === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="q3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="roues" id="q4"
                                                value="inexistant" @if ($reception->etat->roues === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="q4">I</label>
                                          </div>
                                          @error('roues')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Feux arrieres</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_arrieres" id="r1"
                                                value="bon" @if ($reception->etat->feux_arrieres === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="r1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_arrieres" id="r2"
                                                value="passable" @if ($reception->etat->feux_arrieres === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="r2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_arrieres" id="r3"
                                                value="mauvais" @if ($reception->etat->feux_arrieres === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="r3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_arrieres" id="r4"
                                                value="inexistant" @if ($reception->etat->feux_arrieres === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="r4">I</label>
                                          </div>
                                          @error('feux_arrieres')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Balais e/g avant</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="balais_essuies_glace_av"
                                                id="s1" value="bon" @if ($reception->etat->balais_essuies_glace_av === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="s1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="balais_essuies_glace_av"
                                                id="s2" value="passable" @if ($reception->etat->balais_essuies_glace_av === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="s2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="balais_essuies_glace_av"
                                                id="s3" value="mauvais" @if ($reception->etat->balais_essuies_glace_av === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="s3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="balais_essuies_glace_av"
                                                id="s4" value="inexistant" @if ($reception->etat->balais_essuies_glace_av === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="s4">I</label>
                                          </div>
                                          @error('balais_essuies_glace_av')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Balais e/g arrière</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="balais_essuies_glace_ar"
                                                id="t1" value="bon" @if ($reception->etat->balais_essuies_glace_ar === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="t1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="balais_essuies_glace_ar"
                                                id="t2" value="passable" @if ($reception->etat->balais_essuies_glace_ar === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="t2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="balais_essuies_glace_ar"
                                                id="t3" value="mauvais" @if ($reception->etat->balais_essuies_glace_ar === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="t3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="balais_essuies_glace_ar"
                                                id="t4" value="inexistant" @if ($reception->etat->balais_essuies_glace_ar === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="t4">I</label>
                                          </div>
                                          @error('balais_essuies_glace_ar')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Trappe à carburant</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="trape_carburant" id="u1"
                                                value="bon" @if ($reception->etat->trape_carburant === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="u1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="trape_carburant" id="u2"
                                                value="passable" @if ($reception->etat->trape_carburant === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="u2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="trape_carburant" id="u3"
                                                value="mauvais" @if ($reception->etat->trape_carburant === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="u3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="trape_carburant" id="u4"
                                                value="inexistant" @if ($reception->etat->trape_carburant === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="u4">I</label>
                                          </div>
                                          @error('trape_carburant')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Ouverture portes ext</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="ouverture_portes_ext"
                                                id="v1" value="bon" @if ($reception->etat->ouverture_portes_ext === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="v1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="ouverture_portes_ext"
                                                id="v2" value="passable" @if ($reception->etat->ouverture_portes_ext === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="v2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="ouverture_portes_ext"
                                                id="v3" value="mauvais" @if ($reception->etat->ouverture_portes_ext === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="v3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="ouverture_portes_ext"
                                                id="v4" value="inexistant" @if ($reception->etat->ouverture_portes_ext === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="v4">I</label>
                                          </div>
                                          @error('ouverture_portes_ext')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Rétroviseurs ext</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="retroviseurs_ext" id="w1"
                                                value="bon" @if ($reception->etat->retroviseurs_ext === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="w1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="retroviseurs_ext" id="w2"
                                                value="passable" @if ($reception->etat->retroviseurs_ext === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="w2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="retroviseurs_ext" id="w3"
                                                value="mauvais" @if ($reception->etat->retroviseurs_ext === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="w3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="retroviseurs_ext" id="w4"
                                                value="inexistant" @if ($reception->etat->retroviseurs_ext === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="w4">I</label>
                                          </div>
                                          @error('retroviseurs_ext')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Clé de contact</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="cle_contact" id="x1"
                                                value="bon" @if ($reception->etat->cle_contact === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="x1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="cle_contact" id="x2"
                                                value="passable" @if ($reception->etat->cle_contact === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="x2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="cle_contact" id="x3"
                                                value="mauvais" @if ($reception->etat->cle_contact === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="x3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="cle_contact" id="x4"
                                                value="inexistant" @if ($reception->etat->cle_contact === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="x4">I</label>
                                          </div>
                                          @error('cle_contact')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Clignotants</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="clignotants" id="y1"
                                                value="bon" @if ($reception->etat->clignotants === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="y1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="clignotants" id="y2"
                                                value="passable" @if ($reception->etat->clignotants === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="y2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="clignotants" id="y3"
                                                value="mauvais" @if ($reception->etat->clignotants === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="y3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="clignotants" id="y4"
                                                value="inexistant" @if ($reception->etat->clignotants === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="y4">I</label>
                                          </div>
                                          @error('clignotants')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Veilleuses</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="veilleuses" id="z1"
                                                value="bon" @if ($reception->etat->veilleuses === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="z1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="veilleuses" id="z2"
                                                value="passable" @if ($reception->etat->veilleuses === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="z2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="veilleuses" id="z3"
                                                value="mauvais" @if ($reception->etat->veilleuses === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="z3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="veilleuses" id="z4"
                                                value="inexistant" @if ($reception->etat->veilleuses === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="z4">I</label>
                                          </div>
                                          @error('veilleuses')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Feux de croisement</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_croisement" id="a1"
                                                value="bon" @if ($reception->etat->feux_croisement === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="a1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_croisement" id="a2"
                                                value="passable" @if ($reception->etat->feux_croisement === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="a2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_croisement" id="a3"
                                                value="mauvais" @if ($reception->etat->feux_croisement === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="a3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_croisement" id="a4"
                                                value="inexistant" @if ($reception->etat->feux_croisement === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="a4">I</label>
                                          </div>
                                          @error('feux_croisement')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Feux de récul</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_recul" id="ab1"
                                                value="bon" @if ($reception->etat->feux_recul === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ab1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_recul" id="ab2"
                                                value="passable" @if ($reception->etat->feux_recul === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ab2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_recul" id="ab3"
                                                value="mauvais" @if ($reception->etat->feux_recul === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ab3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_recul" id="ab4"
                                                value="inexistant" @if ($reception->etat->feux_recul === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ab4">I</label>
                                          </div>
                                          @error('feux_recul')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Feux stop</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_stop" id="ac1"
                                                value="bon" @if ($reception->etat->feux_stop === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ac1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_stop" id="ac2"
                                                value="passable" @if ($reception->etat->feux_stop === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ac2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_stop" id="ac3"
                                                value="mauvais" @if ($reception->etat->feux_stop === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ac3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_stop" id="ac4"
                                                value="inexistant" @if ($reception->etat->feux_stop === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ac4">I</label>
                                          </div>
                                          @error('feux_stop')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Feux antibrouillard</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_antibrouillard"
                                                id="ad1" value="bon" @if ($reception->etat->feux_antibrouillard === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ad1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_antibrouillard"
                                                id="ad2" value="passable" @if ($reception->etat->feux_antibrouillard === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ad2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_antibrouillard"
                                                id="ad3" value="mauvais" @if ($reception->etat->feux_antibrouillard === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ad3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="feux_antibrouillard"
                                                id="ad4" value="inexistant" @if ($reception->etat->feux_antibrouillard === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ad4">I</label>
                                          </div>
                                          @error('feux_antibrouillard')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Cric</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="cric" id="ae1" value="bon"
                                                @if ($reception->etat->cric === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ae1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="cric" id="ae2"
                                                value="passable" @if ($reception->etat->cric === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ae2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="cric" id="ae3"
                                                value="mauvais" @if ($reception->etat->cric === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ae3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="cric" id="ae4"
                                                value="inexistant" @if ($reception->etat->cric === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ae4">I</label>
                                          </div>
                                          @error('cric')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Roues de secours</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="roues_secours" id="af1"
                                                value="bon" @if ($reception->etat->roues_secours === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="af1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="roues_secours" id="af2"
                                                value="passable" @if ($reception->etat->roues_secours === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="af2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="roues_secours" id="af3"
                                                value="mauvais" @if ($reception->etat->roues_secours === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="af3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="roues_secours" id="af4"
                                                value="inexistant" @if ($reception->etat->roues_secours === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="af4">I</label>
                                          </div>
                                          @error('roues_secours')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Manivelle</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="manivelle" id="ag1"
                                                value="bon" @if ($reception->etat->manivelle === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ag1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="manivelle" id="ag2"
                                                value="passable" @if ($reception->etat->manivelle === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ag2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="manivelle" id="ag3"
                                                value="mauvais" @if ($reception->etat->manivelle === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ag3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="manivelle" id="ag4"
                                                value="inexistant" @if ($reception->etat->manivelle === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ag4">I</label>
                                          </div>
                                          @error('manivelle')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Trousse</label><br>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="trousse" id="ah1"
                                                value="bon" @if ($reception->etat->trousse === 'bon')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ah1">B</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="trousse" id="ah2"
                                                value="passable" @if ($reception->etat->trousse === 'passable')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ah2">P</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="trousse" id="ah3"
                                                value="mauvais" @if ($reception->etat->trousse === 'mauvais')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ah3">M</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="radio" name="trousse" id="ah4"
                                                value="inexistant" @if ($reception->etat->trousse === 'inexistant')
                                             checked
                                             @endif>
                                             <label class="form-check-label" for="ah4">I</label>
                                          </div>
                                          @error('trousse')
                                             <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <h5 class="text-primary">Informations du véhicule</h5>
                                 <hr />
                                 <div class="form-group">
                                    <label for="nom_deposant">Nom du déposant</label>
                                    <input value="{{ $reception->nom_deposant }}" name="nom_deposant" class="form-control"
                                       id="nom_deposant" />
                                    @error('nom_deposant')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    @php
                                    $enjoliveurs_selected = array_map(function($element){
                                    return $element->id ;
                                    },$reception->vehicule->enjoliveurs->all());
                                    @endphp
                                    <label>Enjoliveur</label><br>
                                    @foreach ($enjoliveurs as $key => $enjoliveur)
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" name="enjoliveur[]"
                                             id="en{{ $key + 1 }}" value="{{ $enjoliveur->id }}" @if (is_array($enjoliveurs_selected))
                                          @if (in_array($enjoliveur->id, $enjoliveurs_selected))
                                             checked
                                          @endif
                                    @endif>
                                    <label class="form-check-label" for="en{{ $key + 1 }}">{{ $enjoliveur->nom }}</label>
                                 </div>
                                 @endforeach
                              </div>
                              <div class="form-group">
                                 <label for="immatriculation">Immatriculation</label>
                                 <input value="{{ $reception->vehicule->immatriculation }}" name="immatriculation"
                                    class="form-control" id="immatriculation" />
                                 @error('immatriculation')
                                    <span class="text-danger">{{ $message }}</span>
                                 @enderror
                              </div>
                              <div class=" form-group row">
                                 <div class="col-4">
                                    <label for="marque">Marque</label>
                                    <input value="{{ $reception->vehicule->marque }}" name="marque" id="marque" type="text"
                                       class="form-control" placeholder="audi">
                                    @error('marque')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="col-3">
                                    <label for="modele">Modèle</label>
                                    <input value="{{ $reception->vehicule->modele }}" name="modele" id="modele" type="text"
                                       class="form-control" placeholder="A6">
                                    @error('modele')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="col-5">
                                    <label for="type_vehicule">Type</label>
                                    <select name="type_vehicule" id="type_vehicule" class="form-control select2">
                                       <option selected disabled> .....</option>
                                       @foreach ($categories as $categorie)
                                          <option @if ($reception->vehicule->type_vehicule == $categorie)
                                             selected
                                       @endif value="{{ $categorie }}">{{ $categorie }}</option>
                                       @endforeach
                                    </select>
                                    @error('type_vehicule')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="col-6">
                                    <label for="annee">Année</label>
                                    <input value="{{ $reception->vehicule->annee }}" name="annee" id="annee" type="text"
                                       class="form-control" placeholder="2012">
                                    @error('annee')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="col-6">
                                    <label for="couleur">Couleur</label>
                                    <input value="{{ $reception->vehicule->couleur }}" name="couleur" id="couleur"
                                       type="text" class="form-control" placeholder="orange">
                                    @error('couleur')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="chassis">Chassis</label>
                                 <input value="{{ $reception->vehicule->chassis }}" name="chassis" class="form-control"
                                    id="chassis" />
                                 @error('chassis')
                                    <span class="text-danger">{{ $message }}</span>
                                 @enderror
                              </div>
                              <div class="form-group">
                                 <label for="dmc">dmc</label>
                                 <input value="{{ $reception->vehicule->dmc }}" name="dmc" class="form-control" id="dmc" />
                                 @error('dmc')
                                    <span class="text-danger">{{ $message }}</span>
                                 @enderror
                              </div>
                              <div class="form-group">
                                 <label for="date_sitca">Date de dernière visite technique</label>
                                 <div class="input-group date" id="date_sitca" data-target-input="nearest">
                                    <input value="{{ $reception->vehicule->date_sitca }}" name="date_sitca" type="text"
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
                                    <input value="{{ $reception->vehicule->date_assurance }}" name="date_assurance"
                                       type="text" class="form-control datetimepicker-input"
                                       data-target="#date_assurance" />
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
                                 <input value="{{ $reception->vehicule->kilometrage_actuel }}" name="kilometrage_actuel"
                                    class="form-control" id="kilometrage_actuel" />
                                 @error('kilometrage_actuel')
                                    <span class="text-danger">{{ $message }}</span>
                                 @enderror
                              </div>
                              <div class="form-group">
                                 <label for="prochaine_vidange">Prochaine Vidange</label>
                                 <input value="{{ $reception->vehicule->prochaine_vidange }}" name="prochaine_vidange"
                                    class="form-control" id="prochaine_vidange" />
                                 @error('prochaine_vidange')
                                    <span class="text-danger">{{ $message }}</span>
                                 @enderror
                              </div>
                              <div class="form-group">
                                 <label>Niveau de carburant</label><br>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="niveau_carburant" id="ca1" value="0"
                                       @if ($reception->vehicule->niveau_carburant == '0')
                                    checked
                                    @endif>
                                    <label class="form-check-label" for="ca1">0</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="niveau_carburant" id="ca2"
                                       value="1/4" @if ($reception->vehicule->niveau_carburant === '1/4')
                                    checked
                                    @endif>
                                    <label class="form-check-label" for="ca2">1/4</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="niveau_carburant" id="ca3"
                                       value="1/2" @if ($reception->vehicule->niveau_carburant === '1/2')
                                    checked
                                    @endif>
                                    <label class="form-check-label" for="ca3">1/2</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="niveau_carburant" id="ca4"
                                       value="3/4" @if ($reception->vehicule->niveau_carburant === '3/4')
                                    checked
                                    @endif>
                                    <label class="form-check-label" for="ca4">3/4</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="niveau_carburant" id="ca5" value="1"
                                       @if ($reception->vehicule->niveau_carburant === '1')
                                    checked
                                    @endif>
                                    <label class="form-check-label" for="ca5">1</label>
                                 </div>
                                 @error('niveau_carburant')
                                    <span class="text-danger">{{ $message }}</span>
                                 @enderror
                              </div>
                           </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-12">
                           <label for="ressenti">Ressenti du client</label>
                           <textarea class="form-control" name="ressenti" id="ressenti" cols="30"
                              rows="6">{{ $reception->ressenti }}</textarea>
                        </div>
                     </div>
                     <div style="text-align: right" class="form-group">
                        <button type="submit" class="btn btn-primary">
                           enregistrer
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
   </div>
   <!-- /.content-wrapper -->
@endsection
@section('scripts')

   <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
   <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
   <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
   <script>
      $(function() {
         $('#date_sitca').datetimepicker({
            format: 'DD-MM-YYYY',
            locale: "fr",
            defaultDate: "{{ $reception->vehicule->date_sitca->format('d-m-Y') }}",
         });
         $('#date_assurance').datetimepicker({
            format: 'DD-MM-YYYY',
            locale: "fr",
            defaultDate: "{{ $reception->vehicule->date_assurance->format('d-m-Y') }}",
         });
         $('.select2').select2({
            theme: 'bootstrap4'
         })
      })

   </script>
@endsection
