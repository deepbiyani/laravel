<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
        public function getUsers() {
            $users = UserModel::all()->toArray();
            return json_encode($users);
        }
}
