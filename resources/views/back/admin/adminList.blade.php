@extends('template')

@section('title','管理後台')

@section('link')
<link href="/css/back/metisMenu.css" rel="stylesheet">
<link href="/css/back/sb-admin-2.css" rel="stylesheet">
<link href="/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet">
<link href="/datatables/datatables.min.css" rel="stylesheet">
@endsection

@section('body')
<div id="wrapper">
@include('back.partial.nav')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">管理員列表</h1>
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
                            <div>
                                <table id="datatable" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>權限</th>
                                            <th>名字</th>
                                            <th>email</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->role->title }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td><a href="/back/admin/{{$user->id}}/edit" type="button" class="btn btn-info">修改資料</a> <form action="{{ URL('back/admin/'.$user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('確定要刪除用戶嗎? 操作無法復原!');">
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}"><button type="submit" class="btn btn-danger">刪除帳號</button></form></td>
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
<script src="/datatables/datatables.min.js"></script>
<script>
$(function(){
    $('#datatable').DataTable({
        responsive: true,
        "aaSorting": []
    });
});
</script>
@endsection