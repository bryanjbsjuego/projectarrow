@extends('layouts.panel')
@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Afianzadoras</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            <div>
                @can('crear-afianzadora')
                    <a href="{{ route('afianzadoras.create') }}" class="btn btn-raised btn-success">Agregar afianzadora</a>
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
                                    <th>Fianza</th>
                                    <th>Fecha</th>
                                    <th>Número de fianza</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($afianzadoras as $afianzadora)
                                    <tr>
                                        <td>{{ $afianzadora->nombre}}</td>
                                        <td>{{ $afianzadora->fianza}}</td>
                                        <td>{{ $afianzadora->fecha}}</td>
                                        <td>{{ $afianzadora->num_fianza}}</td>


                                        <td>
                                            @can('editar-afianzadora')
                                                <a class="btn btn-raised btn-warning btn-sm" href="{{ route('afianzadoras.edit', $afianzadora->id) }}"><i class="fas fa-edit"></i></a>
                                            @endcan
                                            @can('borrar-afianzadora')
                                                {!! Form::open(['method' => 'DELETE','route' => ['afianzadoras.destroy', $afianzadora->id], 'style'=>'display:inline']) !!}
                                                {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-raised  btn-sm'] )  }}
                                                {!! Form::close() !!}
                                            @endcan


                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination justify-content-end">
                            {!! $afianzadoras->links() !!}
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
