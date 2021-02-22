@extends('layouts.default')
@section('style')
   <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href=" {{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }} ">
   <link rel="stylesheet" href=" {{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }} ">
@endsection
@section('module-navbar')
   @include('partials.modules.nav-systeme')
@endsection
@section('content')
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Etageres: {{ $zone->nom }}</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('systeme_index') }}">Acceuil Système</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('magasins') }}">Magasins</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('zone_magasin', $zone->magasin) }}">Zones</a></li>
                     <li class="breadcrumb-item active">{{ $zone->nom }}</li>
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
               <div class="col-md-2"></div>
               <!-- /.col-md-6 -->
               <div class="col-md-8">
                  <div class="card">
                     <div class="card-header">
                        {{-- <h5 class="m-0">Featured</h5> --}}
                        <a class="btn btn-primary btn-sm" href="{{ route('etagere_plug', $zone) }}">Créer étagère pour
                           {{ Str::upper($zone->nom) }}
                        </a>
                     </div>
                     <div class="card-body">
                        <table id="zones" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Identifiant</th>
                                 <th>Nom</th>
                                 <th>Option</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($zone->etageres as $key => $etagere)
                                 <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $etagere->identifiant }}</td>
                                    <td>{{ $etagere->nom }}</td>
                                    <td>
                                       <a class="text-primary" href="{{ route('etagere_edit_plug', $etagere) }}"><i
                                             class="fas fa-lg fa-edit"></i>
                                       </a>
                                       <a class="text-primary" href="{{ route('tiroir_etagere', $etagere) }}"><i
                                             class="fas fa-lg fa-plus-circle"></i>
                                       </a>
                                    </td>
                                 </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                     <!-- /.card-body -->
                  </div>
               </div>
               <!-- /.col-md-6 -->
               <div class="col-md-2"></div>
            </div>
            <!-- /.row -->
         </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->
@endsection
@section('scripts')
   <!-- DataTables -->
   <script src=" {{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
   <script src=" {{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }} "></script>
   <script src=" {{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }} "></script>
   <script src=" {{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }} "></script>
   <script>
      $(function() {
         $('#zones').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
         });
      });

   </script>
@endsection
