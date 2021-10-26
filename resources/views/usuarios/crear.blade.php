@extends('layouts.panel')

@section('estilos')
<link href="{{asset('plugins/dropzone/dropzone.css')}}" rel="stylesheet">
<style>
    #dropzoneDragArea{
        background-color: #f2f2f2;
        border: 1px dashed #c0ccda;
        border-radius:6px;
        padding: 60px;
        text-align: center;
        margin-bottom: 15px;
        cursor:pointer;
    }
    .dropzone{
        box-shadow: 0px 2px 20px 0px #f2f2f2;
        border-radius: 10px;
    }

    #demoform{
        background-color: white !important;
    }
</style>
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
                            {!! Form::open(array('route' => 'usuarios.store','method' => 'POST', 'class' =>'dropzone', 'id' =>'demoform' , 'name' => 'demoform')) !!}
                                @csrf
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"  id="name" name="name" placeholder="Nombre" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Correo" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="password" name="password" class="datepicker form-control" placeholder="Contraseña" required>
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
                                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                    <div class="form-group">
                                        <div id="dropzoneDragArea" class="dz-default dz-message dropzoneDragArea">
                                            <span>Seleccione la imagen que desea subir</span>
                                        </div>
                                        
                                    </div>
                                    <div class="dropzon-previews"></div>
                                </div>

                                <div class="col-sm-6 ">
                                    {!! Form::select('roles[]', $roles,[],array('class' => 'form-control show-tick') ) !!}
                                </div>
                                
                                <br/>
                                <br/>
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
        Dropzone.autoDiscover=false;
        let token=$('meta[name="csrf-token"]').attr('content');
        var myDropzone= new Dropzone("div#dropzoneDragArea",{
            paramName:"file",
            url:"{{url('/store')}}",
            previewContainer:"div.dropzone-previews",
            addRemoveLinks:true,
            autoProcessQueue:false,
            uploadMultiple:false,
            paralleUploads:1,
            maxFiles:1,
            params:{
                _token: token
            },
            init: function(){
                var myDropzone = this;

                $("form[name='demoform']").submit(function (event) {
                    event.preventDefault();

                    URL=$("#demoform").attr('action');
                    formData=$("#demoform").serialize();
                    $.ajax({
                        type:'POST',
                        url:URL,
                        data:'formData',
                        success:function(result){
                            if(result=="success"){
                                myDropzone.processQueue();

                            }else{
                                console.log("error");
                            }

                        }
                    })
                    
                });

                this.on('sending', function(file,xhr, formData){

                });

                this.on("success", function(file, response){

                });
                this.on("queuecomplete", function(){

                });
            }
        });
    </script>
@endsection