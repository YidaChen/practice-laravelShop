@extends('template')

@section('meta')
<meta name="csrf-token" content="<?php echo csrf_token()?>">
@endsection
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
                    <h1 class="page-header">商品列表</h1>
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
                                            <th>商品ID</th>
                                            <th>商品名稱</th>
                                            <th>發佈作者</th>
                                            <th>價錢</th>
                                            <th>發布</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td><a href="">{{ $item->title }}</a></td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{!! Form::checkbox('published',$item->id,$item->published) !!}</td>
                                            <td><a href="/back/item/{{$item->id}}/edit" type="button" class="btn btn-sm btn-info">修改資料</a> <form action="{{ URL('back/item/'.$item->id) }}" method="POST" style="display: inline;">
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}"><button type="submit" class="btn btn-sm btn-danger">刪除商品</button></form></td>
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
<script>
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(':checkbox[name="published"]').change(function(){
        $(this).hide().parent().append('<i class="fa fa-refresh fa-spin"></i>');
        $.ajax({
            url: '/back/item/updatePublished/' + this.value,
            type: 'PUT',
            data: "published=" + this.checked// + "&_method=PUT"
        })
        .done(function() {
            $('.fa-spin').remove();
            $('input:checkbox[name="published"]:hidden').show();
        })
        .fail(function() {
            $('.fa-spin').remove();
            chk = $('input:checkbox[name="published"]:hidden');
            chk.show().prop('checked', chk.is(':checked') ? null:'checked')
        });
    });

});
</script>
@endsection