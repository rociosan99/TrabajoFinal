<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function roles_index(){
        return view("vistas_estaticas.users.roles-index");
    }

    public function roles_create(){
        return view("vistas_estaticas.users.roles-create");
    }

    public function users_index(){
        return view("vistas_estaticas.users.users-index");

    }

    public function users_create(){
        return view ("vistas_estaticas.users.users-create");
    }
    public function users_edit($id){
        return view ("vistas_estaticas.users.users-edit",["id"=>$id]);
    }
}
