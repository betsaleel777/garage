@extends('layouts.default')
@section('style')
   <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href=" {{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }} ">
   <link rel="stylesheet" href=" {{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }} ">
@endsection
@section('module-navbar')
   @include('partials.modules.nav-finance')
@endsection
@section('content')
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-md-3">
                  <h1 class="m-0 text-dark">Liste</h1>
               </div><!-- /.col -->
               <div class="col-md-9">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('finance_index') }}">Tableau finance</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('commandes') }}">Tableau des commandes</a></li>
                     <li class="breadcrumb-item active">Commandes simples</li>
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
                        <div class="row">
                           <div class="col-md-2">
                              <a class="btn btn-primary btn-sm ui-button" href="{{ route('commande_simple_add') }}">Créer
                                 commande
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="card-body">
                        <table id="commandes" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Code</th>
                                 <th>Référence</th>
                                 <th>fournisseur</th>
                                 <th>status</th>
                                 <th>Options</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($commandes as $key => $commande)
                                 <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $commande->code }}</td>
                                    <td>{{ $commande->reference }}</td>
                                    <td>{{ $commande->fournisseurLinked->nom }}</td>
                                    <td><span class="badge badge-primary">{{ $commande->status }}</span></td>
                                    <td>
                                       <a href="{{ route('commande_simple_edit', $commande) }}"><i
                                             class="fas fa-lg fa-edit"></i></a>
                                       {{-- <a href="{{ route('piece_show', $piece) }}"><i class="fas fa-lg fa-eye"></i></a> --}}
                                       <direct-delete :url="'/finance/commande/simple/delete/'"
                                          :identifiant="{{ $commande->id }}">
                                       </direct-delete>
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
         $('#commandes').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
         });
      });

   </script>
@endsection
