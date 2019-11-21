<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
    <title>管理员列表</title>
</head>
<body>
<center><h3>管理员列表</h3></center>
<form action="">
    <input type="text" name="admin_name" value="{{$query['admin_name']??''}}" placeholder="请输入管理员姓名">
    <input type="submit" value="搜索">
</form>
    <table class="table">
	<thead>
		<tr>
			<th>管理员id</th>
			<th>管理员姓名</th>
			<th>状态</th>
		</tr>
	</thead> 
	<tbody>
    @foreach($res as $v)
        <tr class="danger">    
			<td>{{$v->admin_id}}</td>
			<td>{{$v->admin_name}}</td>
			<td>
                <a href="{{url('admin/delete/'.$v->admin_id)}}">删除</a> | 
				<a href="{{url('admin/edit/'.$v->admin_id)}}">编辑</a>
            </td> 
		</tr>
    @endforeach
	</tbody>
</table>
<a href="{{url('/admin/create')}}">添加</a>
 <!--分页 -->
 {{$res->links()}}
</body>
</html>