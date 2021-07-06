@extends('layouts.app')

@section('title', 'Salaire')
<title>Salaire</title>
@section('content')

    <!--Display content section-->
    <section class="py-5">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!--display date-->
                <div class="col-lg-4">
                    <div class="bg-white shadow roundy px-4 py-3 d-flex align-items-center justify-content-between mb-4">
                        <div class="flex-grow-1 d-flex align-items-center">
                            <div class="dot mr-3 bg-blue"></div>
                            <div class="text">
                                <h6 class="mb-0">Date d'aujourd'huit</h6><span class="text-black">
                                    <?php
                                    echo  date('d-m-Y') . "\n";
                                    ?>
                                </span>
                            </div>
                        </div>
                        <div class="icon bg-blue text-white"><i class="fas fa-calendar-alt"></i></div>
                    </div>
                </div>

                <!--Display errors-->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Error!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($message = Session::get('inserted'))
                    <div class="alert alert-success"> <div class="text-center">Données enregistrer avec success !</div></div>
                @endif

                @if($message = Session::get('notinserted'))
                    <div class="alert alert-danger"> <div class="text-center">Probléme d'enregistrement des données !</div></div>
            @endif
                <!--end bloc display errors-->

                <!--end display date-->
                <div class="card">
                    <div class="card-header  d-flex justify-content-between align-items-center">
                        <h6 class="text-uppercase mb-0">Table de gestion des salaires & avances</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-sm table-striped table-hover card-text">
                                <thead>
                                <tr>
                                    <th>MAT</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Date d'entré</th>
                                    <th>Salaire</th>
                                    <th>Imp fiche</th>
                                    <th>Ajouter avance</th>
                                </tr>
                                </thead>
                                <tbody>

                                        @foreach($workers as $sal)
                                            <tr>
                                                <th scope="row">{{ $id_worker = $sal->id_worker }}</th>
                                                <td>{{ $name = $sal->name }}</td>
                                                <td>{{ $family_name = $sal->family_name  }}</td>
                                                <td>{{ $enter_date = $sal->enter_date }}</td>
                                                <td>{{ $pay = $sal->salary }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="col">
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showModal{{ $id_worker }}"><i class="fas fa-eye"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="col">
                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addModal{{ $id_worker }}"><i class="fas fa-user-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--add advance payment Modal start here-->
                                            <!-- Modal -->
                                            <div class="modal fade bd-example-modal-lg" id="addModal{{$id_worker}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Ajouter Avance</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <!--start advance pay form-->
                                                        <form action="{{ route('setadvance', ['id' => $id_worker, 'name' => $name, 'family' =>$family_name]) }}" method="POST">
                                                            <div class="modal-body">
                                                                <!--table advance pay-->
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputEmail4">Nom</label>
                                                                        <input type="email" class="form-control"   value="{{ $name }}" readonly/>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputPassword4">Prénom</label>
                                                                        <input type="text" class="form-control"  value="{{ $family_name }}"  readonly/>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputEmail4">Avance</label>
                                                                        <input type="text" class="form-control" name="advance_pay" placeholder="0" required>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputPassword4">Date</label>
                                                                        <input type="date" class="form-control" name="advance_date" required>
                                                                    </div>
                                                                </div>
                                                            @csrf
                                                                <!--end table advance pay-->
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                                <button type="submit" class="btn btn-primary">Confirmé avance</button>
                                                            </div>
                                                        </form>
                                                        <!--end advance pay form-->
                                                    </div>
                                                </div>
                                            </div>
                                            <!--add advance payment Modal end here-->


                                            <!--download pdf payment Modal start here-->
                                            <!-- Modal -->
                                            <div class="modal fade bd-example-modal-lg" id="showModal{{ $id_worker }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">IMP fiche de paie</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <!--start advance pay form-->
                                                        <form action="{{ route('createPDF', ['id' => $id_worker]) }}" method="GET">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <!--table advance pay-->
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputEmail4">Matricule</label>
                                                                        <input type="email" class="form-control"   value="{{ $id_worker }}" readonly/>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputEmail4">Nom</label>
                                                                        <input type="email" class="form-control"   value="{{ $name }}" readonly/>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputPassword4">Prénom</label>
                                                                        <input type="text" class="form-control"  value="{{ $family_name }}"  readonly/>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputPassword4">Date</label>
                                                                        <input type="text" class="form-control" value="{{ $enter_date }}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label>Moins</label>
                                                                        <select  class="form-control" name="selectedmonth" >
                                                                            <option value="1" selected>Janvier</option>
                                                                            <option value="2">Fevrier</option>
                                                                            <option value="3">Mars</option>
                                                                            <option value="4">Avril</option>
                                                                            <option value="5">Mais</option>
                                                                            <option value="6">Join</option>
                                                                            <option value="7">Juillet</option>
                                                                            <option value="8">Aout</option>
                                                                            <option value="9">Septembre</option>
                                                                            <option value="10">October</option>
                                                                            <option value="11">Nouvembre</option>
                                                                            <option value="12">Décembre</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            <!--end table advance pay-->
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                                <button type="submit" class="btn btn-primary" >Download <i class="fa fa-download" aria-hidden="true"></i></button>
                                                            </div>
                                                        </form>
                                                        <!--end advance pay form-->
                                                    </div>
                                                </div>
                                            </div>
                                            <!--download pdf payment Modal end here-->
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-lg-12 mb-4">
                <!--display avance card start here-->
                <div class="card">
                    <div class="card-header  d-flex justify-content-between align-items-center">
                        <h6 class="text-uppercase mb-0">List des Avances </h6>
                        <div class="form-group mx-sm-3 mb-2">
                            <div class="row">
                                <input type="text" class="form-control" id="searchadvpay" aria-describedby="zoneSearch" placeholder="search">
                                <input type="hidden" class="form-control" id="routeSearch" value="{{ route('ajax-advpayname') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--display workers and advance payment table-->
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                <thead>
                                <tr>

                                    <th class="th-sm">MAT

                                    </th>
                                    <th class="th-sm">Nom

                                    </th>
                                    <th class="th-sm">Prénom

                                    </th>
                                    <th class="th-sm">Avance

                                    </th>
                                    <th class="th-sm">Date d'avance

                                    </th>
                                </tr>
                                </thead>
                                <tbody id="advpayTable">
                                    @if(empty($monthlyadvpay))
                                        <div class="alert alert-info justify-content-between"><div class="text-center"> Pas d'avance !</div></div>
                                        @else
                                        @foreach($monthlyadvpay as $mdp)
                                            <tr>
                                                <td>{{ $mat = $mdp->id_worker }}</td>
                                                <td>{{ $name = $mdp->name }}</td>
                                                <td>{{ $family_name = $mdp->family_name }}</td>
                                                <td>{{ $salary = $mdp->advance_pay }}</td>
                                                <td>{{ $advance = $mdp->advance_date }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!--end display workers and advance payment table-->
                    </div>
                </div>
                <!--display avance card end here -->
            </div>
        </div>
    </section>

@endsection
