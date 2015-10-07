@extends('template')

@section('title','Yida商城-註冊會員')


@section('body')

@include('front.partial.nav')
@include('errors.formError')
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            會員註冊
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="/auth/register" method="POST" role="form">
                                    {!! csrf_field() !!}
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

@include('front.partial.footer')

@endsection