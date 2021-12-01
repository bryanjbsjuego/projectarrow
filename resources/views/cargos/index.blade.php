@extends('layouts.panel')
@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Cargos</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            <div>
                <a href="{{ route('cargos.create') }}" class="btn btn-raised btn-success">Agregar Cargo</a>
            </div>
        </div>

        <div class="row clearfix">
            @foreach ($cargos as $cargo)
            <div class="col-lg-4 col-md-6 col-sm-12">
               
                <div class="card all-patients">
                    <div class="body">
                        <div class="row d-flex justify-content-center" >
                         

                            <div class="col-lg-8 col-md-12 m-b-0">
                            <div class=" d-flex justify-content-between">
                                <h5 class=""> Nombre: {{$cargo->nombre_cargo}}  </h5>
                                <a href="{{route('cargos.edit', $cargo->id )}}" class="edit"><i class="zmdi zmdi-edit text-warning"></i></a>
                                  
                                   
                                    {!! Form::open(['method' => 'DELETE','route' => ['cargos.destroy', $cargo->id], 'style'=>'display:inline']) !!}
                                    {{-- {{ Form::button('<i class="material-icons mb-1">delete_forever</i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-raised  btn-sm text-center'] ) }} --}}
                                    <button type="submit" style="cursor: pointer; background: transparent; border:0px;"><i class="material-icons text-danger">delete</i></button>
                                    {!! Form::close() !!}

                                   
                            </div>
                                <address class="m-t-10 m-b-0">
                                    Descripción:   {{$cargo->descripcion}} <br>
                                    
                                </address>
                            </div>
                                
                          
                          
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        
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
