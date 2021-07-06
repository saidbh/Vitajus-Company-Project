@extends('layouts.app')

@section('title', 'Pointage')
<title>Pointage</title>
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
                                <h6 class="mb-0">Date d'aujourd'huit</h6><span class="text-black"><?php echo date('d-m-Y')?></span>
                            </div>
                        </div>
                        <div class="icon bg-blue text-white"><i class="fas fa-calendar-alt"></i></div>
                    </div>
                </div>
                <!--end display date-->

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

                @if($message = Session::get('success'))
                    <div class="alert alert-success"> Pointage enregistrer avec success !</div>
                @endif

                @if($message = Session::get('fail'))

                    <div class="alert alert-danger"> Probléme d'enregistrement des données ! -- {{ $message }} --</div>
            @endif
                @if($message = Session::get('updated'))
                    <div class="alert alert-success">Modification de  pointage effectueé avec success !</div>
            @endif

            <!--end bloc display errors-->

                <div class="card">
                    <div class="card-header  d-flex justify-content-between align-items-center">
                        <h6 class="text-uppercase mb-0">Table de gestion des pointages</h6>
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
                            <table class="table table-striped table-hover card-text">
                                <thead>
                                <tr>
                                    <th>MAT</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Modifier</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($savedcheckin->isEmpty())
                                    <div class="alert alert-info"> <div class="text-center">Pointage non fait pour aujourd'huit </div></div>
                                @endif
                                @foreach($savedcheckin as $checkshow)
                                    <tr>
                                        <th scope="row">{{ $mat = $checkshow->id_worker }}</th>
                                        <td>{{ $name = $checkshow->name }}</td>
                                        <td>{{ $family = $checkshow->family_name }}</td>
                                        <td>{{ $date_checkin = $checkshow->created_at }}</td>
                                        <td>{{ $status = $checkshow->status }}</td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="col">
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#EditModal{{ $mat }}"><i class="fas fa-user-edit"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>

                                <!--Modal to edit statut of worker pointing start-->

                                <!-- Modal -->
                                <div class="modal fade" id="EditModal{{ $mat }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">modifier pointage</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!--form update status start-->
                                            <form action="{{ route('updatecheckin',['id' => $mat]) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="formGroupExampleInput">Matricule </label>
                                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="{{ $mat }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="formGroupExampleInput2">Nom </label>
                                                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="{{ $name }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="formGroupExampleInput2">Prénom </label>
                                                        <input type="text" class="form-control" id="formGroupExampleInput3" placeholder="{{ $family }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="formGroupExampleInput2">Date de pointage</label>
                                                        <input type="text" class="form-control" id="formGroupExampleInput4" placeholder="{{ $date_checkin }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="formGroupExampleInput5">Status </label>
                                                        <select class="form-control form-control-md" name="status" required>
                                                            <option selected>Present</option>
                                                            <option>Absent</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                    <button type="submit" class="btn btn-primary">Enregistrer modification</button>
                                                </div>
                                            </form>
                                            <!--form update status end-->
                                        </div>
                                    </div>
                                </div>

                                <!--Modal to edit statut of worker pointing end-->

                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--Modal start here-->
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Table de pointage</h5>
                </div>
                <!--chekin form-->
                <form action="{{ route('setcheckin') }}" method="POST">
                    <div class="modal-body">
                        <!--table chekin-->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Mat</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prenom</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($checkin as $check)
                                    <tr>
                                        <th scope="row">{{ $id_worker = $check->id_worker }} <input type="hidden" name="id_worker[]" value="{{ $id_worker }}"></th>
                                        <td>{{ $name = $check->name }}</td>
                                        <td>{{ $family_name = $check->family_name }}</td>
                                        <td>{{ date('d-m-Y') }}</td>
                                        <td>
                                            <select class="form-control form-control-md" name="status[]" required>
                                                <option selected>Present</option>
                                                <option>Absent</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                                @csrf
                                </tbody>
                            </table>
                        </div>
                        <!--end table chekin-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save checkin</button>
                    </div>
                </form>
                <!--end checkin form-->
            </div>
        </div>
    </div>
    <!--Modal end here-->

@endsection
