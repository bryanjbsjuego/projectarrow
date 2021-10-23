@extends('layouts.panel')
@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h3 style="font-size: 15px;">¡ Bienvenido <strong> {{ Auth::user()->name }} </strong> al sistema ARROW !</h3>
            
        </div>
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="body">
                        @php 
                            use App\Models\User;
                            $cant_usuarios=User::count();
                        @endphp
                        
                        <h3>Usuarios:  <strong>{{$cant_usuarios }}</strong></h3>
                        
                        
                        <span class="text-small">4% higher than last month</span> </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="body">
                        @php 
                            use App\Models\Empresa;
                            $cant_empresas=Empresa::count();
                        @endphp
                        <h3>Empresas:  <strong>{{$cant_empresas }}</strong></h3>
                        
                        
                        <span class="text-small">4% higher than last month</span> </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="body">
                        @php 
                        use Spatie\Permission\Models\Role;
                        $cant_roles=Role::count();
                        @endphp
                        <h3>Empresas:  <strong>{{$cant_roles }}</strong></h3>
                        <span class="text-small">15% higher than last month</span> </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="body">
                        <h3>Afianzadoras</h3>
                        <p class="text-muted">Total Feedbacks</p>
                        <div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope" value="68" type="info">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;"></div>
                        </div>
                        <span class="text-small">10% higher than last month</span> </div>
                </div>
            </div>
        </div>
        
    </div>
    

@endsection

@section('scripts')
  
@endsection
