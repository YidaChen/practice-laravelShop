@extends('template')

@section('title','Yida商城')

@section('link')

@endsection

@section('body')
@include('front.partial.analyticstracking')
@include('front.partial.nav')

<br>
<br>
<h2 class="text-center"><span class="glyphicon glyphicon-ok"></span>您的訂單已成立，可至<a href="/user/index">會員專區</a>查看</h2>

@include('front.partial.footer')
@endsection

@section('script')
<script>

</script>
@endsection