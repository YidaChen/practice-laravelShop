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
                    <h3 class="panel-title"><strong>會員: {{ $user->name }} 您好</strong></h3>
                </div>
                <div class="panel-body">
                    <p><a href="/user/order"><span class="glyphicon glyphicon-list-alt"></span> 訂單查詢</a></p>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
@include('front.partial.footer')
@endsection

@section('script')
<script>

</script>
@endsection