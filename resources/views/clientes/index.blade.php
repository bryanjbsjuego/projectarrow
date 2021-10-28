@extends('layouts.panel')
@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Clientes</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            <div>
                <a href="{{ route('clientes.create') }}" class="btn btn-raised btn-success">Agregar cliente</a>
            </div>
        </div>

        <div class="row clearfix">
            @foreach ($clientes as $cliente)
            <div class="col-lg-4 col-md-6 col-sm-12">
               
                <div class="card all-patients">
                    <div class="body">
                        <div class="row d-flex justify-content-center" >
                         

                            <div class="col-lg-8 col-md-12 m-b-0">
                            <div class="bg-info d-flex justify-content-between">
                                <h5 class=""> Nombre: {{$cliente->nombre}} 
                                <a href="{{route('clientes.edit', $cliente->id )}}" class="edit mr-6 d-flex">
                                   
                                    {!! Form::open(['method' => 'DELETE','route' => ['clientes.destroy', $cliente->id], 'style'=>'display:inline']) !!}
                                    {{ Form::button('<i class="material-icons mb-1">delete_forever</i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-raised  btn-sm text-center'] ) }}
                                    {!! Form::close() !!}


                                <i class="zmdi zmdi-edit"></i></a></h5>
                            </div>
                                <address class="m-t-10 m-b-0">
                                    Correo:   {{$cliente->email}} <br>
                                    <abbr title="Phone">Teléfono:</abbr>  {{$cliente->telefono}}
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
