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
                     <li class="breadcrumb-item"><a href="{{ route('stock_index') }}">Tableau de bord</a></li>
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
                        <div class="row">
                           <div class="col-md-3">
                              <a class="btn btn-primary ui-button" href="{{ route('piece_add') }}">Nouvelle
                                 Pièce
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="card-body">
                        <table id="pieces" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Code</th>
                                 <th>Référence</th>
                                 <th>Categorie</th>
                                 <th>Type</th>
                                 <th>Options</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($pieces as $key => $piece)
                                 <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $piece->code }}</td>
                                    <td>{{ $piece->reference }}</td>
                                    <td>{{ $piece->categorieLinked->nom }}</td>
                                    <td>{{ $piece->type_piece }}</td>
                                    <td>
                                       <a href="{{ route('piece_edit', $piece) }}"><i class="fas fa-lg fa-edit"></i></a>
                                       <a href="{{ route('piece_show', $piece) }}"><i class="fas fa-lg fa-eye"></i></a>
                                       <delete-button :url="'/stock/piece/delete/'" :identifiant="{{ $piece->id }}">
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
         $('#pieces').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
         });
      });

   </script>
@endsection
