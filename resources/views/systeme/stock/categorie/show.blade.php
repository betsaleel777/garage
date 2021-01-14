@extends('layouts.default')
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
                  <h1 class="m-0 text-dark">Détail: {{ $categorie->nom }}</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('systeme_index') }}">Acceuil</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('categories') }}">Catégories</a></li>
                     <li class="breadcrumb-item active">{{ $categorie->nom }}</li>
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
               <div class="col-md-8">
                  <div class="card">
                     <div class="card-header">
                        <small>
                           <a class="btn btn-primary" href="{{ route('sous_categorie_add', $categorie) }}">Créer une sous
                              categorie de
                              {{ $categorie->nom }}
                           </a>
                        </small>
                     </div>
                     <div class="card-body">
                        <table id="scategories" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th style="width: 1%">#</th>
                                 <th>Nom</th>
                                 <th style="width: 2%">Image</th>
                                 <th style="width: 5%">Option</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($categorie->enfants as $key => $sous_categorie)
                                 <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ mb_strtoupper($sous_categorie->nom) }}</td>
                                    <td>
                                       @empty($sous_categorie->image)
                                          <h6><span class="badge badge-pill badge-danger">Aucune image</span></h6>
                                       @else
                                          <img width="50" height="50" src="{{ url('storage/' . $sous_categorie->image) }}"
                                             alt="{{ $sous_categorie->nom }}">
                                       @endempty
                                    </td>
                                    <td>
                                       <a class="text-primary"
                                          href="{{ route('sous_categorie_edit', $sous_categorie) }}"><i
                                             class="fas fa-lg fa-edit"></i>
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
         $('#scategories').DataTable({
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
