@extends('layouts.shop')
@section('title', '全国最大珠宝商-注册')
@section('content')
<header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('regdo')}}" method="post" class="reg-login">
      <h3>已经有账号了？点此<a class="orange" href="{{url('login')}}">登陆</a></h3>
      <div class="lrBox">
        @csrf
       <div class="lrList"><input type="text" name='user_email' placeholder="输入手机号码或者邮箱号" id='email' /></div>
       <div class="lrList2"><input type="text" name='code' placeholder="输入短信验证码" /> <button type='button' id='butt'>获取验证码</button></div>
       <div class="lrList"><input type="text" name='user_pwd' placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="text" name='user_pwds' placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/style.js"></script>
  </body>
</html>
<script src='/static/admin/js/jquery-3.1.1.min.js'></script>
<script>
$(function(){
  $(document).on('click','#butt',function(){
    var email=$('#email').val();
    $.post(
      "{{url('/send')}}",
      {email:email,_token:"{{csrf_token()}}"},
      function(res){
          console.log(res)
      }
    )
  })
})
</script>
@include('index.public.footer')
@endsection