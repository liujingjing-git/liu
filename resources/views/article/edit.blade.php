<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css"> 
    <script src="{{asset('/static/admin/js/jquery-3.1.1.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">    
    <title>文章标题修改</title>
</head>
<body>
<center><h3>文章标题修改</h3></center>
<form action="{{url('article/update/'.$data->a_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">文章标题</label>
            <div class="col-sm-10">
                <input type="text" name="a_name" value="{{$data->a_name}}" class="form-control" id="firstname"  placeholder="请输入文章标题">
                <b style="color:red">@php echo $errors->first('a_name');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">文章分类</label>
            <div class="col-sm-10">
               <select name="c_id">
                    <option value="">--请选择--</option>
                @foreach($res as $v)
                    @if($data->c_id==$v->c_id)
                        <option value="{{$v->c_id}}" selected>{{$v->c_name}}</option>
                    @else
                        <option value="{{$v->c_id}}">{{$v->c_name}}</option>
                    @endif
                @endforeach
               </select>
               <b style="color:red">@php echo $errors->first('c_id');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">文章作者</label>
            <div class="col-sm-10">
               <input type="text" name="a_passage" value="{{$data->a_passage}}" class="form-control" id="lastname" placeholder="请输入文章作者">
               <b style="color:red">@php echo $errors->first('a_passage');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">文章重要性</label>
            <div class="col-sm-10">
            @if($data->a_pop==1)
                    <input type="radio" name="a_pop" value="1" checked>普通
                    <input type="radio" name="a_pop" value="2">置顶
            @else
                    <input type="radio" name="a_pop" value="1">普通
                    <input type="radio" name="a_pop" value="2" checked>置顶
            @endif
               <b style="color:red">@php echo $errors->first('a_pop');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">是否展示</label>
            <div class="col-sm-10">
            @if($data->a_opp==1)
                <input type="radio" name="a_opp" value="1" checked>显示
                <input type="radio" name="a_opp" value="2">不显示
            @else
                <input type="radio" name="a_opp" value="1">显示
                <input type="radio" name="a_opp" value="2" checked>不显示
            @endif
               <b style="color:red">@php echo $errors->first('a_opp');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">作者email</label>
            <div class="col-sm-10">
               <input type="text" name="a_email" value="{{$data->a_email}}" class="form-control" id="lastname" placeholder="请输入作者邮箱">
               <b style="color:red">@php echo $errors->first('a_email');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">关键字</label>
            <div class="col-sm-10">
               <input type="text" name="a_first" value="{{$data->a_first}}" class="form-control" id="lastname" placeholder="请输入关键字">
               <b style="color:red">@php echo $errors->first('a_first');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">网页描述</label>
            <div class="col-sm-10">
               <textarea name="a_desc" cols="25px" rows="7px">{{$data->a_desc}}</textarea>
               <b style="color:red">@php echo $errors->first('a_desc');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">上传文件</label>
            <div class="col-sm-10">
               <input type="file" name="a_file">
               <img src="{{asset('storage'.$data->a_file)}}" width="50px" height="50px">
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