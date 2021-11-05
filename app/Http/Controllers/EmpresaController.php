<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    function __construct(){
        $this->middleware('permission:ver-empresa|crear-empresa|editar-empresa|borrar-empresa')->only('index');
        $this->middleware('permission:crear-empresa' , ['only' => ['create','store']] );
        $this->middleware('permission:editar-empresa' , ['only' => ['edit','update']] );
        $this->middleware('permission:borrar-empresa' , ['only' => ['destroy']] );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $usuario=Auth::id();
        $empresas=Empresa::where('id_tenant','=',$usuario)->get();
       
        // $empresas=Empresa::paginate(5);

        return view('empresas.index',compact('empresas'));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresas.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nombre' => 'required',
            'ubicacion' => 'required',
            'rfc' => 'required',
            'imms' => 'required',
            'ccem' => 'required'
        ]);
                
        $data=$request->only([
            'nombre',
            'ubicacion',
            'rfc',
            'imms',
            'ccem',
            'id_tenant'
        ]);

        $data['id_tenant']=auth()->id();
        Empresa::create($data);
        return redirect()->route('empresas.index');
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
    public function edit(Empresa $empresa)
    {
        return view('empresas.editar',compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        request()->validate([
            'nombre' => 'required',
            'ubicacion' => 'required',
            'rfc' => 'required',
            'imms' => 'required',
            'ccem' => 'required'
        ]);
        
        $empresa->update($request->all());
        return redirect()->route('empresas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {

        // return $empresa->id;

        $existen=Empleado::where('id_empresa','=', $empresa->id)->select(DB::raw('count(*) as empleados'))
        ->first();

        if($existen->empleados<=0){
       
             $empresa->delete();
             $mensaje='Empresa: '.$empresa->nombre." se elimino correctamente";
            return redirect()->route('empresas.index')->with(compact('mensaje'));
        }else{
           $mensaje_error='No puedes eliminar '.$empresa->nombre. ' cuenta con empleados Activos';
           return redirect()->route('empresas.index')->with(compact('mensaje_error'));
        }

    }
}
