@extends('template')
@section('meta')
<meta name="csrf-token" content="<?php echo csrf_token()?>">
@endsection
@section('title','Yida商城')

@section('link')

@endsection

@section('body')
@include('front.partial.nav')
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
                        <td></td>
                        <td></td>
                        <td><a href="/" type="button" class="btn btn-default"><span class="glyphicon glyphicon-shopping-cart"></span> 繼續購物</a></td>
                        <td><a type="button" class="btn btn-success">結帳 <span class="glyphicon glyphicon-play"></a></td>
                    </tr>
                    </tbody>
                  </table>
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
    $('#totalPrice').text(sum);

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
            $('#totalPrice').text(sum);
        })
        .fail(function() {
            alert('操作失敗');
        });
    });
});
</script>
@endsection