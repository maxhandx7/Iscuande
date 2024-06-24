@extends('layouts.admin')
@section('title', 'Gestión de empresa')
@section('styles')
@endsection
@section('options')
@endsection
@section('preference')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Gestión de empresa
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="/home">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gestión de empresa</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Gestión de empresa</h4>
                        </div>
                        @include('alert.message')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong><i class="fas fa-file-signature mr-1"></i> Nombre </strong>

                                <p class="text-muted">
                                    {{ $business->name }}
                                </p>
                                <hr>

                                <strong><i class="fab fa-adn mr-1"></i> Titulo del encabezado </strong>

                                <p class="text-muted">
                                    {!! $business->configurations['thead'] ?? 'sin titulo' !!}
                                </p>
                                <hr>

                                <strong><i class="fas fa-align-left mr-1"></i> Descripción</strong>

                                <p class="text-muted">
                                    {{ $business->description }}
                                </p>
                                <hr>
                                <strong><i class="fas fa-map-marked-alt mr-1"></i> Dirección</strong>

                                <p class="text-muted">
                                    {{ $business->address }}
                                </p>
                                <hr>
                                <strong><i class="fas fa-mobile-alt mr-1"></i> Teléfono</strong>

                                <p class="text-muted">{{ $business->phone }}</p>
                                <hr>

                                <strong><i class="fas fa-align-left mr-1"></i> Misión</strong>

                                <p class="text-muted">
                                    {{ $business->mision  }}
                                </p>
                                <hr>
                            </div>
                            <div class="form-group col-md-6">
                                <strong><i class="far fa-address-card mr-1"></i> NIT</strong>

                                <p class="text-muted">{{ $business->nit }}</p>
                                <hr>
                                <strong><i class="far fa-envelope mr-1"></i> Correo electrónico</strong>

                                <p class="text-muted">{{ $business->mail }}</p>
                                <hr>
                                <strong><i class="far fa-calendar-check mr-1"></i> Fecha de alta</strong>

                                <p class="text-muted">{{ $business->created_at }}</p>
                                <hr>


                                <div class="row">
                                    <div class="col-md-6">
                                        <strong><i class="fas fa-exclamation-circle mr-1"></i> Logo</strong><br>
                                    </div>
                                    <div class="col-md-6">
                                        <img style="width:50px ; height:50px ;"
                                            src="{{ asset('image/' . $business->logo) }}" class="rounded float-left"
                                            alt="logo">
                                    </div>
                                </div>
                                <hr>

                                <strong><i class="fas fa-align-left mr-1"></i> Visión</strong>

                                <p class="text-muted">
                                    {{ $business->vision }}
                                </p>
                                <hr>

                                <strong><i class="fab fa-facebook mr-1"></i></strong>

                                <p class="text-muted">
                                    {{ $business->configurations['facebook'] ?? 'sin datos' }}
                                </p>
                                <hr>

                                <strong><i class="fab fa-twitter mr-1"></i></strong>

                                <p class="text-muted">
                                    {{ $business->configurations['twitter'] ?? 'sin datos' }}
                                </p>
                                <hr>

                                <strong><i class="fab fa-instagram mr-1"></i></strong>

                                <p class="text-muted">
                                    {{ $business->configurations['instagram'] ?? 'sin datos' }}
                                </p>
                                <hr>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-muted">

                        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                            data-target="#exampleModal-2">Actualizar</button>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">Actualizar datos de empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                {!! Form::model($business, ['route' => ['business.update', $business], 'method' => 'PUT', 'files' => true]) !!}


                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" name="name" id="name"
                            value="{{ $business->name }}" aria-describedby="helpId">
                    </div>


                    <div class="form-group">
                        <label for="ruc">NIT</label>
                        <input type="text" class="form-control" name="nit" id="nit"
                            value="{{ $business->nit }}" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{ $business->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="mision">Misión</label>
                        <textarea class="form-control" name="mision" id="mision" rows="3">{{ $business->mision }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="vision">Visión</label>
                        <textarea class="form-control" name="vision" id="vision" rows="3">{{ $business->vision }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="mail">Correo electrónico</label>
                        <input type="email" class="form-control" name="mail" id="mail"
                            value="{{ $business->mail }}" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" class="form-control" name="address" id="address"
                            value="{{ $business->address }}" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefono</label>
                        <input type="text" class="form-control" name="phone" id="phone"
                            value="{{ $business->phone }}" aria-describedby="helpId">
                    </div>
                    <hr>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input name="show_letter" id="show_letter" type="checkbox" class="form-check-input"
                                {{ isset($business->configurations['show_letter']) && $business->configurations['show_letter'] ? 'checked' : '' }}>
                            Mostrar titulo del encabezado
                        </label>
                    </div>
                    <hr>
                    <div class="form-group" id="theadCheck">
                        <label for="Thead">Titulo de encabezado</label>
                        <input type="text" class="form-control" name="thead" id="thead"
                            value="{{ $business->configurations['thead'] ?? '' }}" aria-describedby="thead">
                    </div>

                    <div class="form-group">
                        <label for="facebook">facebook</label>
                        <input type="url" class="form-control" name="facebook" id="facebook"
                            value="{{ $business->configurations['facebook'] ?? '' }}"
                            placeholder="https://facebook.com/pagina" aria-describedby="facebookHelp">
                    </div>

                    <div class="form-group">
                        <label for="twitter">twitter</label>
                        <input type="url" class="form-control" name="twitter" id="twitter"
                            value="{{ $business->configurations['twitter'] ?? '' }}"
                            placeholder="https://twitter.com/pagina" aria-describedby="twitterHelp">
                    </div>

                    <div class="form-group">
                        <label for="instagram">instagram</label>
                        <input type="url" class="form-control" name="instagram" id="instagram"
                            value="{{ $business->configurations['instagram'] ?? '' }}"
                            placeholder="https://instagram.com/pagina" aria-describedby="instagramHelp">
                    </div>


                    <div class="card-body">
                        <h5 class="card-title d-flex">Logo
                            <small class="ml-auto align-self-end">
                                <a href="{{ asset('image/' . $business->logo) }}" class="font-weight-light"
                                    target="_blank">Ver actual</a>
                            </small>
                        </h5>
                        <input type="file" name="picture" id="picture" class="dropify" />
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection
@section('scripts')
    {!! Html::script('melody/js/data-table.js') !!}
    {!! Html::script('melody/js/dropify.js') !!}
    <script>
        $(document).ready(function() {
            $("#show_letter").on("change", function() {
                if ($(this).prop("checked")) {
                    $("#theadCheck").show();
                } else {
                    $("#theadCheck").hide();
                }
            });
        });
    </script>
@endsection
