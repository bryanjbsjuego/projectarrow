<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

use PhpParser\Node\Stmt\UseUse;
use Symfony\Component\Console\Input\Input;

use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use PDF;







class OperativoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // primero obtenemos los id del responsable empresa y respobsale tenanat con la finalidad
        // de que estos usuarios no sean mostrados como operativos

        $id_roltenant=Role::select('id')->where('name','=','Tenant')->first();
        $id_responsable=Role::select('id')->where('name','=','Responsable de empresa')->first();


        //obtenemos la informacion del usuario para filtrar
        // $info=User::select('id_tenant','empresa')->where('id','=',Auth::id())->first();

        // $usuarios = DB::table('users')->select('name','users.id','users.email')
        // ->join('empresas', 'users.empresa', '=', 'empresas.id')
        // ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        // ->where('users.id_tenant','=',$info->id_tenant)
        // ->whereNotIn('role_id', [$id_roltenant->id, $id_responsable->id,])
        // ->where('empresas.id','=',$info->empresa)->paginate(5);


        $id=User::select('id_tenant','empresa')->where('id','=',Auth::id())->first();

        $usuarios=DB::table('users')
        ->join('empresas', 'users.empresa', '=', 'empresas.id')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->where('users.id_tenant',$id->id_tenant)
        ->whereNotIn('role_id', [$id_roltenant->id, $id_responsable->id,])
        ->where('empresas.id','=',$id->empresa)
        ->select('users.*','roles.name as rol')
        ->get();

        // return $usuarios;




        return view('operativos.index',compact('usuarios'));
    }

    public function createPDF()
    {

        // primero obtenemos los id del responsable empresa y respobsale tenanat con la finalidad
        // de que estos usuarios no sean mostrados como operativos

        $id_roltenant=Role::select('id')->where('name','=','Tenant')->first();
        $id_responsable=Role::select('id')->where('name','=','Responsable de empresa')->first();


        //obtenemos la informacion del usuario para filtrar
        // $info=User::select('id_tenant','empresa')->where('id','=',Auth::id())->first();

        // $usuarios = DB::table('users')->select('name','users.id','users.email')
        // ->join('empresas', 'users.empresa', '=', 'empresas.id')
        // ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        // ->where('users.id_tenant','=',$info->id_tenant)
        // ->whereNotIn('role_id', [$id_roltenant->id, $id_responsable->id,])
        // ->where('empresas.id','=',$info->empresa)->paginate(5);


        $id=User::select('id_tenant','empresa')->where('id','=',Auth::id())->first();

        $usuarios=DB::table('users')
        ->join('empresas', 'users.empresa', '=', 'empresas.id')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->where('users.id_tenant',$id->id_tenant)
        ->whereNotIn('role_id', [$id_roltenant->id, $id_responsable->id,])
        ->where('empresas.id','=',$id->empresa)
        ->select('users.*','roles.name as rol')
        ->get();

        // return $usuarios;
        $pdf=PDF::loadView('operativos.pdf',['usuarios'=>$usuarios]);
        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();





       // return view('operativos.pdf',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id=Auth::id();
        $empresa=DB::table('users')
        ->join('empresas','users.empresa','=','empresas.id')
        ->select('empresas.nombre','empresas.id')
        ->where('users.id','=',$id)
        ->first();

        $rol=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.id','=',$id)->first();

        if($rol->name=='Tenant'){
            $roles=Role::select('id','name')->whereNotIn('name',['Tenant','Responsable de obra', 'Asistente de obra'])->get();
        }else if($rol->name=='Responsable de empresa'){
            $roles=Role::select('id','name')->whereNotIn('name',['Tenant','Responsable de empresa'])->get();
        }


        // return $roles;


        return view('operativos.crear',compact('roles','empresa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rol=$request->input(['roles']);
        $consulta=Role::select('id')->where('name','like',$rol)->first();

        if($rol !=0 || $rol !='' ){

            //obtenemos id del tenant

            $id_tenant=User::select('id_tenant')->where('id','=',Auth::id())->first();
            $usuario= new User;
            $usuario->name=$request->name;
            $usuario->email=$request->email;
            $usuario->password=bcrypt($request->input('password'));
            $usuario->id_tenant=$id_tenant->id_tenant;
            $usuario->empresa=$request->input('empresa');
            $request->hasFile("photo");
            $imagen=$request->file("photo");
            $nombreImagen=strtotime(now()).rand(11111,99999).'.'.$imagen->guessExtension();
            $ruta=public_path("img/usuarios");
            $imagen->move($ruta,$nombreImagen);
            $usuario->photo=$nombreImagen;


            $usuario->save();
            $usuario->assignRole($consulta->id);

            $mensaje="Usuario registrado exitosamente.";
            return redirect()->route('operativos.index')->with(compact('mensaje'));

        }else{
            $mensaje="¡ERROR!, por favor selecciona un Rol";
            return back()->withInput()->with(compact('mensaje'));
        }

        // if($request->input('roles')=='0'){
        //     return "viaje vacio";
        // }else{

        // }
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
