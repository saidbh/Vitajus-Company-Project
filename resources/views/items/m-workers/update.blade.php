@extends('layouts.app')

@section('title', 'Update')
<title>Update</title>
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
                                <h6 class="mb-0">Date d'aujourd'huit</h6><span class="text-black"><?php
                                    echo  date('d-m-Y') . "\n";
                                    ?></span>
                            </div>
                        </div>
                        <div class="icon bg-blue text-white"><i class="fas fa-calendar-alt"></i></div>
                    </div>
                </div>
                <!--end display date-->
                <!-- display errors or success start-->

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

                @if($message = Session::get('success'))
                    <div class="alert alert-success"> Données enregistrer avec success !</div>
                  @endif

                @if($message = Session::get('fail'))
                    <div class="alert alert-danger"> Probléme d'enregistrement des données !</div>
                @endif
                <!--display errors or success end-->
                <!--eroors for deleting records-->
                @if($message = Session::get('deleted'))
                    <div class="alert alert-success"> Données supprimé avec success !</div>
                @endif

                @if($message = Session::get('failed'))
                    <div class="alert alert-danger"> Probléme de supprission des données !</div>
            @endif
                <!--end errors for deleting records-->

                <!--Start errors for editing records-->
                @if($message = Session::get('modified'))
                    <div class="alert alert-success"> Données modifier avec success !</div>
                @endif

                @if($message = Session::get('notModified'))
                    <div class="alert alert-danger"> Probléme de modification des données !</div>
            @endif
                <!--end errors for editing records-->
                <div class="card">
                    <div class="card-header  d-flex justify-content-between align-items-center">
                        <h6 class="text-uppercase mb-0">Table de gestion des personnels</h6>
                        <!--section to add items-->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg>
                        </button>
                        <!--end section to add items-->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-sm table-striped table-hover card-text">
                                <thead>
                                <tr>
                                    <th>MAT</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Adresse</th>
                                    <th>Téléphone</th>
                                    <th>Date d'entré</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($worker as $workers)
                                    <tr>
                                        <th scope="row">{{ $id_worker = $workers->id_worker }}</th>
                                        <td>{{ $name = $workers->name }}</td>
                                        <td>{{ $family_name = $workers->family_name }}</td>
                                        <td>{{ $address = $workers->address }}</td>
                                        <td>{{ $phone = $workers->phone }}</td>
                                        <td>{{ $enter_date = $workers->enter_date }}</td>
                                        <td>
                                            <div class="d-flex d-inline-block justify-content-between align-items-center">
                                                <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#modifyModal{{ $id_worker }}"><i class="fas fa-user-edit"></i></button>
                                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal{{ $id_worker }}"><i class="fas fa-user-times"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!--Modify modal start here-->
                                    <!-- Modal -->
                                    <div class="modal fade bd-example-modal-lg" id="modifyModal{{ $id_worker }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <!--chekin form-->
                                                <form action="{{route('edit-worker', ['id' => $id_worker])}}" method="POST" class="needs-validation">
                                                    <div class="modal-body">
                                                        <div class="form-row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="validationCustom01">Nom </label>
                                                                <input type="text" class="form-control" id="validationCustom01" name="name" value="{{ $name }}" required>

                                                                @error('name')
                                                                <div class="invalid-feedback">
                                                                    Not good :(
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="validationCustom02">Prénom </label>
                                                                <input type="text" class="form-control" id="validationCustom02" name="family_name" value="{{ $family_name }}" required>
                                                                <div class="invalid-feedback">
                                                                    Looks good!
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="validationCustom03">Adresse </label>
                                                                <input type="text" class="form-control" id="validationCustom03" name="address" value="{{ $address }}" required>
                                                                <div class="invalid-feedback">
                                                                    Please provide a valid address.
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="validationCustom04">Téléphone </label>
                                                                <input type="text" class="form-control" id="validationCustom04" name="phone" value="{{ $phone }}" required>
                                                                <div class="invalid-feedback">
                                                                    Please select a valid phone number.
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="validationCustom05">Debut de travail </label>
                                                                <input type="date" class="form-control" id="validationCustom05" name="enter_date" value="{{ $enter_date }}" required>
                                                                <div class="invalid-feedback">
                                                                    Please provide a valid date.
                                                                </div>
                                                            </div>
                                                            @csrf
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-warning">Modifier Personnel</button>
                                                    </div>
                                                </form>
                                                <!--end checkin form-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--Modify modal end here-->

                                    <!--Delete modal start here-->
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{ $id_worker }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('delete-worker', ['id' => $id_worker]) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        Voulez-vous vraiment supprimer <span class="h6"> {{ $name }} {{ $family_name }} </span> ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Delete modal end here-->

                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--insert Modal start here-->
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter personnels</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--chekin form-->
                <form action="{{route('add-workers')}}" method="POST" class="needs-validation">
                    <div class="modal-body">
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom01">Nom </label>
                                    <input type="text" class="form-control" id="validationCustom01" name="name" placeholder="Nom" required>

                                    @error('name')
                                    <div class="invalid-feedback">
                                        Not good :(
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Prénom </label>
                                    <input type="text" class="form-control" id="validationCustom02" name="family_name" placeholder="Prénom" required>
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">Adresse </label>
                                    <input type="text" class="form-control" id="validationCustom03" name="address" placeholder="Ville , Rue , xxxx" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid address.
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom04">Téléphone </label>
                                    <input type="text" class="form-control" id="validationCustom04" name="phone" placeholder="xx xxx xxx" required>
                                    <div class="invalid-feedback">
                                        Please select a valid phone number.
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom05">Debut de travail </label>
                                    <input type="date" class="form-control" id="validationCustom05" name="enter_date"  required>
                                    <div class="invalid-feedback">
                                        Please provide a valid date.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom05">Salaire </label>
                                    <input type="text" class="form-control" id="validationCustom06" placeholder="salaire" name="salary"  required>
                                    <div class="invalid-feedback">
                                        Please provide a valid salary.
                                    </div>
                                </div>
                                @csrf
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Enregistrer Personnel</button>
                    </div>
                </form>
                <!--end checkin form-->
            </div>
        </div>
    </div>
    <!--insert Modal end here-->
@endsection
