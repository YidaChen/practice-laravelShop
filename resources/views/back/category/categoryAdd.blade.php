@extends('template')

@section('title','添加標籤')

@section('link')
<link href="/css/back/metisMenu.css" rel="stylesheet">
<link href="/css/back/sb-admin-2.css" rel="stylesheet">
<link href="/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet">
@endsection

@section('body')
<div id="wrapper">
@include('back.partial.nav')

<div id="page-wrapper">
@include('errors.formError')
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">新增標籤</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Basic Form Elements
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="{{ URL('back/category') }}" method="POST" role="form">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                                        <div class="form-group">
                                            <label>標籤名:</label>
                                            <input type="text" name="category" value="{{ old('category') }}" required class="form-control">
                                        </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">確認創建</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>

</div>
@endsection

@section('script')
<script src="/js/back/metisMenu.js"></script>
<script src="/js/back/sb-admin-2.js"></script>
@endsection