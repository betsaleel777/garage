@extends('layouts.default')
@section('meta')
   <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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
                        <reception-form :enjoliveurs="{{ json_encode($enjoliveurs) }}"
                           :types_vehicules="{{ json_encode($types_vehicules) }}"></reception-form>
                     </div>
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
      function selection(base) {
         base.firstChild.firstChild.checked = true
      }

   </script>
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
