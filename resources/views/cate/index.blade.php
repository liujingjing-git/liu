<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
    <title>分类列表</title>
</head>
<body>
<center><h3>分类列表</h3></center>
<form action="">
    <input type="text" name="cate_name" value="{{$query['cate_name']??''}}" placeholder="请输入分类名称关键字">
    <input type="submit" value="搜索">
</form>
<table class="table">
    <a href="{{url('/cate/create')}}">添加</a>
	<thead>
		<tr>
			<th>分类ID</th>
			<th>分类名称</th>
			<th>是否展示</th>
			<th>是否在导航栏展示</th>
			<th>状态</th>
		</tr>
	</thead> 
	<tbody>
    @php $i=1 @endphp
    @foreach($res as $v)
        <tr  @if($i%2==0) class="active" @else  class="danger" @endif>   
			<td>{{$v->cate_id}}</td>
			<td>{{$v->cate_name}}</td>
			<td>
                @if($v->cate_show==1)
                    是
                @else
                    否
                @endif
            </td>
			<td>
                @if($v->cate_nav_show==1)
                    是
                @else
                    否
                @endif
            </td>
			<td>
                <a href="{{url('cate/delete/'.$v->cate_id)}}">删除</a> |
                <a href="{{url('cate/edit/'.$v->cate_id)}}">编辑</a> 
            </td>
		</tr>
        @php $i++ @endphp
    @endforeach
	</tbody>
</table>
{{$res->links()}} 
</body>
</html>