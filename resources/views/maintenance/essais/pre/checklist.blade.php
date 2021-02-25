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
                  <h1 class="m-0 text-dark">Nouvel Essai</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('maintenance_index') }}">Tableau de maintenance</a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{ route('essais') }}">Tableau des essais</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('preessai_liste') }}">Essais av-réparation</a></li>
                     <li class="breadcrumb-item active">Créer pré-diagnostique</li>
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
                        <form action="{{ route('preessai_store') }}" method="POST">
                           @csrf
                           <div class="form-group">
                              <label for="reception">Réception</label>
                              <select class="form-control" name="reception" id="reception">
                                 <option selected disabled> .....</option>
                                 @foreach ($receptions as $id => $code)
                                    <option @if (old('reception') == $id) selected @endif value="{{ $id }}">{{ $code }}</option>
                                 @endforeach
                              </select>
                              @error('reception')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="date_preessais">Date pré-diagnostique</label>
                              <div class="input-group date" id="date_preessais" data-target-input="nearest">
                                 <input value="{{ old('date_preessais') }}" name="date_preessais" type="text"
                                    class="form-control datetimepicker-input" data-target="#date_preessais" />
                                 <div class="input-group-append" data-target="#date_preessais"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                 </div>
                              </div>
                              @error('date_preessais')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                           <h5 class="text-primary"><b>Inspection</b></h5>
                           <hr>
                           <div class="form-group">
                              <label for="protection_interne">protection interne</label>
                              <textarea name="protection_interne" class="form-control" id="protection_interne" cols="30"
                                 rows="6">{{ old('protection_interne') }}</textarea>
                           </div>
                           <div class="form-group">
                              <label for="housse_protection">Housse de protection</label>
                              <textarea name="housse_protection" class="form-control" id="housse_protection" cols="30"
                                 rows="6">{{ old('housse_protection') }}</textarea>
                           </div>
                           <h5 class="text-primary"><b>Contrôle d'intérieur</b></h5>
                           <hr>
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
                              <textarea name="pedale_embreillage" class="form-control" id="pedale_embreillage" cols="30"
                                 rows="6">{{ old('pedale_embreillage') }}</textarea>
                           </div>
                           <div class="form-group">
                              <label for="frein_main">Frein à main</label>
                              <textarea name="frein_main" class="form-control" id="frein_main" cols="30"
                                 rows="6">{{ old('frein_main') }}</textarea>
                           </div>
                           <div class="form-group">
                              <label for="ceintures_securite">Etat de fonctionnement des ceintures de securite</label>
                              <textarea name="ceintures_securite" class="form-control" id="ceintures_securite" cols="30"
                                 rows="6">{{ old('ceintures_securite') }}</textarea>
                           </div>
                           <div class="form-group">
                              <label for="feux_phares">Feux et phares</label>
                              <textarea placeholder="Etat de fonctionnement des feux et phares (frein,parking, ...)"
                                 name="feux_phares" class="form-control" id="feux_phares" cols="30"
                                 rows="6">{{ old('feux_phares') }}</textarea>
                           </div>
                           <div class="form-group">
                              <label for="balais_eg">balais essuies glace</label>
                              <textarea placeholder="fonctionnement des balais essuies glace , moteur et bocal lave glace"
                                 name="balais_eg" class="form-control" id="balais_eg" cols="30"
                                 rows="6">{{ old('balais_eg') }}</textarea>
                           </div>
                           <div class="form-group">
                              <label for="leve_vitre">Fonctionnement des leves vitre</label>
                              <textarea name="leve_vitre" class="form-control" id="leve_vitre" cols="30"
                                 rows="6">{{ old('leve_vitre') }}</textarea>
                           </div>
                           <h5 class="text-primary"><b>Contrôle extérieur</b></h5>
                           <hr>
                           <div class="form-group">
                              <label for="eraflures">Eraflures</label>
                              <textarea name="eraflures" class="form-control" id="eraflures" cols="30"
                                 rows="6">{{ old('eraflures') }}</textarea>
                           </div>
                           <div class="form-group">
                              <label for="corrosion_rouille">Corrosion, rouille</label>
                              <textarea name="corrosion_rouille" class="form-control" id="corrosion_rouille" cols="30"
                                 rows="6">{{ old('corrosion_rouille') }}</textarea>
                           </div>
                           <div class="form-group">
                              <label for="elements_endommages">Elements endommagés</label>
                              <textarea name="elements_endommages" class="form-control" id="elements_endommages" cols="30"
                                 rows="6">{{ old('elements_endommages') }}</textarea>
                           </div>
                           <div class="form-group">
                              <label for="clarte_feux_phares">Clarte des feux et phares</label>
                              <textarea name="clarte_feux_phares" class="form-control" id="clarte_feux_phares" cols="30"
                                 rows="6">{{ old('clarte_feux_phares') }}</textarea>
                           </div>
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
                              <label for="pneux_pression_usure">Etat des pneux, pression et profondeur d'usure</label>
                              <textarea name="pneux_pression_usure" class="form-control" id="pneux_pression_usure"
                                 cols="30" rows="6">{{ old('pneux_pression_usure') }}</textarea>
                           </div>
                           <h5 class="text-primary"><b>Sous le capot</b></h5>
                           <hr>
                           <div class="form-group">
                              <label for="niveaux_liquides">niveau des liquides</label>
                              <textarea placeholder="moteur, frein, direction, réfroidissement ..." name="niveaux_liquides"
                                 class="form-control" id="niveaux_liquides" cols="30"
                                 rows="6">{{ old('niveaux_liquides') }}</textarea>
                           </div>
                           <div class="form-group">
                              <label for="raccords_durite">Raccords et durite de carburant</label>
                              <textarea name="raccords_durite" class="form-control" id="raccords_durite" cols="30"
                                 rows="6">{{ old('raccords_durite') }}</textarea>
                           </div>
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
                           <h5 class="text-primary"><b>Sous le carosserie</b></h5>
                           <hr>
                           <div class="form-group">
                              <label for="disques_tambours_frein">Plaquettes, disque et tambours de frein</label>
                              <textarea name="disques_tambours_frein" class="form-control" id="disques_tambours_frein"
                                 cols="30" rows="6">{{ old('disques_tambours_frein') }}</textarea>
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
         $('#date_preessais').datetimepicker({
            format: 'DD/MM/YYYY'
         });
         $('.select2').select2({
            theme: 'bootstrap4'
         })
      })

   </script>
@endsection
