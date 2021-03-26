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
                  {{-- <h1 class="m-0 text-dark">Liste</h1> --}}
               </div><!-- /.col -->
               <div class="col-md-9">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ route('finance_index') }}">Tableau des finances</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('commandes') }}">Tableau des commandes</a></li>
                     <li class="breadcrumb-item active">Commandes</li>
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
                           <div class="col-md-8">
                              <h5>Demandes du stock</h5>
                           </div>
                        </div>
                     </div>
                     <div class="card-body">
                        <table id="demandes" class="table table-bordered table-hover text-center">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Code</th>
                                 <th>Motif</th>
                                 <th>Urgence</th>
                                 <th>Destinataire</th>
                                 <th>Commande</th>
                                 <th>Date</th>
                                 <th>Utilisateur</th>
                                 <th>Options</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($demandes as $key => $demande)
                                 <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $demande->code }}</td>
                                    <td>{{ $demande->motif }}</td>
                                    <td>
                                       @if ($demande->urgence === 'normale')
                                          <span class="badge badge-primary">{{ $demande::URGENCE_NORMALE }}</span>
                                       @elseif ($demande->urgence === 'faible')
                                          <span class="badge badge-success">{{ $demande::URGENCE_FAIBLE }}</span>
                                       @elseif ($demande->urgence === 'maximale')
                                          <span class="badge badge-danger">{{ $demande::URGENCE_MAXIMALE }}</span>
                                       @else
                                          <span class="badge badge-warning">{{ $demande::URGENCE_ELEVEE }}</span>
                                       @endif
                                    </td>
                                    <td>{{ $demande->destinataire }}</td>
                                    <td>
                                       @if (empty($demande->commandes->all()))
                                          <span class="badge badge-danger">non traitée</span>
                                       @elseif ($demande->totalementTraitee())
                                          <span class="badge badge-success">traitée</span>
                                       @else
                                          <span class="badge badge-primary">en cours</span>
                                       @endif
                                    </td>
                                    <td>{{ $demande->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $demande->utilisateur->name }}</td>
                                    <td>
                                       <a href="{{ route('demande_show', $demande) }}">
                                          <i class="fas fa-lg fa-eye"></i>
                                       </a>
                                       <a href="{{ route('commande_simple_plug', $demande) }}">
                                          <i class="fas fa-lg fa-comment-dollar"></i>
                                       </a>
                                       <delete-button :url="'/stock/demande/delete/'" :identifiant="{{ $demande->id }}">
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
               <!-- /.col-md-12 -->
               <div class="col-md-12">
                  <div class="card">
                     <div class="card-header">
                        <div class="row">
                           <div class="col-md-10">
                              <h5>Commandes effectuées directement</h5>
                           </div>
                           <div class="col-md-2">
                              <a class="btn btn-primary btn-sm ui-button" href="{{ route('commande_simple_add') }}">
                                 Commander directement
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="card-body">
                        <table id="commandes" class="table table-bordered table-hover text-center">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Code</th>
                                 <th>Pour le magasin</th>
                                 <th>Adressée à</th>
                                 <th>Status</th>
                                 <th>Date</th>
                                 <th>Utilisateur</th>
                                 <th>Options</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($commandes as $key => $commande)
                                 <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $commande->code }}</td>
                                    <td>{{ $commande->magasinLinked->nom }}</td>
                                    <td>{{ $commande->fournisseurLinked->nom }}</td>
                                    <td>
                                       @if ($commande->estEnCours())
                                          <span class="badge badge-primary">{{ $commande::EN_COURS }}</span>
                                       @elseif ($commande->estLivree())
                                          <span class="badge badge-success">{{ $commande::LIVREE }}</span>
                                       @else
                                          <span class="badge badge-danger">{{ $commande::ANNULEE }}</span>
                                       @endif
                                    </td>
                                    <td>{{ $commande->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $commande->utilisateur->name }}</td>
                                    <td>
                                       <a href="{{ route('commande_simple_show', $commande) }}">
                                          <i class="fas fa-lg fa-eye"></i>
                                       </a>
                                       <delete-button :url="'/finance/commande/delete/'"
                                          :identifiant="{{ $commande->id }}">
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
         $('#demandes').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
         });
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
