@extends('template')

@section('meta')
<meta name="csrf-token" content="<?php echo csrf_token()?>">
@endsection
@section('title','管理後台')

@section('link')
<link href="/css/back/metisMenu.css" rel="stylesheet">
<link href="/css/back/sb-admin-2.css" rel="stylesheet">
<link href="/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet">
<link href="/datatables/datatables.min.css" rel="stylesheet">
@endsection

@section('body')
<div id="wrapper">
@include('back.partial.nav')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">訂單列表</h1>
                </div>
            </div>
 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            訂單列表
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div>
                                <table id="datatable" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>編號</th>
                                            <th>用戶</th>
                                            <th>總價</th>
                                            <th>訂單狀態</th>
                                            <th>時間</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>$ {{ $order->total_price }}</td>
                                            <td id='{{ $order->id }}'>{{ $order->orderStatus->status }}</td>
                                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                            <td><button type="button" class="order_detail btn btn-info" order_id='{{ $order->id }}'>訂單詳情</button></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->

            </div>

</div>
</div>
<div class="modal fade" id="order_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">訂單編號: <span id="modal-title"></span></h4>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>商品</th>
                    <th>數量</th>
                    <th>價格</th>
                </tr>
            </thead>
            <tbody id="item-list">
            </tbody>
        </table>
        <form>
        <div class="form-group">
            <label for="message-text" class="control-label">付款方式:</label>
            <input type="text" class="form-control" name="pay_id" value="取貨付款" disabled>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">收件人:</label>
            <input type="text" class="form-control" name="addressee" disabled>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">手機:</label>
            <input type="text" class="form-control" name="phone" disabled>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">市話:</label>
            <input type="text" class="form-control" name="local_calls" disabled>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">郵遞區號:</label>
            <input type="text" class="form-control" name="postal_code" disabled>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">地址:</label>
            <textarea class="form-control" name="address" disabled></textarea>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">訂單狀態:</label>
            <select class="form-control" name="order_status_id">
            @foreach($orderStatuses as $orderStatus)
                <option value="{{ $orderStatus->id }}">{{ $orderStatus->status }}</option>
            @endforeach
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
        <button type="button" id="change-order-status" class="btn btn-primary">更改訂單狀態</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="/js/back/metisMenu.js"></script>
<script src="/js/back/sb-admin-2.js"></script>
<script src="/datatables/datatables.min.js"></script>
<script>
$(function(){
    $('#datatable').DataTable({
        responsive: true,
        "aaSorting": []
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#datatable tbody').on('click','button.order_detail', function () {
        var id = $(this).attr('order_id');
        $.ajax({
            url: '/back/order/' + id,
            type: 'POST'
        })
        .done(function(order) {
            $('span#modal-title').text(order.id);
            $('input[name="addressee"]').val(order.addressee);
            $('input[name="phone"]').val(order.phone);
            $('input[name="local_calls"]').val(order.local_calls);
            $('input[name="postal_code"]').val(order.postal_code);
            $('textarea[name="address"]').val(order.address);
            $('select[name="order_status_id"]').val(order.order_status_id);
            //for循環出商品列表
            for (var i = 0; i < order.detail.item_title.length; i++) {
                $("#item-list").append("<tr><td>"+ order.detail.item_title[i] +"</td><td>"+ order.detail.quantity[i] +"</td><td>$ "+ order.detail.price[i] +"</td></tr>");
            };
            $('#order_detail').modal();
        })
        .fail(function() {
            alert('操作失敗！');
        });
    });
    $('button#change-order-status').click(function(){
        var id = $('span#modal-title').text();
        var status_id = $('select[name="order_status_id"]').val();
        $.ajax({
            url: '/back/order/updateStatus/' + id,
            type: 'PUT',
            data: "order_status_id=" + status_id
        })
        .done(function(status) {
            $('#'+id).text(status);
            $('#order_detail').modal('hide');
        })
        .fail(function() {
            alert('操作失敗！');
        });
    });
    $('#order_detail').on('hidden.bs.modal', function () {
        $("#item-list").empty();
    })

});
</script>
@endsection