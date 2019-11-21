@extends('layouts.shop')
@section('title', '全国最大珠宝商')
@section('content')

<body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">3</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
     <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" class="check1" name="1" /> 全选</a></td>
     @foreach($Info as $v)
     <div class="dingdanlist">
      <table>
        <tr goods_id="{{$v->goods_id}}">
            <td><a href="javascript:;" class="del">删除</a></td>
            <td width="4%"><input type="checkbox" class="check2" name="1" /></td>
            <td class="dingimg" width="15%"><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" /></td>
            <td width="50%">
              <h3>{{$v->goods_name}}</h3>
              <time>下单时间：{{date("Y-m-d H:i:s",$v->add_time)}}</time>
            </td>
            <td align="right">
                <!-- <input type="text" class="spinnerExample" /> -->
                <button style="width:25px;" class="jian" id="jian">-</button>
                <input type="text" style="width:70px;text-align:center;" value="{{$v->buy_number}}" class="inp" id="inp">
                <button style="width:25px;" class="jia" id="jia">+</button>            
            </td>
            <input type="hidden" class="goods_num" value="{{$v->goods_num}}">
          </tr>
        <tr>
            <th colspan="4"><strong class="orange">¥{{$v->goods_price*$v->buy_number}}</strong></th>
        </tr>
      </table>
     </div>
     @endforeach
     
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总 价: <strong class="count" id="count">¥0</strong></td>
       <td width="40%"><a href="{{url('index/pay')}}" class="jiesuan">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->

  <script src='/static/admin/js/jquery-3.1.1.min.js'></script>
  <script>
      $(document).ready(function(){
         
         /*点击全选*/
          $(document).on('click',".check1",function(){
              var _this=$(this);
              var checked=_this.prop('checked');
              $('.check2').prop('checked',checked);
             
              count();
              xiaoji();
              changeNum(goods_id,buy_number);
          })

          /*点击减号*/
          $(document).on('click',".jian",function(){
               var _this=$(this);
               var goods_id=_this.parents("tr").attr("goods_id");
               var buy_number=parseInt(_this.next('.inp').val());
               
               if(buy_number<=1){
                    _this.next('.inp').val(1);
               }else{
                  buy_number=buy_number-1;
                  _this.next('.inp').val(buy_number);
               }
               count();
               xiaoji(goods_id,_this,buy_number);
               changeNum(goods_id,buy_number);
          })
          /*点击加号*/
          $(document).on('click',".jia",function(){
               var _this=$(this);
               var goods_id=_this.parents("tr").attr("goods_id");
               var buy_number=parseInt(_this.prev('.inp').val());
               var goods_num=$(this).parent().next().val();//获取库存
               
               if(buy_number>=goods_num){
                    _this.prev('.inp').val(goods_num);
               }else{
                  buy_number=buy_number+1;
                  _this.prev('.inp').val(buy_number);
               }
               count();
               xiaoji(goods_id,_this);
               changeNum(goods_id,buy_number);
          });
         /*数量框*/
          $(document).on('blur','.inp',function(){
              var _this=$(this);
              var goods_id=_this.parents('tr').attr('goods_id');
              
              var buy_number=parseInt($(this).val());
              var goods_num=_this.parent().next().val();//库存
              var number=/^\d+$/;
              if(parseInt(buy_number)>=goods_num){
                  _this.val(goods_num);
              }else if(!number.test(buy_number)||parseInt(buy_number)<=0){
                  _this.val(1);
              }else{
                  _this.val(buy_number);
              }
                 count();
                 xiaoji(goods_id,_this);
                 changeNum(goods_id,buy_number);
            });

            /*重新获取小计*/
            function xiaoji(goods_id,_this,buy_number){
                $.ajaxSetup({
                     headers: {'X-CSRF-TOKEN':'{{csrf_token()}}'}
                });
                $.ajax({
                     url:"{{url('/index/xiaoji')}}",
                     method:'post',
                     data:{goods_id:goods_id,buy_number:buy_number},
                    //  async:false,
                }).done(function(res){
                    //  console.log(res);
                     _this.parents('tr').next().find('.orange').text('¥'+res);
                });
            }
            /*获取购买数量*/
            function changeNum(goods_id,buy_number){
                $.post(
                    "{{url('index/change')}}",
                    {goods_id:goods_id,buy_number:buy_number},
                    function(res){
                        if(res==2){
                            alert('购买数量修改失败');
                        }
                    }
                )
            }
         /*重新获取总价*/
            function count(){
                var _box=$(".check2:checked");
                var goods_id="";
                _box.each(function(index){
                    goods_id+=$(this).parents('tr').attr('goods_id')+',';
                });
                // console.log(count);
                goods_id=goods_id.substr(0,goods_id.length-1);

                $.post(
                    "{{url('index/count')}}",
                    {goods_id:goods_id,_token:"{{csrf_token()}}"},
                    function(res){
                        // console.log(res);
                        $('.count').text('¥'+res);
                    }
                )
            }
        /*删除*/
        $(document).on('click',".del",function(){
            var _this=$(this);
            var goods_id=_this.parents("tr").attr("goods_id");
            $.post(
                "{{url('index/cartdel')}}",
                {goods_id:goods_id,_token:"{{csrf_token()}}"},
                function(res){
                    if(res==1){
                        _this.parents("tr").remove();
                        // count();//重新获取总价
                    }else{
                        alert('删除失败');
                    }
                }
            )
        })

    })
  </script>
    @endsection