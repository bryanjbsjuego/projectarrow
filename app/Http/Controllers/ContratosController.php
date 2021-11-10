<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
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
        return view ('contratos.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
