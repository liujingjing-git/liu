<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css"> 
    <script src="{{asset('/static/admin/js/jquery-3.1.1.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">    
    <title>文章标题添加</title>
</head>
<body>
<center><h3>文章标题添加</h3></center>
<form action="{{url('article/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">文章标题</label>
            <div class="col-sm-10">
                <input type="text" name="a_name" class="form-control" id="firstname"  placeholder="请输入文章标题">
                <b style="color:red">@php echo $errors->first('a_name');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">文章分类</label>
            <div class="col-sm-10">
               <select name="c_id">
                    <option value="">--请选择--</option>
                    @foreach($res as $v)
                        <option value="{{$v->c_id}}">{{$v->c_name}}</option>
                    @endforeach
               </select>
               <b style="color:red">@php echo $errors->first('c_id');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">文章作者</label>
            <div class="col-sm-10">
               <input type="text" name="a_passage" class="form-control" id="lastname" placeholder="请输入文章作者">
               <b style="color:red">@php echo $errors->first('a_passage');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">文章重要性</label>
            <div class="col-sm-10">
               <input type="radio" name="a_pop" value="1">普通
               <input type="radio" name="a_pop" value="2">置顶
               <b style="color:red">@php echo $errors->first('a_pop');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">是否展示</label>
            <div class="col-sm-10">
               <input type="radio" name="a_opp" value="1">显示
               <input type="radio" name="a_opp" value="2">不显示
               <b style="color:red">@php echo $errors->first('a_opp');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">作者email</label>
            <div class="col-sm-10">
               <input type="text" name="a_email" class="form-control" id="lastname" placeholder="请输入作者邮箱">
               <b style="color:red">@php echo $errors->first('a_email');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">关键字</label>
            <div class="col-sm-10">
               <input type="text" name="a_first" class="form-control" id="lastname" placeholder="请输入关键字">
               <b style="color:red">@php echo $errors->first('a_first');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">网页描述</label>
            <div class="col-sm-10">
               <textarea name="a_desc" cols="25px" rows="7px"></textarea>
               <b style="color:red">@php echo $errors->first('a_desc');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">上传文件</label>
            <div class="col-sm-10">
               <input type="file" name="a_file" class="form-control" id="lastname">
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
        $("#firstname").blur(function(){
            var a_name=$(this).val();
            var reg=/^[A-Z0-9_\u4e00-\u9fa5]+$/;
            if(!reg.test(a_name)){
                $(this).next().text('文章标题需以中文字母数字下划线');
                return;
            }
        })
    </script>
</html>