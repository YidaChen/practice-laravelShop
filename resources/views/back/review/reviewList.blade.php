@extends('template')

@section('meta')
<meta name="csrf-token" content="<?php echo csrf_token()?>">
@endsection
@section('title','管理後台')

@section('link')
<link href="/css/back/metisMenu.css" rel="stylesheet">
<link href="/css/back/sb-admin-2.css" rel="stylesheet">
<link href="/css/back/font-awesome.min.css" rel="stylesheet">
<link href="/css/back/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('body')
<div id="wrapper">
@include('back.partial.nav')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">評論列表</h1>
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

                                            <th>商品名稱</th>
                                            <th>評論內容</th>
                                            <th>評論人</th>
                                            <th>時間</th>
                                            <th>看過</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($reviews as $review)
                                        <tr>

                                            <td><a href="/item={{ $review->item->id }}" target="_blank">{{ $review->item->title }}</a></td>
                                            <td>{{ $review->content }}</td>
                                            <td>@if(isset($review->user->name)){{ $review->user->name }}@else用戶已刪除@endif</td>
                                            <td>{{ $review->created_at->format('Y-m-d H:i') }}</td>
                                            <td>{!! Form::checkbox('seen',$review->id,$review->seen) !!}</td>
                                            <td> <form action="{{ URL('back/review/'.$review->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('確定要刪除商品嗎? 操作無法復原!');">
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}"><button type="submit" class="btn btn-sm btn-danger">刪除評論</button></form></td>
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
<script src="/js/back/jquery.dataTables.min.js"></script>
<script>
$(function(){
    $('#datatable').DataTable({
        responsive: true
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#datatable tbody').on('change',':checkbox[name="seen"]', function () {
        $(this).hide().parent().append('<i class="fa fa-refresh fa-spin"></i>');
        $.ajax({
            url: '/back/review/updateSeen/' + this.value,
            type: 'PUT',
            data: "seen=" + this.checked// + "&_method=PUT"
        })
        .done(function() {
            $('.fa-spin').remove();
            $('input:checkbox[name="seen"]:hidden').show();
        })
        .fail(function() {
            $('.fa-spin').remove();
            chk = $('input:checkbox[name="seen"]:hidden');
            chk.show().prop('checked', chk.is(':checked') ? null:'checked')
        });
    });

});
</script>
@endsection