<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(){
        // $id=Auth::id();
        // $rol=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
        // ->join('roles','roles.id','=','model_has_roles.role_id')
        // ->select('roles.name')
        // ->where('users.id','=',$id)->first();
        
        $user=Auth::guard('api')->user(); 

       

    }
}
