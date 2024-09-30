<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function roles_index(){
        return view("users.roles-index");
    }

    public function roles_create(){
        return view("users.roles-create");
    }
}
