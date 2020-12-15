@extends('layouts.default')
@section('style')
   <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href=" {{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }} ">
   <link rel="stylesheet" href=" {{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }} ">
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
                  <h1 class="m-0 text-dark">Liste</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('diagnostiques') }}">Tableau des diagnostiques</a></li>
                     <li class="breadcrumb-item active">Diagnostiques</li>
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
                     </div>
                     <div class="card-body">
                        <table id="receptions" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Code</th>
                                 <th>Date</th>
                                 <th>Déposant</th>
                                 <th>Utilisateur</th>
                                 <th>Statut</th>
                                 <th>Validation Diagnostique</th>
                                 <th>Options</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($receptions as $key => $reception)
                                 <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $reception->code }}</td>
                                    <td>{{ $reception->created_at->format('d-m-Y') }}</td>
                                    <td>{{ mb_strtoupper($reception->nom_deposant) }}</td>
                                    <td>{{ $reception->utilisateur->name }}</td>
                                    <td><b class="text-primary">{{ $reception->statut }}</b></td>
                                    <td>
                                       @empty($reception->diagnostique)
                                          <b class="text-danger">{{ 'non validé' }}</b>
                                       @else
                                          @if ($reception->diagnostique->est_valide())
                                             <b class="text-success">{{ $reception->diagnostique->etat_validation }}</b>
                                          @else
                                             <b class="text-danger">{{ $reception->diagnostique->etat_validation }}</b>
                                          @endif
                                       @endempty
                                    </td>
                                    <td>
                                       @if (!empty($reception->diagnostique))
                                          @if ($reception->diagnostique->est_valide())
                                             <div class="row">
                                                <div class="col-md-3">
                                                   <a class="text-primary"
                                                      href="{{ route('diagnostique_show', $reception) }}">
                                                      <i class="fas fa-lg fa-eye"></i>
                                                   </a>
                                                </div>
                                             </div>
                                          @else
                                             <div class="row">
                                                <div class="col-md-3">
                                                   <a class="text-primary"
                                                      href="{{ route('diagnostique_complete', $reception) }}">
                                                      <i class="far fa-lg fa-file-alt"></i>
                                                   </a>
                                                </div>
                                             </div>
                                          @endif
                                       @else
                                          <div class="row">
                                             <div class="col-md-3">
                                                <a class="text-primary"
                                                   href="{{ route('diagnostique_complete', $reception) }}">
                                                   <i class="far fa-lg fa-file-alt"></i>
                                                </a>
                                             </div>
                                          </div>
                                       @endif
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
         $('#receptions').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
         });
      });

   </script>
@endsection
