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

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);

        /*
        我们可以使用 session() 方法来访问会话实例。而当我们想存入一条缓存的数据，让它只在下一次的请求内有效时，则可以使用 flash 方法。flash 方法接收两个参数，第一个为会话的键，第二个为会话的值

        可以使用 session()->get('success')获取写入数据
         */
        session()->flash('success','欢迎,你将在这里开启一段新的旅程!');

        return redirect()->route('users.show',[$user]);
    }
}
