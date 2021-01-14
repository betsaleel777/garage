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
                           <div class="row">
                              <div class="col-md-12">
                                 <div style="margin-bottom: 3%">
                                    <h5 class="text-primary">Informations du client</h5>
                                    <hr>
                                    <client-form></client-form>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <h5 class="text-primary">Informations du véhicule</h5>
                                 <hr />
                                 <div class="row">
                                    <div class="form-group col-md-4">
                                       <label for="nom_deposant">Nom du déposant</label>
                                       <input value="{{ old('nom_deposant') }}" name="nom_deposant" class="form-control"
                                          id="nom_deposant" />
                                       @error('nom_deposant')
                                          <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                       <label for="dmc">dmc</label>
                                       <input value="{{ old('dmc') }}" name="dmc" class="form-control" id="dmc" />
                                       @error('dmc')
                                          <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                       <label>Enjoliveur</label><br>
                                       @foreach ($enjoliveurs as $key => $enjoliveur)
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="checkbox" name="enjoliveur[]"
                                                id="en{{ $key + 1 }}" value="{{ $enjoliveur->id }}" @if (is_array(old('enjoliveur')))
                                             @if (in_array($enjoliveur->id, old('enjoliveur')))
                                                checked
                                             @endif
                                       @endif>
                                       <label class="form-check-label" for="en{{ $key + 1 }}">{{ $enjoliveur->nom }}
                                       </label>
                                    </div>
                                    @endforeach
                                 </div>
                                 @php
                                 $erreurs = [];
                                 if(!empty($errors)){
                                 $erreurs = array_merge($erreurs,['immatriculation' =>
                                 $errors->first('immatriculation')]);
                                 $erreurs = array_merge($erreurs,['marque' => $errors->first('marque')]);
                                 $erreurs = array_merge($erreurs,['annee' => $errors->first('annee')]);
                                 $erreurs = array_merge($erreurs,['modele' => $errors->first('modele')]);
                                 $erreurs = array_merge($erreurs,['couleur' => $errors->first('couleur')]);
                                 $erreurs = array_merge($erreurs,['chassis' => $errors->first('chassis')]);
                                 $erreurs = array_merge($erreurs,['type_vehicule' => $errors->first('type_vehicule')]);
                                 }
                                 @endphp
                                 <vehicule-info-form :errors="{{ json_encode($erreurs) }}"
                                    :old="{{ json_encode(Session::getOldInput()) }}"
                                    :immatriculations="{{ json_encode($immatriculations) }}"
                                    :types_vehicules="{{ json_encode($categories) }}"></vehicule-info-form>
                                 <div class="form-group col-md-4">
                                    <label for="kilometrage_actuel">Kilometrage Actuel</label>
                                    <input value="{{ old('kilometrage_actuel') }}" name="kilometrage_actuel"
                                       class="form-control" id="kilometrage_actuel" />
                                    @error('kilometrage_actuel')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label for="prochaine_vidange">Prochaine Vidange</label>
                                    <input value="{{ old('prochaine_vidange') }}" name="prochaine_vidange"
                                       class="form-control" id="prochaine_vidange" />
                                    @error('prochaine_vidange')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Niveau de carburant</label><br>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="niveau_carburant" id="ca1"
                                          value="0" @if (old('niveau_carburant') == '0')
                                       checked
                                       @endif>
                                       <label class="form-check-label" for="ca1">0</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="niveau_carburant" id="ca2"
                                          value="1/4" @if (old('niveau_carburant') == '1/4')
                                       checked
                                       @endif>
                                       <label class="form-check-label" for="ca2">1/4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="niveau_carburant" id="ca3"
                                          value="1/2" @if (old('niveau_carburant') == '1/2')
                                       checked
                                       @endif>
                                       <label class="form-check-label" for="ca3">1/2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="niveau_carburant" id="ca4"
                                          value="3/4" @if (old('niveau_carburant') == '3/4')
                                       checked
                                       @endif>
                                       <label class="form-check-label" for="ca4">3/4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="niveau_carburant" id="ca5"
                                          value="1" @if (old('niveau_carburant') == '1')
                                       checked
                                       @endif>
                                       <label class="form-check-label" for="ca5">1</label>
                                    </div>
                                    @error('niveau_carburant')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="date_sitca">Date de dernière visite technique</label>
                                    <div class="input-group date" id="date_sitca" data-target-input="nearest">
                                       <input value="{{ old('date_sitca') }}" name="date_sitca" type="text"
                                          class="form-control datetimepicker-input" data-target="#date_sitca" />
                                       <div class="input-group-append" data-target="#date_sitca"
                                          data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                       </div>
                                    </div>
                                    @error('date_sitca')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="date_assurance">Date de fin de l'assurance</label>
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
                              </div>
                           </div>
                           {{-- checklist --}}
                           <div class="col-md-12">
                              <div class="row">
                                 <div class="col-md-4">
                                    <h5 class="text-primary">Checklist</h5>
                                 </div>
                                 <div style="text-align: right" class="col-md-8">
                                    <span class="text-muted">{ I: inexistant , B: bon, P: passable, M: mauvais }</span>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-md-12">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
                                             <th style="width: 40%">Compartiements</th>
                                             <th style="width: 5%">I</th>
                                             <th style="width: 5%">B</th>
                                             <th style="width: 5%">P</th>
                                             <th style="width: 5%">M</th>
                                             <th style="width: 20%"></th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <th colspan="6"><b>Intérieur</b></th>
                                          </tr>
                                          <tr>
                                             <td>Eclairage</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="eclairage_int"
                                                      id="inlineRadio4" value="inexistant" @if (old('eclairage_int') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="eclairage_int"
                                                      id="inlineRadio1" value="bon" @if (old('eclairage_int') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="eclairage_int"
                                                      id="inlineRadio2" value="passable" @if (old('eclairage_int') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="eclairage_int"
                                                      id="inlineRadio3" value="mauvais" @if (old('eclairage_int') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('eclairage_int')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Rétroviseur</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="retroviseurs_int"
                                                      id="b4" value="inexistant" @if (old('retroviseurs_int') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="retroviseurs_int"
                                                      id="b1" value="bon" @if (old('retroviseurs_int') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="retroviseurs_int"
                                                      id="b2" value="passable" @if (old('retroviseurs_int') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="retroviseurs_int"
                                                      id="b3" value="mauvais" @if (old('retroviseurs_int') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('retroviseurs_int')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Klaxon</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="klaxon" id="c4"
                                                      value="inexistant" @if (old('klaxon') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="klaxon" id="c1"
                                                      value="bon" @if (old('klaxon') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="klaxon" id="c2"
                                                      value="passable" @if (old('klaxon') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="klaxon" id="c3"
                                                      value="mauvais" @if (old('klaxon') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('klaxon')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Essuies glace</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="essuies_glace"
                                                      id="d4" value="inexistant" @if (old('essuies_glace') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="essuies_glace"
                                                      id="d1" value="bon" @if (old('essuies_glace') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="essuies_glace"
                                                      id="d2" value="passable" @if (old('essuies_glace') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="essuies_glace"
                                                      id="d3" value="mauvais" @if (old('essuies_glace') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('essuies_glace')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Radio</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="radio" id="e4"
                                                      value="inexistant" @if (old('radio') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="radio" id="e1"
                                                      value="bon" @if (old('radio') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="radio" id="e2"
                                                      value="passable" @if (old('radio') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="radio" id="e3"
                                                      value="mauvais" @if (old('radio') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('radio')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Climatisation</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="climatisation"
                                                      id="f4" value="inexistant" @if (old('climatisation') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="climatisation"
                                                      id="f1" value="bon" @if (old('climatisation') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="climatisation"
                                                      id="f3" value="mauvais" @if (old('climatisation') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="climatisation"
                                                      id="f2" value="passable" @if (old('climatisation') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('climatisation')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Frein de stationnement</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="frein_stationnement"
                                                      id="c4" value="inexistant" @if (old('frein_stationnement') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="frein_stationnement"
                                                      id="c1" value="bon" @if (old('frein_stationnement') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="frein_stationnement"
                                                      id="c2" value="passable" @if (old('frein_stationnement') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="frein_stationnement"
                                                      id="c3" value="mauvais" @if (old('frein_stationnement') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('frein_stationnement')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Sièges</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="sieges" id="g4"
                                                      value="inexistant" @if (old('sieges') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="sieges" id="g1"
                                                      value="bon" @if (old('sieges') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="sieges" id="g3"
                                                      value="mauvais" @if (old('sieges') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="sieges" id="g2"
                                                      value="passable" @if (old('sieges') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('sieges')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Tableau de bord</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="tableau_bord" id="h4"
                                                      value="inexistant" @if (old('tableau_bord') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="tableau_bord" id="h1"
                                                      value="bon" @if (old('tableau_bord') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="tableau_bord" id="h2"
                                                      value="passable" @if (old('tableau_bord') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="tableau_bord" id="h3"
                                                      value="mauvais" @if (old('tableau_bord') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>@error('tableau_bord')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Lève vitre</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="leve_vitre" id="i4"
                                                      value="inexistant" @if (old('leve_vitre') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="leve_vitre" id="i1"
                                                      value="bon" @if (old('leve_vitre') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="leve_vitre" id="i2"
                                                      value="passable" @if (old('leve_vitre') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="leve_vitre" id="i3"
                                                      value="mauvais" @if (old('leve_vitre') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>@error('leve_vitre')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Vérouillage des portes</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="verrouillage_portes"
                                                      id="j4" value="inexistant" @if (old('verrouillage_portes') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="verrouillage_portes"
                                                      id="j1" value="bon" @if (old('verrouillage_portes') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="verrouillage_portes"
                                                      id="j2" value="passable" @if (old('verrouillage_portes') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="verrouillage_portes"
                                                      id="j3" value="mauvais" @if (old('verrouillage_portes') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('verrouillage_portes')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Ouverture des portes Intérieur</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="ouverture_portes_int"
                                                      id="k4" value="inexistant" @if (old('ouverture_portes_int') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="ouverture_portes_int"
                                                      id="k1" value="bon" @if (old('ouverture_portes_int') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="ouverture_portes_int"
                                                      id="k2" value="passable" @if (old('ouverture_portes_int') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="ouverture_portes_int"
                                                      id="k3" value="mauvais" @if (old('ouverture_portes_int') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>@error('ouverture_portes_int')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <th colspan="6"><b>Extérieur</b></th>
                                          </tr>
                                          <tr>
                                             <td>Roues</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="roues" id="q4"
                                                      value="inexistant" @if (old('roues') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="roues" id="q1"
                                                      value="bon" @if (old('roues') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="roues" id="q2"
                                                      value="passable" @if (old('roues') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="roues" id="q3"
                                                      value="mauvais" @if (old('roues') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('roues')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Feux arrières</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_arrieres"
                                                      id="r4" value="inexistant" @if (old('feux_arrieres') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_arrieres"
                                                      id="r1" value="bon" @if (old('feux_arrieres') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_arrieres"
                                                      id="r2" value="passable" @if (old('feux_arrieres') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_arrieres"
                                                      id="r3" value="mauvais" @if (old('feux_arrieres') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('feux_arrieres')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Balais e/g avant</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio"
                                                      name="balais_essuies_glace_av" id="s4" value="inexistant"
                                                      @if (old('balais_essuies_glace_av') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio"
                                                      name="balais_essuies_glace_av" id="s1" value="bon" @if (old('balais_essuies_glace_av') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio"
                                                      name="balais_essuies_glace_av" id="s2" value="passable" @if (old('balais_essuies_glace_av') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio"
                                                      name="balais_essuies_glace_av" id="s3" value="mauvais" @if (old('balais_essuies_glace_av') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('balais_essuies_glace_av')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Balais e/g arrière</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio"
                                                      name="balais_essuies_glace_ar" id="t4" value="inexistant"
                                                      @if (old('balais_essuies_glace_ar') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio"
                                                      name="balais_essuies_glace_ar" id="t1" value="bon" @if (old('balais_essuies_glace_ar') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio"
                                                      name="balais_essuies_glace_ar" id="t2" value="passable" @if (old('balais_essuies_glace_ar') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio"
                                                      name="balais_essuies_glace_ar" id="t3" value="mauvais" @if (old('balais_essuies_glace_ar') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('balais_essuies_glace_ar')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Trappe à carburant</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="trape_carburant"
                                                      id="u4" value="inexistant" @if (old('trape_carburant') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="trape_carburant"
                                                      id="u1" value="bon" @if (old('trape_carburant') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="trape_carburant"
                                                      id="u2" value="passable" @if (old('trape_carburant') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="trape_carburant"
                                                      id="u3" value="mauvais" @if (old('trape_carburant') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('trape_carburant')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Ouverture porte extérieur</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="ouverture_portes_ext"
                                                      id="v4" value="inexistant" @if (old('ouverture_portes_ext') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="ouverture_portes_ext"
                                                      id="v1" value="bon" @if (old('ouverture_portes_ext') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="ouverture_portes_ext"
                                                      id="v2" value="passable" @if (old('ouverture_portes_ext') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="ouverture_portes_ext"
                                                      id="v3" value="mauvais" @if (old('ouverture_portes_ext') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('ouverture_portes_ext')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Rétroviseur extérieur</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="retroviseurs_ext"
                                                      id="w4" value="inexistant" @if (old('retroviseurs_ext') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="retroviseurs_ext"
                                                      id="w1" value="bon" @if (old('retroviseurs_ext') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="retroviseurs_ext"
                                                      id="w2" value="passable" @if (old('retroviseurs_ext') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="retroviseurs_ext"
                                                      id="w3" value="mauvais" @if (old('retroviseurs_ext') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('retroviseurs_ext')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Clé de contact</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="cle_contact" id="x4"
                                                      value="inexistant" @if (old('cle_contact') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="cle_contact" id="x1"
                                                      value="bon" @if (old('cle_contact') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="cle_contact" id="x2"
                                                      value="passable" @if (old('cle_contact') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="cle_contact" id="x3"
                                                      value="mauvais" @if (old('cle_contact') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('cle_contact')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Clignotants</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="clignotants" id="y4"
                                                      value="inexistant" @if (old('clignotants') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="clignotants" id="y1"
                                                      value="bon" @if (old('clignotants') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="clignotants" id="y2"
                                                      value="passable" @if (old('clignotants') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="clignotants" id="y3"
                                                      value="mauvais" @if (old('clignotants') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('clignotants')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Veilleuses</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="veilleuses" id="z4"
                                                      value="inexistant" @if (old('veilleuses') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="veilleuses" id="z1"
                                                      value="bon" @if (old('veilleuses') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="veilleuses" id="z2"
                                                      value="passable" @if (old('veilleuses') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="veilleuses" id="z3"
                                                      value="mauvais" @if (old('veilleuses') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('veilleuses')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Feux de croisement</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_croisement"
                                                      id="a4" value="inexistant" @if (old('feux_croisement') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_croisement"
                                                      id="a1" value="bon" @if (old('feux_croisement') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_croisement"
                                                      id="a2" value="passable" @if (old('feux_croisement') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_croisement"
                                                      id="a3" value="mauvais" @if (old('feux_croisement') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('feux_croisement')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Feux de récul</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_recul" id="ab4"
                                                      value="inexistant" @if (old('feux_recul') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_recul" id="ab1"
                                                      value="bon" @if (old('feux_recul') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_recul" id="ab2"
                                                      value="passable" @if (old('feux_recul') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_recul" id="ab3"
                                                      value="mauvais" @if (old('feux_recul') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('feux_recul')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Feux de stop</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_stop" id="ac4"
                                                      value="inexistant" @if (old('feux_stop') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_stop" id="ac1"
                                                      value="bon" @if (old('feux_stop') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_stop" id="ac2"
                                                      value="passable" @if (old('feux_stop') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_stop" id="ac3"
                                                      value="mauvais" @if (old('feux_stop') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('feux_stop')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Feux antibrouillard</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_antibrouillard"
                                                      id="ad4" value="inexistant" @if (old('feux_antibrouillard') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_antibrouillard"
                                                      id="ad1" value="bon" @if (old('feux_antibrouillard') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_antibrouillard"
                                                      id="ad2" value="passable" @if (old('feux_antibrouillard') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="feux_antibrouillard"
                                                      id="ad3" value="mauvais" @if (old('feux_antibrouillard') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('feux_antibrouillard')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          <tr>
                                             <td>Cric</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="cric" id="ae4"
                                                      value="inexistant" @if (old('cric') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="cric" id="ae1"
                                                      value="bon" @if (old('cric') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="cric" id="ae2"
                                                      value="passable" @if (old('cric') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="cric" id="ae3"
                                                      value="mauvais" @if (old('cric') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('cric')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Roues de secours</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="roues_secours"
                                                      id="af4" value="inexistant" @if (old('roues_secours') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="roues_secours"
                                                      id="af1" value="bon" @if (old('roues_secours') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="roues_secours"
                                                      id="af2" value="passable" @if (old('roues_secours') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="roues_secours"
                                                      id="af3" value="mauvais" @if (old('roues_secours') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>@error('roues_secours')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Manivelles</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="manivelle" id="ag4"
                                                      value="inexistant" @if (old('manivelle') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="manivelle" id="ag1"
                                                      value="bon" @if (old('manivelle') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="manivelle" id="ag2"
                                                      value="passable" @if (old('manivelle') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="manivelle" id="ag3"
                                                      value="mauvais" @if (old('manivelle') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>@error('manivelle')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Trousses</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="trousse" id="ah4"
                                                      value="inexistant" @if (old('trousse') == 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="trousse" id="ah1"
                                                      value="bon" @if (old('trousse') == 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="trousse" id="ah2"
                                                      value="passable" @if (old('trousse') == 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="trousse" id="ah3"
                                                      value="mauvais" @if (old('trousse') == 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('trousse')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <th colspan="6"><b>Sous le capot</b></th>
                                          </tr>
                                          <tr>
                                             <td>Huile de moteur</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="huile_moteur" id="l4"
                                                      value="inexistant" @if (old('huile_moteur') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="huile_moteur" id="l1"
                                                      value="bon" @if (old('huile_moteur') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="huile_moteur" id="l2"
                                                      value="passable" @if (old('huile_moteur') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="huile_moteur" id="l3"
                                                      value="mauvais" @if (old('huile_moteur') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('huile_moteur')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Huile de frein</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="huile_frein" id="m4"
                                                      value="inexistant" @if (old('huile_frein') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="huile_frein" id="m1"
                                                      value="bon" @if (old('huile_frein') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="huile_frein" id="m2"
                                                      value="passable" @if (old('huile_frein') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="huile_frein" id="m3"
                                                      value="mauvais" @if (old('huile_frein') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('huile_frein')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Huile de direction</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="huile_direction"
                                                      id="n4" value="inexistant" @if (old('huile_direction') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="huile_direction"
                                                      id="n1" value="bon" @if (old('huile_direction') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="huile_direction"
                                                      id="n2" value="passable" @if (old('huile_direction') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="huile_direction"
                                                      id="n3" value="mauvais" @if (old('huile_direction') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('huile_direction')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Liquide de refroidissement</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio"
                                                      name="liquide_refroidissement" id="o4" value="inexistant"
                                                      @if (old('liquide_refroidissement') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio"
                                                      name="liquide_refroidissement" id="o1" value="bon" @if (old('liquide_refroidissement') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio"
                                                      name="liquide_refroidissement" id="o2" value="passable" @if (old('liquide_refroidissement') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio"
                                                      name="liquide_refroidissement" id="o3" value="mauvais" @if (old('liquide_refroidissement') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('liquide_refroidissement')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Liquide lave glace</td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="liquide_lave_glace"
                                                      id="p4" value="inexistant" @if (old('liquide_lave_glace') === 'inexistant')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="liquide_lave_glace"
                                                      id="p1" value="bon" @if (old('liquide_lave_glace') === 'bon')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="liquide_lave_glace"
                                                      id="p2" value="passable" @if (old('liquide_lave_glace') === 'passable')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="form-check form-check-inline">
                                                   <input class="form-check-input" type="radio" name="liquide_lave_glace"
                                                      id="p3" value="mauvais" @if (old('liquide_lave_glace') === 'mauvais')
                                                   checked
                                                   @endif>
                                                </div>
                                             </td>
                                             <td>
                                                @error('liquide_lave_glace')
                                                   <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group col-md-12">
                              <h5 class="text-primary">Ressenti du client</h5>
                              <hr>
                              <label for="ressenti">Avis</label>
                              <textarea class="form-control" name="ressenti" id="ressenti" cols="30"
                                 rows="6">{{ old('ressenti') }}</textarea>
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
   <!-- /.content -->
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
            format: 'DD-MM-YYYY'
         });
         $('#date_assurance').datetimepicker({
            format: 'DD-MM-YYYY'
         });
         $('.select2').select2({
            theme: 'bootstrap4'
         })
      })

   </script>
@endsection
