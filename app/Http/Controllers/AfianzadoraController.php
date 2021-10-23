<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Afianzadora;

class AfianzadoraController extends Controller
{
    function __construct(){
        $this->middleware('permission:ver-afianzadora|crear-afianzadora|editar-afianzadora|borrar-afianzadora')->only('index');
        $this->middleware('permission:crear-afianzadora' , ['only' => ['create','store']] );
        $this->middleware('permission:editar-afianzadora' , ['only' => ['edit','update']] );
        $this->middleware('permission:borrar-afianzadora' , ['only' => ['destroy']] );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $afianzadoras=Afianzadora::paginate(5);

        return view('afianzadoras.index',compact('afianzadoras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
