<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function index(){
        //list user SELECT * FROM  users
        $users = User::all();
    }

    public function view($id){
        //un user SELECT * FROM users WHERE id =".$id;
        $user=User::find($id);
        $user_dupa_nume=User::where("name",$name)->get();
    }

    public function edit($id){
        //edit user
        $new_user_data=post();
        $user=User::find($id);
        $user->name = $new_user_data['name'];
        $user->email = $new_user_data['email'];
        $user->password=$new_user_data['password'];
        $user->save();

    }
    public function create(){
        //create user
        $new_user_data=post();
        $user=new User();
        $user->name = $new_user_data['name'];
        $user->email = $new_user_data['email'];
        $user->password=$new_user_data['password'];
        $user->save();
    }

    public function delete($id){
        //delete user
        $user=User::find($id);
        if($user)
            $user->delete();
    }
}
