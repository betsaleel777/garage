@extends('layouts.default')
@section('style')
   <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href=" {{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }} ">
   <link rel="stylesheet" href=" {{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }} ">
@endsection
@section('module-navbar')
   @include('partials.modules.nav-stock')
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
                     <li class="breadcrumb-item"><a href="{{ route('stock_index') }}">Tableau du stock</a></li>
                     <li class="breadcrumb-item active">Entrees</li>
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
               <!-- /.col-md-12 -->
               <div class="col-md-12">
                  <div class="card">
                     <div class="card-header">
                        <div class="row">
                           <div class="col-md-2">
                              <button disabled class="btn btn-primary btn-sm ui-button"
                                 href="{{ route('entree_add') }}">Créer
                                 une entrée
                              </button>
                           </div>
                        </div>
                     </div>
                     <div class="card-body">
                        <table id="entrees" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Code</th>
                                 <th>Statut</th>
                                 <th>Utilisateur</th>
                                 <th>Options</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($entrees as $key => $entree)
                                 <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $entree->code }}</td>
                                    <td>
                                       @if ($entree->status === 'normale')
                                          <span class="badge badge-primary">{{ $entree->status }}</span>
                                       @endif
                                       @if ($entree->status === 'faible')
                                          <span class="badge badge-success">{{ $entree->status }}</span>
                                       @endif
                                       @if ($entree->status === 'maximale')
                                          <span class="badge badge-danger">{{ $entree->status }}</span>
                                       @endif
                                       @if ($entree->status === 'élévée')
                                          <span class="badge badge-warning">{{ $entree->status }}</span>
                                       @endif
                                    </td>
                                    <td>{{ $entree->utilisateur->name }}</td>
                                    <td>
                                       <a href="{{ route('entree_print', $entree) }}">
                                          <i class="fas fa-lg fa-print"></i>
                                       </a>
                                       <delete-button :url="'/stock/entree/delete/'" :identifiant="{{ $entree->id }}">
                                       </delete-button>
                                    </td>
                                 </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                     <!-- /.card-body -->
                  </div>
               </div>
               <!-- /.col-md-12 -->
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
         $('#entrees').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
         });
      });

   </script>
@endsection
