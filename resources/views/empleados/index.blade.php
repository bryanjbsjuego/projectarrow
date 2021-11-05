@extends('layouts.panel')
@section('estilos')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            @if (session('mensaje'))
            <div class="alert alert-success" role="alert">
              {{session('mensaje')}}
            </div>
            @endif
            <h2>Empleados</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            <div>
                <a href="{{ route('empleados.create') }}" class="btn btn-raised btn-success">Agregar Empleado</a>
            </div>
        </div>

        {{-- <div class="row clearfix">
            @foreach ($empleados as $empleado)
            <div class="col-lg-4 col-md-6 col-sm-12">
               
                <div class="card all-patients">
                    <div class="body">
                        <div class="row d-flex justify-content-center" >
                         

                            <div class="col-lg-8 col-md-12 m-b-0">
                            <div class="bg-info d-flex justify-content-between">
                                <h5 class=""> Nombre: {{$empleado->nombre}} </h5>


                                 
                          
                          
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        
        </div> --}}

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                   
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Tipo Empleado</th>
                                    <th>Acciones</th>
                                  
                                </tr>
                            </thead>                            
                            <tbody>
                                @foreach ($empleados as $empleado)
                                <tr>
                                    <td>{{$empleado->nombre}}</td>
                                    <td>{{$empleado->apellido_materno}}</td>
                                    <td>{{$empleado->apellido_paterno}}</td>
                                  
                                      
                                      
                                        @if ($empleado->tipo_empleado=='cl')
                                        <td>Cliente</td>
                                        @else
                                        <td>Empresa</td>
                                  
                                        @endif
                                  <td class="d-flex justify-content-around">

                                    <a href="{{route('empleados.edit',$empleado->id)}}" class="edit"><i class="zmdi zmdi-edit text-warning"></i></a>
                                   <a href="{{route('empleados.show',$empleado->id)}}" class=""><i class="material-icons text-success">visibility</i></a>
                                  

                                   <form action="{{route('empleados.destroy',$empleado->id)}}"   method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="cursor: pointer; background: transparent; border:0px;"><i class="material-icons text-danger">delete</i></button>
                                  </form>

                           
                                </td>
                                </tr>
                                @endforeach
                             
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                   
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Tipo Empleado</th>
                                    <th>Acciones</th>
                                  
                                </tr>
                            </thead>                            
                            <tbody>
                                @foreach ($clientes as $cliente)
                                <tr>
                                    <td>{{$cliente->nombre}}</td>
                                    <td>{{$empleado->apellido_materno}}</td>
                                    <td>{{$empleado->apellido_paterno}}</td>
                                  
                                      
                                      
                                        @if ($empleado->tipo_empleado=='cl')
                                        <td>Cliente</td>
                                        @else
                                        <td>Empresa</td>
                                  
                                        @endif
                                  <td class="d-flex justify-content-around">

                                    <a href="{{route('empleados.edit',$empleado->id)}}" class="edit"><i class="zmdi zmdi-edit text-warning"></i></a>
                                   <a href="{{route('empleados.show',$empleado->id)}}" class=""><i class="material-icons text-success">visibility</i></a>
                                  

                                   <form action="{{route('empleados.destroy',$empleado->id)}}"   method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="cursor: pointer; background: transparent; border:0px;"><i class="material-icons text-danger">delete</i></button>
                                  </form>

                           
                                </td>
                                </tr>
                                @endforeach
                             
                            </tbody>
                        </table>
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
