<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    //
    public function __construct(){
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }


    public function create(){
        return view('sessions.create');
    }

    public function store(Request $request){
        $credentials = $this->validate($request,[
           'email' => 'required|email|max:255',
           'password' => 'required'
        ]);

//        if (Auth::attempt(['email' => $email, 'password' => $password])) {
//            // 该用户存在于数据库，且邮箱和密码相符合 上面的文档，数组格式。
//        }

        if (Auth::attempt($credentials,$request->has('remember'))) {
            if(Auth::user()->activated){
                session()->flash('success', '欢迎回来！！');
//            return redirect()->route('users.show',[Auth::user()]);
//            return redirect()->back()->withInput(); 这一行写错了
                $fallback = route('users.show', Auth::user());
                return redirect()->intended($fallback);
            } else {
                Auth::logout();
                session()->flash('warning', '邮箱没有激活，请激活');
                return redirect('/');
            }



        } else {
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }

    }

    public function destroy(){
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }


}
