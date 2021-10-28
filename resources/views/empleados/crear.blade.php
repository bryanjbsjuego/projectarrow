@extends('layouts.panel')
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Agregar cliente</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
        </div>
        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">

					</div>
					<div class="body">
                        <div class="row clearfix">
                            @if ($errors->any())
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>!Revise los campos¡</strong>
                                            @foreach ($errors->all() as $error)
                                                <span >{{ $error }}</span>
                                            @endforeach
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-12">
                            <form action="{{ route('afianzadoras.store') }}" method="POST">
                                @csrf
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"  id="nombre" name="nombre" placeholder="Nombre" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"  id="apellido_paterno" name="apellido_paterno" placeholder="Apellido paterno" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"  id="apellido_materno" name="apellido_materno" placeholder="Apellido Materno" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <select class="form-control show-tick">
                                        <option value="">-- Seleccione tipo de empleado --</option>
                                        <option value="em">Empresa</option>
                                        <option value="cl">Cliente</option>
                                     
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <select class="form-control show-tick">
                                        <option value="">-- Empresas --</option>
                                        <option value="em">Empresa</option>
                                        <option value="cl">Cliente</option>
                                     
                                    </select>
                                </div>

                                {{-- <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea  style="height: 100px" class="form-control"  id="domicilio" name="domicilio" placeholder="Domicilio" ></textarea>
                                        </div>
                                    </div>
                                </div> --}}


                                {{-- <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"  id="telefono" name="telefono" placeholder="Télefono" >
                                        </div>
                                    </div>
                                </div> --}}

                                  {{-- <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"  id="telefono" name="telefono" placeholder="Télefono" >
                                        </div>
                                    </div>
                                </div> --}}


                                <br/>
                                <br/>
                                <div class="col-sm-12">
                                    <center>
                                    <button type="submit" class="btn btn-raised waves-effect g-bg-blush2">Guardar</button>
                                    <a href="{{ route('afianzadoras.index')}}" class="btn btn-raised btn-default waves-effect">Cancelar</a>
                                    </center>
                                </div>

                            {!! Form::close() !!}
                        </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>

    </div>


@endsection

