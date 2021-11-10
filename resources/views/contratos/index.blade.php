@extends('layouts.panel')
@section('estilos')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
          
            <h2>Contratos</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            @if (session('mensaje'))
            <div class="alert alert-success" role="alert">
              {{session('mensaje')}}
            </div>
            @endif
            <div>
                <a href="{{ route('contratos.create') }}" class="btn btn-raised btn-success">Agregar Contrato</a>
            </div>
        </div>

        <div class="row clearfix">            
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                <div class="thumbnail card">
                    <img src="assets/images/course-3.jpg" alt=""  class="img-fluid">
                    <div class="caption  body">
                        <h3>Magento Programmer Course</h3>
                        <p>First Year, MBA</p>
                        <p>Price: <strong class="col-blush">$315.60</strong> Time: <strong class="col-green">9 months</strong></p>
                        <p>Prof.: Prof. <strong>Will Smith</strong></p>
                        <p>Students: <strong class="col-green">115</strong></p>
                        <a href="courses-info.html" class="btn  btn-raised btn-info waves-effect" role="button">Read more</a>
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
