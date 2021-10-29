@extends('layouts.panel')
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
                                {!! Form::model($usuario, ['method' => 'PUT', 'route'=> ['usuarios.update',$usuario->id]]) !!}
                                @csrf
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {!! Form::text('name', null, array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {!! Form::text('email', null, array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="password" name="password" class="datepicker form-control" placeholder="Contraseña" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="confirm-password" name="confirm-password" class="datepicker form-control" placeholder="Confirmar password" required>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-6 ">
                                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control show-tick')) !!}
                                </div> --}}
                                
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group drop-custum">
                                      
                                    <select class="form-control" id="rol" name="roles" required>
                                      @foreach ($roles as $rol) 
                                      <option value="{{$rol->name}}"@if ( $rol->name === $rolSelect->name ) selected @endif>{{$rol->name}}</option> 
                                      @endforeach    
                                    </select>
                                    </div>
                                </div>
                           
                        
                                  <div class="col-md-6 col-sm-12 " id="empresa" style="display:none">
                                    <div class="form-group drop-custum">
                                    <select class="form-control show-tick "  name="empresa" id="em">
                                        <option value="" selected>--Seleccione una empresa--</option>
                                     @foreach ($empresas as $empresa)
                                     <option value="{{$empresa->id}}" @if ( $empresa->nombre === $empresaE->nombre ) selected @endif>{{$empresa->nombre}}</option>
                                     @endforeach   
                                    </select>
                                    </div>
                                </div>

                           
                                {{-- <div class="col-sm-12 col-md-6">
                                    <div class="alert bg-pink alert-dismissible" id="alerta" style="display: none" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       No existen empresas registradas
                                    </div>
                                </div> --}} 

                                <div class="col-sm-12">
                                    <center>
                                    <button type="submit" class="btn btn-raised waves-effect g-bg-blush2">Guardar</button>
                                    <a href="{{ route('usuarios.index')}}" class="btn btn-raised btn-default waves-effect">Cancelar</a>
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

@section('scripts')
    <script src="{{asset('plugins/dropzone/dropzone.js')}}"></script>

    <script>
    let $rol,$empresas,boton;

    $(function(){
        $rol=$('#rol').val();
        console.log($rol);

        if($rol=='Responsable de empresa'){
            console.log("soy responsable");
            document.getElementById('empresa').style.display = 'block';
        }
        
    });


    </script>
    
@endsection 

