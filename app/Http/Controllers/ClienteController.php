<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::id();
        $id_tenant=User::select('id_tenant')->where('id','=',$id)->first();

        $clientes=Cliente::where('id_tenant','=',$id_tenant->id_tenant)->get();
        
     return view('clientes.index',compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

 
       return view('clientes.crear'); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


       
        
        $id=Auth::id();
        $id_tenant=User::select('id_tenant')->where('id','=',$id)->first();
        // $empresa=Empresa::where('id_tenant','=', $idempresa)->get();
        

        request()->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'email' => 'required',
          
        ]);


        $data=$request->only([
            'nombre',
            'telefono',
            'email'
        ]);

        $data['id_tenant']=$id_tenant->id_tenant;
        Cliente::create($data);
        return redirect()->route('clientes.index');

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
    public function edit(Cliente $cliente)
    {
        
        return view('clientes.editar',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        
        request()->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'email' => 'required',

        ]);

        $cliente->update($request->all());
        return redirect()->route('clientes.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index');
    }
}
