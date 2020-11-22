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
                     <li class="breadcrumb-item"><a href="{{ route('receptions') }}">Acceuil réception</a></li>
                     <li class="breadcrumb-item active">Liste réceptions</li>
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
                        <a class="btn btn-primary" href="{{ route('reception_add') }}">Nouvelle Réception</a>
                     </div>
                     <div class="card-body">
                        <table id="receptions" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Browser</th>
                                 <th>Platform(s)</th>
                                 <th>Engine version</th>
                                 <th>CSS grade</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($receptions as $key => $reception)
                                 <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>Internet
                                       Explorer 4.0
                                    </td>
                                    <td>Win 95+</td>
                                    <td> 4</td>
                                    <td>X</td>
                                 </tr>
                              @endforeach
                           </tbody>
                           <tfoot>
                              <tr>
                                 <th>Rendering engine</th>
                                 <th>Browser</th>
                                 <th>Platform(s)</th>
                                 <th>Engine version</th>
                                 <th>CSS grade</th>
                              </tr>
                           </tfoot>
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
            "autoWidth": true,
            "responsive": true,
         });
      });

   </script>
@endsection
