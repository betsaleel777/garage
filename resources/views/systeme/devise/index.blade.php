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
                  <h1 class="m-0 text-dark">Liste Devises</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('systeme_index') }}">Acceuil Système</a></li>
                     <li class="breadcrumb-item active">Devises</li>
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
                        <a class="btn btn-primary" href="{{ route('devise_add') }}">Créer Devise</a>
                     </div>
                     <div class="card-body">
                        <table id="devises" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Nom</th>
                                 <th>Abréviation</th>
                                 <th>Option</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($devises as $key => $devise)
                                 <tr @if ($devise->current) style = 'background-color: #42b883' @endif>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $devise->nom }}</td>
                                    <td>{{ $devise->abreviation }}</td>
                                    <td>
                                       <a class="text-primary" href="{{ route('devise_edit', $devise) }}">
                                          <i class="fas fa-lg fa-edit"></i>
                                       </a>
                                       @if (!$devise->current)
                                          <a class="text-primary" href="{{ route('devise_current', $devise) }}">
                                             <i class="fas fa-lg fa-check"></i>
                                          </a>
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
         $('#devises').DataTable({
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
