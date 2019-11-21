<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
    <title>管理员编辑</title>
</head>
<body>
<center><h3>管理员编辑</h3></center>
<form action="{{url('admin/update/'.$data->admin_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">管理员姓名</label>
            <div class="col-sm-10">
                <input type="text" name="admin_name" value="{{$data->admin_name}}" class="form-control" id="firstname"  placeholder="请输入管理员姓名">
                <b style="color:red">@php echo $errors->first('admin_name');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">管理员密码</label>
            <div class="col-sm-10">
               <input type="password" name="admin_pwd" value="{{$data->admin_pwd}}" class="form-control" id="lastname" placeholder="请输入密码">
               <b style="color:red">@php echo $errors->first('admin_pwd');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">编辑成功</button>
            </div>
        </div>
</form>
</body>
</html>