@extends('template')

@section('title','Yida商城')

@section('link')
@endsection

@section('body')
@include('front.partial.analyticstracking')
@include('front.partial.nav')
    <!-- Page Content -->
    <div class="container">

        <div class="row">
        <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>訂單列表</strong></h3>
                </div>
                <div class="panel-body">
                    <table class='table table-striped table-bordered table-hover'>
                <thead>
                    <th>編號</th>
                    <th>成立時間</th>
                    <th>商品總價</th>
                    <th>訂單狀態</th>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr data-toggle="modal" data-target="#myModal{{ $order->id }}">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td>$ {{ $order->total_price }}</td>
                        <td>{{ $order->orderStatus->status }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                </div>
            </div>
        </div>
                @foreach($orders as $order)
                <div class="modal fade" id="myModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">商品詳情:</h4>
                          </div>
                          <div class="modal-body">
                            <table class='table table-striped table-bordered table-hover'>
                                <thead>
                                <tr>
                                    <th>商品名稱</th>
                                    <th>數量</th>
                                    <th>價格</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->details as $detail)
                                <tr>
                                    <td><a href="/item={{ $detail->item->id }}" target="_blank">{{ $detail->item->title }}</a></td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>$ {{ $detail->price }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
    </div>
    <!-- /.container -->
@include('front.partial.footer')
@endsection

@section('script')
<script>

</script>
@endsection