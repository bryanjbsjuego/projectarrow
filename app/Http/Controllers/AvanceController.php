<?php

namespace App\Http\Controllers;

use App\Models\Avance;
use App\Models\Concepto;
use App\Models\Dato;
use App\Models\ImagenesContrato;
use App\Models\imgConceptos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class AvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        //que concepto pertenece
        $concepto=Concepto::find($id);
        //concepto padre
        $conceptop=Concepto::select('id_codigo')->where('id','=',$concepto->id_codigo)->first();
        $conceptopp=Concepto::where('id','=',$conceptop->id_codigo)->first();
        $imgc=imgConceptos::where('id_concepto','=',$conceptopp->id)
        ->where('descripcion','=','croquis')->first();

         $p=$concepto->id_codigo;

        //  return $p;
       

        // return $imgc;

        //img del contrato
        $imgco=[];
        $imgco=ImagenesContrato::where('id_contrato','=',$concepto->id_contrato)->get();

        $imgn=ImagenesContrato::where('id_contrato','=',$concepto->id_contrato)->count();

        //fecha

        $avancef=Avance::where('id_concepto','=',$id)->first();

        // if($avancef->inicio=null || $avancef->inicio=null  ){
        //     $avancef=1;
        // }


        if($imgn==0){

            $img = new ImagenesContrato();
            $img->imagen='sinimg.png';

            $imgco[0]=$img;
            $imgco[1]=$imgco[0];

            // return $imgco;


        }else if($imgn==1){

            $img = new ImagenesContrato();
            $img->imagen='sinimg.png';

            $imgco[1]=$img;
        }
        
    

        $avance=DB::table('contratos')
        ->select('conceptos.concepto as nom_concepto','conceptos.id as idc', 'conceptos.codigo','clientes.nombre as nombre_cliente',
        'contratos.nombre_obra as nom_obra', 'contratos.ubicacion','contratos.importe as conimporte',
        'contratos.contrato as nom_contrato','empresas.nombre as nom_empresa')
        ->join('conceptos', 'contratos.id','=','conceptos.id_contrato')
        ->join('clientes', 'contratos.id_cliente','=','clientes.id')
        ->join('empresas', 'contratos.id_empresa','=','empresas.id')
        ->where('conceptos.id','=',$id)->first();


        $unidad=DB::table('unidad')->select('unidad.nombre as unidad_nombre')
        ->join('conceptos', 'unidad.id','=','conceptos.id_unidad')
        ->where('conceptos.id','=',$id)->first();

       
 

         $dato=Dato::where('id_concepto','=',$id)->count();

         
  

        return view("avances.show",compact('avance','imgc','imgco','unidad','avancef','dato','p'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     
      //Datos de mi avance
        $dato=Dato::find($id);

        

        // return $dato;

    //Opciones seleccionadas de mi formulario
    $avance=Avance::where('id','=',$dato->id_avance)->first();

    
    // return $avance;
    $l=$avance->localizacion;
    $ap=$avance->anchoM;
    $an=$avance->anchoP;
    $vt=$avance->volumenT;
    $are=$avance->area;
    $al=$avance->altura;
    $es=$avance->espesor;
    $pie=$avance->pieza;

  

   


        return view('avances.editaravance',compact('l','ap','an','vt','are','al','es','pie','avance','dato'));



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

        $dato=Dato::find($id);

        // return $dato->hombro_izquierdo1;

      

        if($dato->hombro_derecho1==null  && $dato->hombro_derecho2==null){
            $dato->hombro_izquierdo1=$request->hombro_izquierdo1;
            $dato->hombro_izquierdo2=$request->hombro_izquierdo2;

            
        
        }else{
            $dato->hombro_derecho1=$request->hombro_derecho1;
            $dato->hombro_derecho2=$request->hombro_derecho2;
      
        
        }


        $avance=Avance::where('id','=',$dato->id_avance)->first();
        $dato->ancho1=$request->ancho1;
        $dato->ancho2=$request->ancho2;
        $dato->anchot=$request->anchot;
        $dato->altura=$request->altura;
        $dato->pieza=$request->pieza;
        $dato->espesor=$request->espesor;
        $dato->save();
        return redirect()->route('ver.avance',$avance->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
      $dato=Dato::find($id);
      $avance=Avance::where('id','=',$dato->id_avance)->first();

      $dato->delete();

      return redirect()->route('ver.avance',$avance->id);
    }

    public function agregarf($id){

        $avance=Avance::where('id_concepto','=',$id)->first();

        $avance=DB::table('conceptos')->select('conceptos.codigo as codigo','conceptos.id as idc','avances.id as ida')
        ->join('avances', 'conceptos.id','=','avances.id_concepto')
        ->where('id_concepto','=',$id)->first();

        // return $avance;

        return view('avances.fecha',compact('avance'));



    }

    public function guardarf($id, Request $request){

        $avance=Avance::where('id_concepto','=',$id)->first();

       

        $avance->inicio=$request->fecha_inicio;
        $avance->fin=$request->fecha_termino;

       

        $avance->save();

        

        return redirect()->route('Avance.show',$id);
    }



    public function agregaropc($id){

        $a=Avance::find($id);
       

        $concepto=Concepto::where('id','=',$a->id_concepto)->first();

        $l=$a->localizacion;
        $al=$a->altura;
        $ap=$a->anchoM;
        $am=$a->anchoP;
        $vt=$a->volumenT;
        $are=$a->area;
        $es=$a->espesor;


        $unidad=DB::table('unidad')->select('unidad.nombre as nombre')
        ->join('conceptos', 'unidad.id','=','conceptos.id_unidad')
        ->where('conceptos.id','=',$concepto->id)->first();

        if($unidad->nombre=='PZ' || $unidad=='pz'){
            $pieza=true;
        }else{
            $pieza=false;
        }
        
        return view('avances.opc',compact('a','l','al','ap','am','vt','are','pieza','es'));
    }

    public function guardaropc($id,Request $request){

        

        $l=$request->localizacion;
        $al=$request->altura;
        $ar=$request->area;
        $an=$request->ancho;
        $ancp=$request->anchop;
        $volumenr=$request->volument;
        $pieza=$request->pieza;
        $es=$request->espesor;

     
    

        if($request->volument=='on'){
            if(  $an==null || $ar==null || $l==null){
                $mensaje_error="Error!! Asegurate de tener los valores de localizacion, Altura, Area, Ancho Promedio" ;
                return  redirect()->back()->with(compact('mensaje_error'));
            }
        }

      

        if($request->pieza=='on'){
            if( $ar=='on' || $al=='on' || $ancp=='on'  ){
               
               $mensaje_error="Estos campos no se suelen seleccionar en pieza podrían provocar errores, !Recomiendo: Localizacion y Espesor";
               return  redirect()->back()->with(compact('mensaje_error'));
            }
        }

        if($an=='on'){
            if( $ancp=='on'){
               $mensaje_error="Asegúrate de calular el ancho de una sola forma'";
               return  redirect()->back()->with(compact('mensaje_error'));
            }
        }


        if($al=='on' && $volumenr!="on" ){

            if( $l!='on' ||  $ancp!='on'  ){
               $mensaje_error="Seleccione mas opciones para la altura se recomienda; la localización y el Ancho total para esta opción'";
               return  redirect()->back()->with(compact('mensaje_error'));
            }
        }

        if($ancp=='on'){
            if( $l!='on' ){
               $mensaje_error="Seleccione mas opciones se recomienda; la localización ó  la localización y la altura '";
               return  redirect()->back()->with(compact('mensaje_error'));
            }
        }

        if($ar=='on'){
            if( $l!='on' && $ancp!="on" ){
               $mensaje_error="Para Calcular el AREA es necesario marcar una localización y un Ancho Promedio'";
               return  redirect()->back()->with(compact('mensaje_error'));
            }
        }

      

    
        $avance=Avance::find($id);

        if($l!=null){
            $avance->localizacion=1;
            $avance->save();
        }else{
            $avance->localizacion=0;
            $avance->save();
        }
        if($al!=null){
            $avance->altura=1;
            $avance->save();
        }else{
            $avance->altura=0;
            $avance->save();
        }
        if($ar!=null){
            $avance->area=1;
            $avance->save();
        } else{
            $avance->area=0;
            $avance->save();
        }
        if($an!=null){
            $avance->anchoM=1;
            $avance->save();
        }else{
            $avance->anchoM=0;
            $avance->save();
        }
        if($ancp !=null){
            $avance->anchoP=1;
            $avance->save();
        }else{
            $avance->anchoP=0;
            $avance->save();
        }
        if($volumenr!=null){
            $avance->volumenT=1;
            $avance->save();
        }else{
            $avance->volumenT=0;
            $avance->save();
        }  if($pieza!=null){
            $avance->pieza=1;
            $avance->save();
        }else{
            $avance->pieza=0;
            $avance->save();
        }
        if($es!=null){
            $avance->espesor=1;
            $avance->save();
        }else{
            $avance->espesor=0;
            $avance->save();
        }
                
       
        return redirect()->route('Avance.show',$avance->id_concepto);
     
    }

    public function veravance($id){

       

        $avance=Avance::find($id);

        
    
        // return $avance;

        $l=$avance->localizacion;
        //este promedio total 
        $an=$avance->anchoM;

      
        $al=$avance->altura;
        // Ancho Total
        $ap=$avance->anchoP;
   
        $vtt=$avance->volumenT;
        $pie=$avance->pieza;
        $es=$avance->espesor;
        $are=$avance->area;

       
        // return $vtt;

        //avance

        $datosG=Dato::where('id_avance','=',$avance->id)
        ->where('hombro_izquierdo1','=',null)->where('hombro_izquierdo2','=',null)->get();

        
        
        // return $datosG;

        $datosD=Dato::where('id_avance','=',$avance->id)
        ->where('hombro_derecho1','=',null)->where('hombro_derecho2','=',null)->whereNotNull('hombro_izquierdo1')
        ->whereNotNull('hombro_izquierdo2')->get();

        
        // si existen datos ya 
        // $datosexisten= DB::table('avances')
        // ->selectRaw('SUM(localizacion)+(altura)+(AnchoM)+(AnchoP)+(VolumanT)+(Area)')->groupBy('id')
        // ->get();

        // return $datosexisten;

        
        

        // return $l;

        return view('avances.tablaavance',compact('l','an','al','ap','vtt','are','pie','es','avance','datosG','datosD'));
    }


    public function formulario($id){

        $avance=Avance::find($id);
    
 

        $l=$avance->localizacion;
        $ap=$avance->anchoP;
        $al=$avance->altura;
        $an=$avance->anchoM;
        $vt=$avance->volumenT;
        $are=$avance->area;
        $es=$avance->espesor;
        $pie=$avance->pieza;
        
        return view('avances.createHombroD',compact('l','an','al','ap','vt','are','avance','es','pie'));
    }


    public function formularioIzquierdo($id){

        $avance=Avance::find($id);
    
        $l=$avance->localizacion;
        $ap=$avance->anchoP;
        $al=$avance->altura;
        $an=$avance->anchoM;
        $vt=$avance->volumenT;
        $are=$avance->area;
        $es=$avance->espesor;
        $pie=$avance->pieza;
        
        return view('avances.createHombroI',compact('l','an','al','ap','vt','are','avance','es','pie'));
    }


    public function registrarAvance($id,Request $request){

        $avance=Avance::find($id);

        
        $dato= new Dato();

        $dato->hombro_derecho1=$request->hombro_derecho1;
        $dato->hombro_derecho2=$request->hombro_derecho2;
    
        $dato->ancho1=$request->ancho1;
        $dato->ancho2=$request->ancho2;
        $dato->anchot=$request->anchot;
        $dato->altura=$request->altura;

        $dato->pieza=$request->pieza;
        $dato->espesor=$request->espesor;

        $dato->id_concepto=$avance->id_concepto;
        $dato->id_avance=$avance->id;

        $dato->save();

        // return $dato;


        // return $request->all();

        return redirect()->route('ver.avance',$avance->id);

    }

    public function  registrarAvanceIzquierdo($id,Request $request){

        $avance=Avance::find($id);

        
        $dato= new Dato();

        $dato->hombro_izquierdo1=$request->hombro_izquierdo1;
        $dato->hombro_izquierdo2=$request->hombro_izquierdo2 ;
        

        // return $request->all();
        $dato->ancho1=$request->ancho1;
        $dato->ancho2=$request->ancho2;
        $dato->anchot=$request->anchot;
        $dato->altura=$request->altura;

        $dato->pieza=$request->pieza;
        $dato->espesor=$request->espesor;

        $dato->id_concepto=$avance->id_concepto;
        $dato->id_avance=$avance->id;

        $dato->save();
        
    
        return redirect()->route('ver.avance',$avance->id);

    }


    public function editarIz($id){
        
      //Datos de mi avance
      $dato=Dato::find($id);

      
  //Opciones seleccionadas de mi formulario
  $avance=Avance::where('id','=',$dato->id_avance)->first();

  
  // return $avance;
  $l=$avance->localizacion;
  $ap=$avance->anchoM;
  $an=$avance->anchoP;
  $vt=$avance->volumenT;
  $are=$avance->area;
  $al=$avance->altura;
  $es=$avance->espesor;
  $pie=$avance->pieza;



 


      return view('avances.editarIzquierdo',compact('l','ap','an','vt','are','al','es','pie','avance','dato'));


    }

   
}
