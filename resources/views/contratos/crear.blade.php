@extends('layouts.panel')
@section('estilos')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection
@section('contenido')
<div class="container-fluid">
        <div class="block-header">
            <h2>Agregar usuario</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
        </div>

        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">
                        @if (session('mensaje'))
                        <div class="alert alert-danger" role="alert">
                          {{session('mensaje')}}
                        </div>
                        @endif
					</div>
					<div class="body">                        
                        <div class="row clearfix">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>!Revise los campos¡</strong>
                                        @foreach ($errors->all() as $error)
                                            <span >{{ $error }}</span>
                                        @endforeach
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                            @endif
                            <div class="col-md-12">                                                                          
                            <form action="{{route('contratos.store')}}" method="POST">
    @csrf
        <div class="form-group">
            <div class="form-line">
                <input type="text" name="contrato" class="form-control" placeholder="Contrato">
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="form-group">
            <div class="form-line">
                <input type="text" name="nom_obra" class="form-control" placeholder="Nombre de la obra">
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
        <div class="form-line">
            <textarea  style="height: 100px" class="form-control"  id="descripcion" name="descripcion" placeholder="Descripcion" ></textarea>
        </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="form-group">
            <div class="form-line">
            <label for="start">Fecha alta</label>
                <input type="Date" value="<?php echo date("Y-n-j"); ?>" max="<?=date('Y-m-d',strtotime('now +1 week'));?>" min="<?=date('Y-m-d',strtotime('now -0 days'));?>" name="fecha_inicio" class="form-control" id="fecha_inicio" placeholder="Fecha de inicio">
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
             <div class="form-line">
                <textarea  style="height: 100px" class="form-control"  id="ubicacion" name="ubicacion" placeholder="Ubicación" ></textarea>
             </div>
         </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <div class="form-line">
            <label for="start">Fecha inicio</label>
            <input type="Date" value="<?php echo date("Y-n-j"); ?>" max="<?=date('Y-m-d',strtotime('now +30 days'));?>" min="<?=date('Y-m-d',strtotime('now -0 days'));?>" name="fecha_alta" class="form-control" name="fecha_inicio" placeholder="Fecha de alta">
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <div class="form-line">
            <label for="start">Fecha termino</label>
            <input type="Date" value="<?php echo date("Y-n-j"); ?>" max="<?=date('Y-m-d',strtotime('now +30 days'));?>" min="<?=date('Y-m-d',strtotime('now -0 days'));?>" name="fecha_termino" class="form-control" placeholder="Fecha de termino">
            </div>
        </div>
    </div>
    <!--<div class="col-md-6 col-sm-12">
        <div class="form-group drop-custum">
            <select class="form-control show-tick">
                <option value="">--Seleccionar encargado de obra--</option>
                <option value="1">Bryan</option>
                <option value="2">Isaac</option>
                <option value="3">Oscar</option>
            </select>
        </div>    
    </div> -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <div class="form-line">
                <input type="number" name="plazo_dias" class="form-control" placeholder="Plazo de dias">
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <div class="form-line">
                <input type="number" name="importe" class="form-control" placeholder="$ Importe">
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="form-group">
            <div class="form-line">
                <input type="number" name="amortizacion" class="form-control" placeholder="Amortización">
            </div>
        </div>
    </div>
    <div class="col-sm-6 focused mt-3">
                                <select class="form-control show-tick">
                                    <option value="{{$empresa->id}}" selected>-- {{$empresa->nombre}} --</option>
                                </select>
                            </div>
                            <div class="col-sm-6 focused mt-3 mb-3">
                                <select class="form-control show-tick">
                                    <option value="">-- Cliente --</option>
                                    @foreach ($clientes as $cliente)
                        <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="col-sm-6 focused mt-3">
                                <select class="form-control show-tick">
                                    <option value="0">-- Responsable de Obra --</option>
                                    @foreach ($responsables as $responsable)
                        <option value="{{$responsable->id}}">{{$responsable->name}}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="col-sm-6 focused mt-3 mb-3">
                                <select class="form-control show-tick">
                                    <option value="0">-- Asistente de Obra --</option>
                                    @foreach ($asistentes as $asistente)
                        <option value="{{$asistente->id}}">{{$asistente->name}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        <br>
                        <br>
                    
    <div class="col-sm-12 mt-4 d-flex justify-content-center">
        <button type="submit" class="btn btn-raised g-bg-blush2">Agregar</button>
        <button type="submit" class="btn btn-raised btn-default">Cancelar</button>
    </div>   
</div>
</form>
                        </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>        
        
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('bundles/datatablescripts.bundle.js')}}"></script>
    <script src="{{ asset('plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>

    <script src="{{ asset('bundles/mainscripts.bundle.js')}}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('js/pages/tables/jquery-datatable.js')}}"></script>

    <script>

$(function(){
    $('#fecha_inicio').change(()=>{
        $inicio=$("#fecha_inicio").val();
        console.log($inicio);    
        
    });
});
alert ("hola");
    </script>
@endsection
