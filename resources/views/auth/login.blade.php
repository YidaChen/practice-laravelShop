@extends('template')

@section('title','登入')

@section('link')
<link href="/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet">
<link href="/bootstrap-3.3.5/css/bootstrap-social.css" rel="stylesheet">
<style type="text/css">
    .login-panel {
        margin-top: 35px;
    }
</style>
@endsection

@section('body')
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">請先登入</h3>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="/auth/login" role="form">
                        {!! csrf_field() !!}
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" value="{{ old('email') }}" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <a href="{{ url('/auth/register') }}" class="pull-right">尚未註冊?</a>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                                <a href="/login/facebook" class="btn btn-block btn-social btn-facebook">
                                <i class="fa fa-facebook"></i>使用Facebook登入</a>
                            </fieldset>
                        </form>
                        @include('errors.formError')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection