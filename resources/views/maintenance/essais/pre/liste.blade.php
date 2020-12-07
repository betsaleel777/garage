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
                     <li class="breadcrumb-item"><a href="{{ route('essais') }}">Acceuil Essais</a></li>
                     <li class="breadcrumb-item active">Essais Pré-diagnostique</li>
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
                        <a class="btn btn-primary" href="{{ route('preessai_add') }}">Nouveau essai</a>
                     </div>
                     <div class="card-body">
                        <table id="preessais" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Code</th>
                                 <th>Date</th>
                                 <th>Réception</th>
                                 <th>Utilisateur</th>
                                 <th>Validation</th>
                                 <th>Options</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($preessais as $key => $preessai)
                                 <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $preessai->code }}</td>
                                    <td>{{ $preessai->created_at->format('d-m-Y') }}</td>
                                    <td>
                                       <a href="{{ route('reception_show', $preessai->receptionLinked->id) }}">
                                          {{ $preessai->receptionLinked->code }}
                                       </a>
                                    </td>
                                    <td>{{ $preessai->utilisateur->name }}</td>
                                    <td>
                                       @if ($preessai->est_valide())
                                          <b class="text-success">{{ $preessai->etat_validation }}</b>
                                       @else
                                          <b class="text-danger">{{ $preessai->etat_validation }}</b>
                                       @endif
                                    </td>
                                    <td>
                                       <a href="{{ route('preessai_edit', $preessai) }}"><i
                                             class="fas fa-lg fa-edit"></i></a>
                                       <a href="{{ route('preessai_show', $preessai) }}"><i
                                             class="fas fa-lg fa-eye"></i></a>
                                       <delete-button :identifiant="{{ $preessai->id }}"></delete-button>
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
         $('#preessais').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
         });
      });

   </script>
@endsection
