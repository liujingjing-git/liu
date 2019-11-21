<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css"> 
    <script src="{{asset('/static/admin/js/jquery-3.1.1.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">    
    <title>管理员添加</title>
</head>
<body>
<center><h3>管理员添加</h3></center>
    <!-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif -->
<form action="{{url('admin/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">管理员姓名</label>
            <div class="col-sm-10">
                <input type="text" name="admin_name" class="form-control" id="firstname"  placeholder="请输入管理员姓名">
                <b style="color:red">@php echo $errors->first('admin_name');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">管理员密码</label>
            <div class="col-sm-10">
               <input type="password" name="admin_pwd" class="form-control" id="lastname" placeholder="请输入密码">
               <b style="color:red">@php echo $errors->first('admin_pwd');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
</form>
</body>
    <script>
    // 管理员姓名的验证 
        $("#firstname").blur(function(){
            var admin_name=$(this).val();
            var reg=/^([\u4E00-\uFA29]|[\uE7C7-\uE7F3]|[a-zA-Z0-9])*$/;
            if(!reg.test(admin_name)){
                $(this).parent().addClass('has-error');
                $(this).next().text('管理员名称不符合规范');
                return;
            }
        })
    
    // 管理员密码的验证
        $("#lastname").blur(function(){
            var admin_pwd=$(this).val();
            var reg= /^.*(?=.{6,})(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*? ]).*$/;
            if(!reg.test(admin_pwd)){
                $(this).parent().addClass('has-error');
                $(this).next().text('最少6位，包括至少1个大写字母，1个小写字母，1个数字，1个特殊字符');
                return;
            }
        })
    </script>
</html>