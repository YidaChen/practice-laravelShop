@extends('template')

@section('title','添加管理員')

@section('link')
<link href="/css/back/metisMenu.css" rel="stylesheet">
<link href="/css/back/sb-admin-2.css" rel="stylesheet">
<link href="/css/back/font-awesome.min.css" rel="stylesheet">
@endsection

@section('body')
<div id="wrapper">
@include('back.partial.nav')

<div id="page-wrapper">
@include('errors.formError')
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">編輯管理員</h1>
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
                                    <form action="{{ URL('back/admin') }}" method="POST" role="form">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                                        <div class="form-group">
                                            <label>姓名</label>
                                            <input type="text" name="name" value="{{ old('name') }}" required class="form-control">

                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" value="{{ old('email') }}" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>密碼</label>
                                            <input type="password" name="password" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>確認密碼</label>
                                            <input type="password" name="password_confirmation" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>權限</label>
                                            <select class="form-control" name="role_id" required>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->title }}</option>
                                            @endforeach
                                            </select>
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