<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function create(){
        return view('users.create');
    }

    public function show(User $user){
        return view('users.show', compact('user'));
    }

    public function store(Request $request){
        $this->validate($request, [
                'name' => 'required|unique:users|max:50',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|confirmed|min:6'
            ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);// ?让我们接着对用户控制器的 store 方法进行更改，让用户注册成功后自动登录。

        session()->flash('success', '欢迎你，你将开始一段新的旅程');

        return redirect()->route('users.show',[$user]);
        //为什么这里要用中括号？ route() 方法会自动获取 Model 的主键 redirect()->route('users.show', [$user->id]);
    }
}
