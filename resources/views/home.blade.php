@extends('layouts.panel')
@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h3 style="font-size: 15px;">¡ Bienvenido <strong> {{ Auth::user()->name }} </strong> al sistema ARROW !</h3>
          @php
               use App\Models\User;
               use Illuminate\Support\Facades\DB;
               use Illuminate\Support\Facades\Auth;
                    $id=Auth::id();
                    $validacion=User::select('confirmed')->where('id','=',$id)->first();

                $cant_usuarios=User::count();

                use App\Models\Empresa;
                    $cant_empresas=Empresa::count();

                use Spatie\Permission\Models\Role;
                        $cant_roles=Role::count();
          @endphp  
        </div>
        @if($validacion->confirmed==1)
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="body">
                        
                        <h3>Usuarios:  <strong>{{$cant_usuarios }}</strong></h3>
                        
                        
                        <span class="text-small">4% higher than last month</span> </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="body">
                        
                        <h3>Empresas:  <strong>{{$cant_empresas }}</strong></h3>
                        
                        
                        <span class="text-small">4% higher than last month</span> </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="body">
                        
                        <h3>Roles:  <strong>{{$cant_roles }}</strong></h3>
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
        @elseif($validacion->confirmed==0)
        <div class="row clearfix">
            <div class="col-sm-12" >
                <div class="card" style="height: 250px;">
                    <div class="body text-center">
                       <h3 style="color:#dd5e89;">¡Por favor, debe de verificar su correo electrónico, para poder tener acceso al sistema!</h3>
                                
                                    <blockquote class="blockquote">
                                        <p>Debe revisar su bandeja de correo, y dar clic en el enlace para poder activar su cuenta.</p>
                                        <span style="font-size: 17px;"><strong>"Puede ser que el correo se encuentre en la bandeja de spam o correo no deseado."</strong></span>
                                    </blockquote>
                                     
                </div>
            </div>
        
        </div>
        @endif
        
    </div>
    

@endsection

@section('scripts')
  
@endsection
