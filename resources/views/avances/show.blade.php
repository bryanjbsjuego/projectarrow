@extends('layouts.panel')
@section('estilos')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection
@section('contenido')


<div class="container-fluid">
    <div class="block-header">

        <h2>Avance</h2>
        <small class="text-muted">Bienvenido a la aplicación ARROW</small>
        @if (session('mensaje'))
        <div class="alert alert-success" role="alert">
          {{session('mensaje')}}
        </div>
        @endif
        <div>

        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-7 col-md-12 col-sm-12">
            <div class="card">
             
                                             
                {{--Cabecera  --}}
                <div class="header clearfix d-flex justify-content-center">
                    <a href="{{route('conceptosec.show',$p)}}" class="btn btn-raised btn-light  " ><i class="material-icons">arrow_back</i></a>
                   
                    <h2 class="m-auto">Información</h2>
                  
                   <a class="btn btn-sm btn-raised btn-primary" href="{{ route('concepto.createPDF',$avancef->id) }}">Imprimir Reporte Concepto<i class="material-icons" style=" margin-bottom: 8px;">file_download</i> </a>
                    

                </div>
                
                <div class="body">
                    <div class="clearfix ">
                        <div class="row ">
                           
                        
                            <div class="col-4 ">
                                <img class="img-fluid" src="{{asset('img/usuarios/'. $imgco[0]->imagen)}}" alt="cargando"  width="200px" height="250px" >
                               
                            </div>

                            <div class="col-4  d-flex align-items-center justify-content-center">
                                <p style="font-size: 14px; text-transform: uppercase"><strong>{{$avance->nombre_cliente}}</strong></p>
                            </div>

                            <div class="col-4 ">
                                <img class="img-fluid" src="{{asset('img/usuarios/'. $imgco[1]->imagen)}}" alt="cargando"  width="200px" height="250px" >
                               
                             
                            </div>
                          

                        </div>
                         

                    </div>





                    <hr>
                    <div class="row ">
                        <div class="col-3  m-auto text-center">
                            <strong>Concepto:</strong>
                            <hr><br>
                            <strong>{{$avance->codigo}}</strong>
                        </div>

                        <div class="col-9  ">
                           <p>{{$avance->nom_concepto}}</p>
                        </div>
                  
                    </div> <br><hr>

                    <div class="col text-center">

                         @if($dato==0) 
                        <a href="{{route('registrar.datos',$avancef->id)}}" class="btn btn-raised btn-info m-auto">Datos</a><br><br>   
                         @endif 


                        <a href="{{route('ver.avance',$avancef->id)}}" class="btn btn-raised btn-warning m-auto">Ver el registro avance</a>                          
                        <a href="" class="btn btn-raised btn-success m-auto"> Imagenes de avance</a>                          
                     
                    </div>

                    
                  
          
                     



                    {{-- <div class="mt-40"></div><br>
                     <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr><th>Localizacion</th>
                                        <th>Longitud</th>
                                        <th>Ancho </th>
                                        <th>Ancho </th>
                                        <th>Ancho Promedio</th>
                                        <th>Area</th>
                                        <th>Altura</th>
                                        <th>Volumen total</th>
                                        <th>PZA</th>
                                        <th>Total</th>
                                    </tr></thead>
                                    <tbody>
                                        <tr>
                                            <td>   <td>d</td>
                                            <td>s</td></td>
                                            <td>2</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>3</td>
                                            <td>4</td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>  --}}


                    {{-- <div class="row">
                        <div class="col-sm-12 text-center">

                            <hr>
                            <a href="javascript:window.print()" class="btn btn-raised btn-success"><i class="zmdi zmdi-print"></i></a>
                            <a href="{{route('contratos.edit',$contratoUnion->contrato_id)}}" class="btn btn-raised btn-warning">Editar</a>
                            <a href="#" class="btn btn-raised btn-danger">Eliminar</a>
                           
                            <a href="" class="btn btn-raised btn-success">Regresar</a>
                        </div>
                    </div> --}}


                    <br>
                    <div class="row">


                    </div>
                    <br><br>
                    <div class="container">
                        <div class="row">
                        {{-- @foreach($imagenes as $imagen )
                        
                            <div class="col-4">
                                <h3 class=""><img src="{{asset('img/usuarios/'.$imagen->imagen)}}" width="140px" height="100px" alt="velonic"></h3>
                                <p><strong>Descripción: <strong> {{ $imagen->descripcion }}</p>
                                    <a href="{{route('contratos.editarimagen',$imagen->id)}}" class="text-center btn btn-raised btn-sm btn-warning " >Editar</a>

                                <form action="{{route('contratos.eliminarimagen',$imagen->id)}}" class=""  method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="cursor: pointer; background: transparent; border:0px;" class="btn btn-sm btn-raised btn-danger">Eliminar</button>
                                </form>
                            </div>
                       

                        @endforeach --}}
                    </div>


                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-12 card ">
           <div class="row mt-2 p-1">
               <div class="col-12 text-center ">
                   <hr>
                   <p class="m-auto"><strong>Contratista: </strong>{{$avance->nom_empresa}} 
                    <span style="color:red"> Fecha: </span><?php echo $fechaActual = date('d-m-Y ');?></p>
                    <hr> 

                    <p class="m-auto text-center"><strong>Ubicación: </strong>{{$avance->ubicacion}} <p>
                        
                    <p class="m-auto"><strong>Contrato: </strong>{{$avance->nom_contrato}} <strong>Importe: </strong> ${{$avance->conimporte}}<p>
                    <hr>
               </div>

               <div class="col-12 ">
                   <div class="row  text-center">
                    <div class="col-6  text-center">
                        <p>Unidad:<br>
                      <strong>{{$unidad->unidad_nombre}}</strong>  </p>
                        
                    </div>
                    <div class="col-6 ">
                        <p>Periodo de ejecución</p>
                        <p>Inicio:</p>
                        <p>{{$avancef->inicio}}</p>
                     

                        <p>Fin:</p>
                        <p>{{$avancef->fin}}</p>
                      
                    </div>
                    <a href="{{route('crearf',$avance->idc)}}" class="btn btn-raised btn-success m-auto">Ejecucion</a>
                   </div>
             
                               
               </div>

               <div class="col-12  mt-3"><hr>
                   <p class="text-center"><strong>CROQUIS DE LOCALIZACIÓN</strong></p><br>
                <img class="img-fluid" src="{{asset('img/usuarios/'. $imgc->imagen)}}" alt="cargando"  width="auto" height="auto" >
                               
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
@endsection
