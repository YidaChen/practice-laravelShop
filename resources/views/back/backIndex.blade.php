@extends('template')

@section('title','管理後台')

@section('link')
<link href="css/back/metisMenu.css" rel="stylesheet">
<link href="css/back/sb-admin-2.css" rel="stylesheet">
<link href="css/back/font-awesome.min.css" rel="stylesheet">
@endsection

@section('body')
<div id="wrapper">
@include('back.partial.nav')


</div>
@endsection

@section('script')
<script src="js/back/metisMenu.js"></script>
<script src="js/back/sb-admin-2.js"></script>
@endsection