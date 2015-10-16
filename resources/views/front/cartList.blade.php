@extends('template')
@section('meta')
<meta name="csrf-token" content="<?php echo csrf_token()?>">
@endsection
@section('title','Yida商城')

@section('link')

@endsection

@section('body')
@include('front.partial.nav')
@include('flash')
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading"><strong>您的購物車清單</strong></div>
                  <table class="table table-hover">
                    <thead>
                        <th>商品</th>
                        <th>數量</th>
                        <th>單價</th>
                        <th>總價</th>
                    </thead>
                    <tbody>
                    @foreach($carts as $cart)
                    <tr>
                        <td><a class="removeItem btn btn-xs" itemId='{{$cart[0]["item_id"]}}'><span class="glyphicon glyphicon-remove" style="color:red"></span></a> <a  href="/item={{$cart[0]['item_id']}}">{{App\Item::find($cart[0]["item_id"])->title}}</a></td>
                        <td>{{ $cart[0]["quantity"] }}</td>
                        <td>$ {{ $cart[0]["price"] }}</td>
                        <td class="price">{{ $cart[0]["quantity"] * $cart[0]["price"] }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><strong>合計: </strong></td>
                        <td><strong>$ <span id="totalPrice"></span></strong></td>
                    </tr>
                    <tr>
                        <td><a href="/" type="button" class="btn btn-default"><span class="glyphicon glyphicon-shopping-cart"></span> 繼續購物</a></td>
                        <td></td>
                        <td>付款方式:</td>
                        <td><a type="button" id="pod" class="btn btn-success">貨到付款 <span class="glyphicon glyphicon-triangle-bottom"></a></td>
                    </tr>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
        <div id="form" class="row" style="display:none">
                <div class="col-lg-12">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <strong>收件人資料:</strong>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="/order/checkout" method="POST" role="form">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="pay_id" value="1">
                                    <input type="hidden" name="total_price" value="">
                                        <div class="form-group">
                                            <label>姓名</label>
                                            <input type="text" name="addressee" value="{{ old('addressee') }}" required class="form-control">

                                        </div>
                                        <div class="form-group">
                                            <label>手機</label>
                                            <input type="text" name="phone" value="{{ old('phone') }}" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>市話</label>
                                            <input type="text" name="local_calls" value="{{ old('local_calls') }}" class="form-control" placeholder="選填">
                                        </div>
                                        <div class="form-group">
                                            <label>郵遞區號 <a href="http://www.post.gov.tw/post/internet/Postal/index.jsp?ID=208" target="_blank">請參考</a></label>
                                            <input type="text" name="postal_code" required value="{{ old('postal_code') }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>地址</label>
                                            <input type="text" name="address" required value="{{ old('address') }}" class="form-control">
                                        </div>

                                    <button type="submit" class="btn btn-warning btn-lg btn-block">確定送出</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <!-- /.container -->
@include('front.partial.footer')
@endsection

@section('script')
<script>
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var sum = 0;
    $('.price').each(function() {
        sum += Number($(this).text());
    });
    var totalPrice = $('#totalPrice').text(sum);
    $('input[name="total_price"]').val(totalPrice.text());

    $("a.removeItem").click(function(){
        var itemId = $(this).attr("itemId");
        var item = $(this).parentsUntil("tbody");
        $.ajax({
            url: '/cart/removeItem',
            type: 'POST',
            data: "item_id=" + itemId
        })
        .done(function(data) {
            item.remove();
            if(data){
                alert(data);
                window.location.replace("/");
            }
            var sum = 0;
            $('.price').each(function() {
                sum += Number($(this).text());
            });
            var totalPrice = $('#totalPrice').text(sum);
            $('input[name="total_price"]').val(totalPrice.text());
        })
        .fail(function() {
            alert('操作失敗');
        });
    });
    $('#pod').click(function(){
        $('#form').toggle(800);
    });
});
</script>
@endsection