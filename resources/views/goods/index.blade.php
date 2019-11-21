<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
    <title>商品列表</title>
</head>
<body>
<center><h3>商品的列表</h3></center>
    <form action="" class="navbar-form navbar-left" role="search">
		<input	type="text" name="name"  placeholder="请输入商品名称" class="form-control">
		<input type="submit" value="搜索">
	</form>

    <table class="table">
	<thead>
		<tr>
			<th>商品ID</th>
			<th>商品名称</th>
			<th>商品价格</th>
            <th>商品介绍</th>
			<th>商品库存</th>
			<th>商品图片</th>
			<th>商品相册</th>
			<th>新品</th>
			<th>精品</th>
			<th>热卖</th>
			<th>上架</th>
			<th>品牌</th>
			<th>分类</th>
			<th>状态</th>
		</tr>
	</thead> 
	<tbody> 
   @foreach($goods_all as $v)
		<tr class="danger">
            <td>{{$v->goods_id}}</td>
            <td>{{$v->goods_name}}</td>
            <td>{{$v->goods_price}}</td>
            <td>{{$v->goods_desc}}</td>
			<td>{{$v->goods_num}}</td>
			<td>
				<img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width="50px">
			</td> 
            <td>
				<img src="{{env('UPLOAD_URL')}}{{$v->goods_imgs}}" width="50px">			
			</td>
			<td>
				@if($v->is_new==1)
					√
				@else
					×
				@endif
			</td>
			<td>
				@if($v->is_best==1)
					√
				@else
					×
				@endif
			</td>
			<td>
				@if($v->is_hot==1)
					√
				@else
					×
				@endif
			</td>
            <td>
				@if($v->is_up==1)
					√
				@else 
					×
				@endif
			</td>
            <td>{{$v->brand_name}}</td>
            <td>{{$v->cate_name}}</td>
			<td>
                <a href="{{url('/goods/delete/'.$v->goods_id)}}">删除</a> | 
				<a href="{{url('/goods/edit/'.$v->goods_id)}}">编辑</a>
            </td> 
		</tr>
    @endforeach
	</tbody>
</table>
 {{$goods_all->links()}}
<a href="{{url('/goods/create')}}">添加</a>
</body>
</html>