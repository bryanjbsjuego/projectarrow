<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $usuarios=User::paginate(5);
        $id=Auth::id();
        $usuarios=User::where('users.id_tenant',$id)->paginate(5);
        return view('usuarios.index',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $id=Auth::id();
        $empresas=DB::table('users')->join('empresas','empresas.id_tenant','=','users.id_tenant')
        ->select('empresas.id','empresas.nombre')
        ->where('empresas.id_tenant','=',$id)->groupBy('empresas.id')->get();

        // return $empresas;

        $roles=Role::select('id','name')->get();
        // return $roles;
        return view('usuarios.crear',compact('roles','empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $formulario=$request->all();
        $rol =$request->input(['roles']);
        $consulta=Role::select('id')->where('name','like',$rol)->first();
      
        
        if($consulta->id==1){
            $id_tenant=null;
        }else{
            $id_tenant=Auth::id();
        }
        
            $this->validate($request,
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'photo' => 'required',
                'roles' => 'required',
                
            ],
            [
                'name.required' => 'El campo nombre debe ser obligatorio'
            ]
            
             );
    
            $usuario= new User;
            $usuario->name=$request->name;
            $usuario->email=$request->email;
            $usuario->password=bcrypt($request->input('password'));
            $usuario->id_tenant=$id_tenant;


            $usuario->empresa=$request->input('empresa');
         
            if($request->hasFile("photo")){
                $imagen=$request->file("photo");
                $nombreImagen=strtotime(now()).rand(11111,99999).'.'.$imagen->guessExtension();
                $ruta=public_path("img/usuarios");
                $imagen->move($ruta,$nombreImagen);
                $usuario->photo=$nombreImagen;

               
            }
            $usuario->save();
            $usuario->assignRole($consulta->id);

       

        return redirect()->route('usuarios.index');
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
    public function edit(User $usuario)
    {

        //trae las empresas
        $id=Auth::id();
        $empresas=DB::table('users')->join('empresas','empresas.id_tenant','=','users.id_tenant')
        ->select('empresas.id','empresas.nombre')
        ->where('empresas.id_tenant','=',$id)->groupBy('empresas.id')->get();

        //consulta para obtener el rol del usuario 
        $rol=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.id','=',$usuario->id)->first();
        $rolSelect= $rol;

        // return $rol;

        //consulta para obtener todos los roles
        $roles=Role::select('id','name')->get();

        //consulta para traer la empresa en caso de existir


         return view('usuarios.editar',compact('usuario','empresas','roles','rolSelect'));



        // $idu=Auth::id();
        // $empresas=DB::table('users')->join('empresas','empresas.id_tenant','=','users.id_tenant')
        // ->select('empresas.id','empresas.nombre')
        // ->where('empresas.id_tenant','=',$idu)->groupBy('empresas.id')->get();
        
        
        // $user=User::find($id);

        // $roles=Role::select('id','name')->get();
        // //$roles=Role::pluck('name','name')->all();
        // $userRole=$user->roles->pluck('name','name')->all();
        // return view('usuarios.editar',compact('user','roles','userRole','empresas'));
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
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input=$request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input=Arr::except($input,array('password'));
        }

        $user=User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));
        return redirect()->route('usuarios.index');


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('usuarios.index');
    }
}
