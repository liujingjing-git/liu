<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
    <script src="{{asset('/static/admin/js/jquery-3.1.1.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">    
    <title>分类添加</title>
</head>
<body>
<center><h3>分类添加</h3></center>
<form action="{{url('cate/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">分类名称</label>
            <div class="col-sm-10">
                <input type="text" name="cate_name" class="form-control" id="firstname"  placeholder="请输入分类名称">
                <b style="color:red">@php echo $errors->first('cate_name');@endphp</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">是否上架</label>
            <div class="col-sm-10">
               <input type="radio" name="cate_show" value="1" checked="checked">是
               <input type="radio" name="cate_show" value="2">否
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">是否在导航栏展示</label>
            <div class="col-sm-10">
               <input type="radio" name="cate_nav_show" value="1">是
               <input type="radio" name="cate_nav_show" value="2" checked="checked">否
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">父类</label>
            <div class="col-sm-10" >
            <select name="parent_id">
                <option value="">--请选择--</option>
                @foreach($data as $v)
                    <option value="{{$v->cate_id}}">{{str_repeat('--',$v['level'])}}{{$v->cate_name}}</option>
                @endforeach
            </select>            
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" id="submit" class="btn btn-default" value="提交">
            </div>
        </div>
</form>
</body>
    <script>
    // 分类名称验证
        $("#firstname").blur(function(){
            var cate_name=$(this).val();
            var reg=/^[\u2E80-\u9FFF]+$/;
            if(!reg.test(cate_name)){
                $(this).parent().addClass('has-error');
                $(this).next().text('分类名称不符合规范');
                return false;
            }else{
                return true;
            }
        })
    </script>
</html>