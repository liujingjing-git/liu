<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
    <title>商品品牌列表</title>
</head>
<body>
<center><h3>商品品牌的列表</h3></center>
    <form action="" class="navbar-form navbar-left" role="search">
		<input	type="text" name="word" value="{{$query['word']??''}}" placeholder="请输入品牌名称关键字" class="form-control">
		<input	type="text" name="desc" value="{{$query['desc']??''}}" placeholder="请输入备注" class="form-control">
		<input type="submit" value="搜索">
	</form>

    <table class="table">
	<thead>
		<tr>
			<th>品牌id</th>
			<th>品牌LOGO</th>
			<th>品牌名称</th>
			<th>品牌网址</th>
			<th>品牌备注</th>
			<th>状态</th>
		</tr>
	</thead> 
	<tbody> 
    @php $i=1 @endphp
    @foreach($data as $v)
		<tr @if($i%2==0) class="active" @else  class="danger" @endif>
			<td>{{$v->brand_id}}</td>
			<td><img src="{{env('UPLOAD_URL')}}{{$v->brand_logo}}" width="50px"></td> 
			<td>{{$v->brand_name}}</td>
			<td>{{$v->brand_url}}</td>
			<td>{{$v->brand_desc}}</td>
			<td>
                <a href="{{url('/brand/delete/'.$v->brand_id)}}">删除</a> | 
				<a href="{{url('/brand/edit/'.$v->brand_id)}}">编辑</a>
            </td> 
		</tr>
        @php $i++ @endphp
    @endforeach
	</tbody>
</table>
<a href="{{url('/brand/create')}}">添加</a>
 <!--分页 -->
  {{$data->appends($query)->links()}} 
</body>
</html>