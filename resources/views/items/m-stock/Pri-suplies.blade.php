@extends('layouts.app')

@section('title', 'Matiére primaire')

@section('content')
    <!--Display content section-->
    <section class="py-5">

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
            <div class="alert alert-success"> Matiére primaire enregistrer avec success</div>
        @endif

        @if($message = Session::get('failed'))
            <div class="alert alert-success"> Matiére primaire non enregistrer !</div>
        @endif

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header  d-flex justify-content-between align-items-center">
                        <h6 class="text-uppercase mb-0">Table de saisie des matiéres primaires </h6>
                        <!--section to add items-->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg>
                        </button>
                        <!--end section to add items-->
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover card-text">
                            <thead>
                            <tr>
                                <th>Code</th>
                                <th>Matiére primaire</th>
                                <th>Quantité </th>
                                <th>Unité</th>
                                <th>Géré</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($data->isEmpty())

                                <td colspan="4"><div class="alert alert-info justify-content-between"><div class="text-center"> Pas de produit !</div></div></td>

                                @else
                                @foreach($data as $data)
                                    <tr>
                                        <td>{{ $code = $data->code }}</td>
                                        <td>{{ $name = $data->productname }}</td>
                                        <td>{{ $qt = $data->quantity }}</td>
                                        <td>{{ $u = $data->unit }}</td>
                                        <td>
                                            <div class="container-fluid d-flex">
                                                <div class="row d-inline-block">
                                                    <button type="button" class="btn btn-outline-success"> Details</button>
                                                    <button type="button" class="btn btn-outline-warning"> Modifier</button>
                                                    <button type="button" class="btn btn-outline-danger"> Supprimer</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--Modal start here-->
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter Matiéres primaires</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pri-supliesadd') }}" method="post">
                    <div class="modal-body">
                        <div class="container">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Code </label>
                                            <input name="code[]" type="text" class="form-control"
                                                   placeholder="Code matiére " id="codeM" minlength="4" maxlength="4" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <input type="hidden" class="form-control" id="coderoute" value="{{ route('codev') }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Matiére </label>
                                            <input name="productname[]" type="text" class="form-control"
                                                   placeholder="Non de la matiére" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Qantité </label>
                                            <input name="quantity[]" type="text" class="form-control"
                                                   placeholder="Non de la matiére" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Unité </label>
                                            <select name="unit[]" class="form-control"  required>
                                                <option>Litre</option>
                                                <option>KG</option>
                                                <option>Pack</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="pri-suplies"></div>
                            @csrf
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="Addblocs()"> +</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Modal end here-->
    <script>

        function Addblocs() {
            document.getElementById("pri-suplies").innerHTML += "\n" +
                "                                <div class=\"row\">\n" +
                "                                    <div class=\"col-md-3\">\n" +
                "                                        <div class=\"form-group\">\n" +
                "                                            <label for=\"formGroupExampleInput\">Code </label>\n" +
                "                                            <input name=\"code[]\" type=\"text\" class=\"form-control\"\n" +
                "                                                   placeholder=\"Code matiére \" id=\"codeM\" minlength=\"4\" maxlength=\"4\" required>\n" +
                "                                            <div class=\"valid-feedback\">\n" +
                "                                                Looks good!\n" +
                "                                            </div>\n" +
                "                                            <input type=\"hidden\" class=\"form-control\" id=\"coderoute\" value=\"{{ route('codev') }}\" />\n" +
                "                                        </div>\n" +
                "                                    </div>\n" +
                "\n" +
                "                                    <div class=\"col-md-3\">\n" +
                "                                        <div class=\"form-group\">\n" +
                "                                            <label for=\"formGroupExampleInput\">Matiére </label>\n" +
                "                                            <input name=\"productname[]\" type=\"text\" class=\"form-control\"\n" +
                "                                                   placeholder=\"Non de la matiére\" required>\n" +
                "                                        </div>\n" +
                "                                    </div>\n" +
                "                                    <div class=\"col-md-3\">\n" +
                "                                        <div class=\"form-group\">\n" +
                "                                            <label for=\"formGroupExampleInput\">Qantité </label>\n" +
                "                                            <input name=\"quantity[]\" type=\"text\" class=\"form-control\"\n" +
                "                                                   placeholder=\"Non de la matiére\" required>\n" +
                "                                        </div>\n" +
                "                                    </div>\n" +
                "                                    <div class=\"col-md-3\">\n" +
                "                                        <div class=\"form-group\">\n" +
                "                                            <label for=\"exampleFormControlSelect1\">Unité </label>\n" +
                "                                            <select name=\"unit[]\" class=\"form-control\"  required>\n" +
                "                                                <option>Litre</option>\n" +
                "                                                <option>KG</option>\n" +
                "                                                <option>Pack</option>\n" +
                "                                            </select>\n" +
                "                                        </div>\n" +
                "                                    </div>\n" +
                "                                </div>";
        }
    </script>
@endsection
