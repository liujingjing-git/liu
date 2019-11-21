<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
    <title>分类编辑</title>
</head>
<body>
<center><h3>分类编辑</h3></center>
<form action="{{url('cate/update/'.$data->cate_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">分类名称</label>
            <div class="col-sm-10">
                <input type="text" name="cate_name" value="{{$data->cate_name}}" class="form-control" id="firstname"  placeholder="请输入分类名称">
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">是否上架</label>
            <div class="col-sm-10">
            @if($data->cate_show==1)
               <input type="radio" name="cate_show" value="1" checked>是
               <input type="radio" name="cate_show" value="2">否
            @else
                <input type="radio" name="cate_show" value="1">是
                <input type="radio" name="cate_show" value="2" checked>否
            @endif
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">是否在导航栏展示</label>
            <div class="col-sm-10">
            @if($data->cate_nav_show==1)
                <input type="radio" name="cate_nav_show" value="1" checked>是
                <input type="radio" name="cate_nav_show" value="2">否
            @else
                <input type="radio" name="cate_nav_show" value="1">是
                <input type="radio" name="cate_nav_show" value="2" checked>否
            @endif
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">父类</label>
            <div class="col-sm-10" >
            <select name="parent_id">
                <option value="">--请选择--</option>
                @foreach($cateInfo as $v)
                    @if($data->parent_id==$v->parent_id)
                        <option value="{{$v->cate_id}}" selected>{{str_repeat('--',$v['level'])}}{{$v->cate_name}}</option>
                    @else
                        <option value="{{$v->cate_id}}">{{str_repeat('--',$v['level'])}}{{$v->cate_name}}</option>
                    @endif
                @endforeach
            </select>            
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">确认编辑</button>
            </div>
        </div>
</form>
</body>
</html>