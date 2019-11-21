<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="{{asset('/static/admin/js/jquery-3.1.1.min.js')}}"></script>
    <title>文章列表</title>
</head>
<body>
<center><h3>文章列表</h3></center>
    <form action="">
        <input type="text" name="a_name" value="{{$query['a_name']??''}}" placeholder="请输入文章标题关键字">
        <select name="c_id">
            <option value="">--请选择--</option>
            @foreach($res as $v)
                <option value="{{$v->c_id}}">{{$v->c_name}}</option>
            @endforeach
        </select>
        <input type="submit" value="搜索">
    </form>
<table class="table">
<a href="{{url('article/create')}}">添加</a>
	<thead>
		<tr>
			<th>文章编号</th>
			<th>文章标题</th>
			<th>文章重要性</th>
			<th>是否展示</th>
			<th>文章作者</th>
			<th>作者email</th>
			<th>网页描述</th>
            <th>文章分类</th>
            <th>图片</th>
			<th>状态</th>
		</tr>
	</thead> 
	<tbody> 
    @foreach($data as $v)
		<tr a_id="{{$v->a_id}}">
            <td>{{$v->a_id}}</td>
            <td>{{$v->a_name}}</td>
            <td>
                @if($v->a_pop==1)
                   重要
                @else 
                   普通
                @endif
            </td>
            <td> 
                @if($v->a_opp==1)
                    √
                @else 
                   ×
                @endif
            </td>
            <td>{{$v->a_passage}}</td>
            <td>{{$v->a_email}}</td>
            <td>{{$v->a_desc}}</td>
            <td>{{$v->c_name}}</td>
            <td>
                <img src="{{asset('storage'.$v->a_file)}}"  width="50px" height="50px">
            </td>
            <td>
                <a href="{{url('article/del/'.$v->a_id)}}" class="del">删除</a> | 
                <a href="{{url('article/edit/'.$v->a_id)}}">编辑</a>
            </td>
		</tr>
    @endforeach
	</tbody>
</table>
 <!--分页 -->
 {{$data->links()}}
</body>
    <!-- <script>
        $(".del").click(function(){
            var _this=$(this);
            var a_id=_this.parents("tr").attr("a_id");
            $.post(
                "{{url('article/del')}}",
                {a_id:a_id},
                function(res){
                    console.log(res);
                }
            )
        })
    </script> -->
</html>