@extends('template')

@section('title','管理後台')

@section('link')
<link href="/css/back/metisMenu.css" rel="stylesheet">
<link href="/css/back/sb-admin-2.css" rel="stylesheet">
<link href="/css/back/font-awesome.min.css" rel="stylesheet">
@endsection

@section('body')
<div id="wrapper">
@include('back.partial.nav')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">標籤列表</h1>
                </div>
            </div>
 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Kitchen Sink
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>標籤名</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->category }}</td>
                                            <td><a href="/back/category/{{$category->id}}/edit" type="button" class="btn btn-info">修改名稱</a> <form action="{{ URL('back/category/'.$category->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('確定要刪除標籤嗎? 操作無法復原!');">
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}"><button type="submit" class="btn btn-danger">刪除標籤</button></form></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->

            </div>

</div>
</div>
@endsection

@section('script')
<script src="/js/back/metisMenu.js"></script>
<script src="/js/back/sb-admin-2.js"></script>
@endsection