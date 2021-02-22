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
                  <h1 class="m-0 text-dark">Liste Magasins</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('systeme_index') }}">Acceuil Système</a></li>
                     <li class="breadcrumb-item active">Magasins</li>
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
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Créer magasin
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                           <a class="dropdown-item" href="{{ route('magasin_add') }}">en mode
                              automatique
                           </a>
                           <a class="dropdown-item" href="{{ route('magasin_add_manuel') }}">en mode
                              manuel
                           </a>
                        </div>
                     </div>
                     <div class="card-body">
                        <table id="magasins" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Nom</th>
                                 <th>lieu</th>
                                 <th>Option</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($magasins as $key => $magasin)
                                 <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $magasin->nom }}</td>
                                    <td>{{ $magasin->lieu }}</td>
                                    <td>
                                       <a class="text-primary" href="{{ route('magasin_edit', $magasin) }}"><i
                                             class="fas fa-lg fa-edit"></i>
                                       </a>
                                       <a class="text-primary" href="{{ route('magasin_show', $magasin) }}"><i
                                             class="fas fa-lg fa-eye"></i>
                                       </a>
                                       <a class="text-primary" href="{{ route('zone_magasin', $magasin) }}"><i
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
         $('#magasins').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "responsive": true,
         });
      });

   </script>
@endsection
