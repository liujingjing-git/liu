<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{session('msg')}}
    <form action="{{url('/doReg')}}" method="post">
        @csrf
        <input type="text" name="name" placeholder="请输入用户名">
        <input type="email" name="email" placeholder="请输入邮箱">
        <input type="password" name="password" placeholder="请输入密码">
        <input type="repassword" name="repassword" placeholder="请确认密码">
        <button>注册</button>
    </form>
</body>
</html>