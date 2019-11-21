<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Login;

class LoginController extends Controller
{
    /*发送邮件*/
    public function send(){
        $email=request()->email;
        // $email='2877503663@qq.com';
        $code=rand(100000,999999);
        $message='您正在注册全国最大珠宝商会员,验证码:'.$code;
        session(['regcode'=>['code'=>$code,'email'=>$email]]);        
        $this->sendemail( $email,$message);
    
    }
    /*发送邮件*/
    public function sendemail($email,$code){
        \Mail::raw($code ,function($message)use($email){
        //设置主题
            $message->subject("欢迎注册滕浩有限公司");
        //设置接收方
            $message->to($email);
        });
    }
    /*注册邮箱*/
    public function regdo(){
        $post=request()->except('_token');
        $li=session('regcode');//取值
        // dump($post['user_pwd']);
        // dd($li);
        if($post['user_email']!=$li['email']){
            echo "<script>alert('邮箱不一致');window.history.go(-1);</script>";exit;
        }
        if($post['code']!=$li['code']){
            echo "<script>alert('验证码有误');window.history.go(-1);</script>";exit;
        }
        if($post['user_pwd']!=$post['user_pwds']){
            echo "<script>alert('密码不一致');window.history.go(-1);</script>";exit;
        }
        $post['addtime']=time();
        $res=Login::create($post);
        if($res){
            echo "<script>alert('注册成功');location.href='login'</script>";
        }else{
            echo "<script>alert('注册失败');location.href='reg'</script>";
        }
    }
    
    /*执行登陆*/
    public function logindo(){
        $post=request()->except('_token');
        $where[]=['user_email','=',$post['user_email']];
        $res=Login::where($where)->first();//查询数据库
            // dump($res);exit;
        
        if($res){
            if($post['user_pwd']==$res['user_pwd']){
                /*存session*/
                session(['user_id'=>$res['user_id']]);
                echo "<script>alert('登陆成功');location.href='index'</script>";
            }
        }else{
            echo "<script>alert('登陆失败');location.href='login'</script>";
        }
    }
}
