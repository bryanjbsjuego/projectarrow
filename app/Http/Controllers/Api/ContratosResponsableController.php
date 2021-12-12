<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Contrato;

class ContratosResponsableController extends Controller
{
    public function index()
    {
    


    // $id=Auth::id();

    // // return $id;

    
    // $rol=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
    // ->join('roles','roles.id','=','model_has_roles.role_id')
    // ->select('roles.name')
    // ->where('users.id','=',$id)->first();

    

   
        
    // if($rol->name=='Responsable de obra'){
    //     // $contratos=Contrato::where('id_responsable','=',$id)->get();

    //     // $contratos

    //     $contratos=DB::table('contratos')
    //     // ->join('fianzas','contratos.id','=','fianzas.id_contrato')
    //     ->select('contratos.*')
    //     ->where('contratos.id_responsable','=',$id)
    //     ->where('estatus','=',0)
    //     ->get();

    //     // return $contratos;
        
    //     return response()->json(['success' => true, 'contratos' => $contratos], 200);





    // }else if($rol->name=='Asistente de obra'){
        
    //     $contratos=Contrato::where('id_asistente','=',$id)->get();
       
    //     return response()->json(['success' => true, 'contratos' => $contratos], 200);

    //     // return $contratos;

    // }

     return Contrato::all([
            'id',
            'contrato',
            'nombre_obra',
            'descripcion',
            'fecha_alta',
            'ubicacion',
            'fecha_inicio',
            'fecha_termino',
            'plazo_dias',
            'importe',
            'amortizacion',
            'estatus',
            'id_cliente',
            'id_empresa',
            'id_responsable',
            'id_asistente'
     ]);

    
        
    }
    
}