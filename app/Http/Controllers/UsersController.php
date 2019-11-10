<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * 注册展示页面
     * @return [type] [description]
     */
    public function create(){
        return view('users.create');
    }

    /**
     * 个人中心
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function show(User $user){
        return view('users.show',compact('user'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6|max:18'
        ]);
        return;
    }
}
