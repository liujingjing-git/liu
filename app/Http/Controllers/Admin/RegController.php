<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class RegController extends Controller
{
   public function dologin(){
       $post=request()->except('_token');

       if (Auth::attempt($post)) {
            // 认证通过...
            return redirect('/brand/index');
        }else{
            return redirect('/login')->with('msg','没有此用户');
        }
    }

    public function doReg(){
        $post=request()->except('_token');
        // Auth::login($post);
        $post['password']=bcrypt($post['password']);
        $res=User::create($post);
     }
 }
