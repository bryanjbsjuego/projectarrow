<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\ImagenContrato;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class ContratosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id=Auth::id();
        $ide=User::select('empresa')->where('id','=',$id)->first();

        $contratos=Contrato::where('id_empresa','=',$ide->empresa)
        ->where('estatus','=',0)->get();

        return view ('contratos.index',compact('contratos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id=Auth::id();
        $idt=User::select('id_tenant')->where('id', '=', $id)->first();

        $id_empresa=User::select('empresa')->where('id', '=', $id)->first();
        $empresa=DB::table('users')->join('empresas', 'users.empresa', '=', 'empresas.id')
        ->select('empresas.*')
        ->where('empresas.id', '=', $id_empresa->empresa)->first();

        $clientes=Cliente::where('id_empresa', '=', $id_empresa->empresa)->get();

        $idr=Role::select('id')->where('name', '=', 'Responsable de obra')->first();

        $responsables=DB::table('users')
        ->join('empresas', 'users.empresa', '=', 'empresas.id')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->where('users.id_tenant',$idt->id_tenant)
        ->whereIn('role_id', [$idr->id])
        ->where('empresas.id','=',$id_empresa->empresa)
        ->select('users.*')
        ->get();

        $ida=Role::select('id')->where('name', '=', 'Asistente de obra')->first();

        $asistentes=DB::table('users')
        ->join('empresas', 'users.empresa', '=', 'empresas.id')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->where('users.id_tenant',$idt->id_tenant)
        ->whereIn('role_id', [$ida->id])
        ->where('empresas.id','=',$id_empresa->empresa)
        ->select('users.*')
        ->get();

        $date = Carbon::now()->toDateTimeString();


        return view ('contratos.crear', compact('empresa', 'clientes', 'responsables', 'asistentes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $date=$request->all();

        //   return $request->contrato;

        // return $request->all();
        request()->validate([
            'contrato' => 'required',
            'nombre_obra' => 'required',
            'descripcion' => 'required',
            'fecha_alta'  => 'required',
            'ubicacion' => 'required',
            'fecha_inicio' => 'required',
            'fecha_termino' => 'required',
            'plazo_dias' => 'required',
            'importe' => 'required',
            'amortizacion' => 'required',
            // 'id_cliente' => 'required',
            'id_empresa' => 'required',
            'id_responsable' => 'required',
            'id_asistente' => 'required'

        ]);

        $data=$request->only([
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
            'id_cliente',
            'id_empresa',
            'id_responsable',
            'id_asistente'
        ]);

        Contrato::create($data);
        return redirect()->route('contratos.index');
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {



        $contrato=Contrato::where('id','=',$id)->first();

        // return $contrato;

       $contratoUnion=DB::table('contratos')
        ->join('empresas', 'contratos.id_empresa', '=', 'empresas.id')
        ->join('users', 'contratos.id_responsable', '=', 'users.id')
        ->join('clientes', 'contratos.id_cliente', '=', 'clientes.id')
       ->where('contratos.id','=',$id)
       ->select('contratos.*','contratos.id as contrato_id','users.name',
       'users.id','empresas.id as id_empresa','empresas.nombre as nombre_empresa',
       'clientes.id as id_cliente','clientes.nombre as nombre_cliente')
       ->first();



       $asistente=DB::table('contratos')
       ->join('users', 'contratos.id_asistente', '=', 'users.id')
       ->where('contratos.id','=',$id)
       ->select('users.id as asistente_id','users.name as asistente_name')
       ->first();

       return view('contratos.show',compact('contratoUnion','asistente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Contrato $contrato)
    {
        $id=Auth::id();
        $idt=User::select('id_tenant')->where('id', '=', $id)->first();
        $contrato=DB::table('contratos')
        ->join('empresas', 'contratos.id_empresa', '=', 'empresas.id')
        ->join('users', 'contratos.id_responsable', '=', 'users.id')
        ->join('clientes', 'contratos.id_cliente', '=', 'clientes.id')
       ->where('contratos.id','=',$contrato->id)
       ->select('contratos.*','contratos.id as contrato_id','users.name',
       'users.id as id_user'  ,'empresas.id as id_empresa','empresas.nombre as nombre_empresa',
       'clientes.id as id_cliente','clientes.nombre as nombre_cliente')
       ->first();
       $id_empresa=User::select('empresa')->where('id', '=', $id)->first();
       $clientes=Cliente::where('id_empresa', '=', $id_empresa->empresa)->get();

       $asistente=DB::table('contratos')
       ->join('users', 'contratos.id_asistente', '=', 'users.id')
       ->where('contratos.id','=',$contrato->id)
       ->select('users.id as asistente_id','users.name as asistente_name')
       ->first();

       $idr=Role::select('id')->where('name', '=', 'Responsable de obra')->first();

       $responsables=DB::table('users')
       ->join('empresas', 'users.empresa', '=', 'empresas.id')
       ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
       ->join('roles','roles.id','=','model_has_roles.role_id')
       ->where('users.id_tenant',$idt->id_tenant)
       ->whereIn('role_id', [$idr->id])
       ->where('empresas.id','=',$id_empresa->empresa)
       ->select('users.*')
       ->get();

       $ida=Role::select('id')->where('name', '=', 'Asistente de obra')->first();

       $asistentes=DB::table('users')
       ->join('empresas', 'users.empresa', '=', 'empresas.id')
       ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
       ->join('roles','roles.id','=','model_has_roles.role_id')
       ->where('users.id_tenant',$idt->id_tenant)
       ->whereIn('role_id', [$ida->id])
       ->where('empresas.id','=',$id_empresa->empresa)
       ->select('users.*')
       ->get();

       return view('contratos.editar',compact('contrato','asistente','clientes','responsables','asistentes'));

        // return view('contratos.editar');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contrato $contrato)
    {



        $contrato->contrato=$request->contrato;
        $contrato->descripcion=$request->descripcion;
        $contrato->nombre_obra=$request->nombre_obra;
        $contrato->fecha_alta=$request->fecha_alta;
        $contrato->ubicacion=$request->ubicacion;
        $contrato->fecha_inicio=$request->fecha_inicio;
        $contrato->fecha_termino=$request->fecha_termino;
        $contrato->plazo_dias=$request->plazo_dias;
        $contrato->importe=$request->importe;
        $contrato->amortizacion=$request->amortizacion;
        $contrato->id_cliente=$request->id_cliente;
        $contrato->id_empresa=$request->id_empresa;
        $contrato->id_responsable=$request->id_responsable;
        $contrato->id_asistente=$request->id_asistente;

        $contrato->save();
        return redirect()->route('contratos.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function imagen($id)
    {


        return view('contratos.imagencon',compact('id'));
    }

    public function guardar(Request $request){

        $this->validate($request,
        [
            'descripcion' => 'required',
            'photo' => 'required',
            'id_contrato'

        ],
        [
            'descripcion.required' => 'El campo nombre debe ser obligatorio'
        ]

         );


         $guardar= new ImagenContrato;

         $guardar->descripcion=$request->descripcion;

         if($request->hasFile("photo")){
            $imagen=$request->file("photo");
            $nombreImagen=strtotime(now()).rand(11111,99999).'.'.$imagen->guessExtension();
            $ruta=public_path("img/usuarios");
            $imagen->move($ruta,$nombreImagen);
            $guardar->photo=$nombreImagen;
        }

        $guardar->id_contrato=$request->id_contrato;

        $guardar->save();

        return redirect()->route('contratos.index');


    }


}
