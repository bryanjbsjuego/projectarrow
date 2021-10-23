@extends('layouts.panel')
@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Empresas</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            <div>
                @can('crear-empresa')
                    <a href="{{ route('empresas.create') }}" class="btn btn-raised btn-success">Agregar empresa</a>
                @endcan
            </div>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    
                                    <th>Nombre</th>
                                    <th>Ubicación</th>
                                    <th>RFC</th>
                                    <th>IMMS</th>
                                    <th>CCEM</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($empresas as $empresa)
                                    <tr>
                                        <td>{{ $empresa->nombre}}</td>
                                        <td>{{ $empresa->ubicacion}}</td>
                                        <td>{{ $empresa->rfc}}</td>
                                        <td>{{ $empresa->imms}}</td>
                                        <td>{{ $empresa->ccem}}</td>
                                        
                                        <td>
                                            @can('editar-empresa')
                                                <a class="btn btn-raised btn-warning btn-sm" href="{{ route('empresas.edit', $empresa->id) }}"><i class="fas fa-edit"></i></a>
                                            @endcan
                                            @can('borrar-empresa')
                                                {!! Form::open(['method' => 'DELETE','route' => ['empresas.destroy', $empresa->id], 'style'=>'display:inline']) !!}
                                                {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-raised  btn-sm'] )  }}
                                                {!! Form::close() !!}
                                            @endcan
                                            
                                            
                                        </td>
                                    
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination justify-content-end">
                            {!! $empresas->links() !!}
                        </div>
                    </div>
                        
                    
                    
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
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
