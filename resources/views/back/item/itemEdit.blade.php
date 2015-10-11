@extends('template')

@section('title','編輯商品')

@section('link')
<link href="/css/back/metisMenu.css" rel="stylesheet">
<link href="/css/back/sb-admin-2.css" rel="stylesheet">
<link href="/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet">
<link href="/select2-4.0.0/css/select2.min.css" rel="stylesheet">
@endsection

@section('body')
<div id="wrapper">
@include('back.partial.nav')

<div id="page-wrapper">
@include('errors.formError')
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">編輯商品</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Basic Form Elements
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    {!! Form::model($item,['url'=>'back/item/'.$item->id,'files' => true,'method' => 'put']) !!}
                                        <div class="form-group">
                                            <label>名稱</label>
                                            {!! Form::text('title',null,['class'=>'form-control','required'=>'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label>簡介</label>
                                            {!! Form::textarea('summary',null,['class'=>'form-control','rows'=>'5']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label>內容</label>
                                            {!! Form::textarea('content',null,['class'=>'form-control','rows'=>'20']) !!}
                                        </div>

                                        <div class="form-group">
                                            <label>類別</label>
                                            {!! Form::select('category_list[]',$categories,null,['class'=>'form-control category','multiple'=>'multiple','required'=>'required']) !!}
                                        <div class="form-group">
                                            <label>商品圖片</label>
                                            {!! Form::file('image', null, ['class'=>'form-control','required'=>'required']) !!}
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label>價錢</label>
                                            {!! Form::number('price',null,['class'=>'form-control','required'=>'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label>是否發布</label>
                                            {!! Form::checkbox('published','1',$item->published,['class'=>'form-control']) !!}
                                        </div>
                                    {!! Form::submit('確認修改',['class'=>'btn btn-primary btn-lg btn-block']) !!}
                                    {!! Form::close() !!}
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
<script src="/tinymce/tinymce.min.js"></script>
<script src="/tinymce/tinymce_editor.js"></script>
<script src="/select2-4.0.0/js/select2.min.js"></script>
<script type="text/javascript">
    editor_config.selector = "textarea";
    editor_config.path_absolute = "/";
    tinymce.init(editor_config);

    $(function() {
        $(".category").select2({
            placeholder: "添加類別"
        });
    });
</script>
@endsection