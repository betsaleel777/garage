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
                  <h1 class="m-0 text-dark">Les Categories de pièces</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('systeme_index') }}">Acceuil Système</a></li>
                     <li class="breadcrumb-item active">Catégories</li>
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
               <div class="col-md-3"></div>
               <!-- /.col-md-6 -->
               <div class="col-md-6">
                  <div class="card">
                     <div class="card-header">
                        <a class="btn btn-primary btn-sm" href="{{ route('categorie_add') }}">Créer catégorie</a>
                     </div>
                     <div class="card-body">
                        <table id="categories" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th style="width: 1%">#</th>
                                 <th>Nom</th>
                                 <th style="width: 2%">Image</th>
                                 <th style="width: 5%">Option</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($categories as $key => $categorie)
                                 <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ mb_strtoupper($categorie->nom) }}</td>
                                    <td>
                                       @empty($categorie->image)
                                          <h6><span class="badge badge-pill badge-danger">Aucune image</span></h6>
                                       @else
                                          <img width="50" height="50" src="{{ url('storage/' . $categorie->image) }}"
                                             alt="{{ $categorie->nom }}">
                                       @endempty
                                    </td>
                                    <td>
                                       <a class="text-primary" href="{{ route('categorie_edit', $categorie) }}"><i
                                             class="fas fa-lg fa-edit"></i>
                                       </a>
                                       <a class="text-primary" href="{{ route('categorie_show', $categorie) }}"><i
                                             class="fas fa-lg fa-eye"></i>
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
               <div class="col-md-3"></div>
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
         $('#categories').DataTable({
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
