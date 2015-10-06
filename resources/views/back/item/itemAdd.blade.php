@extends('template')

@section('title','添加商品')

@section('link')
<link href="/css/back/metisMenu.css" rel="stylesheet">
<link href="/css/back/sb-admin-2.css" rel="stylesheet">
<link href="/css/back/font-awesome.min.css" rel="stylesheet">
<link href="/select2-4.0.0/select2.min.css" rel="stylesheet">
@endsection

@section('body')
<div id="wrapper">
@include('back.partial.nav')

<div id="page-wrapper">
@include('errors.formError')
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">新增商品</h1>
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
                                    {!! Form::open(['url'=>'/back/item','method' => 'POST', 'files' => true]) !!}
                                        <div class="form-group">
                                            <label>名稱</label>
                                            <input type="text" name="title" value="{{ old('title') }}" required class="form-control">

                                        </div>
                                        <div class="form-group">
                                            <label>簡介</label>
                                            <textarea name="summary" rows="5" class="form-control">{{ old('summary') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>內容</label>
                                            <textarea name="content" rows="20" class="form-control">{{ old('content') }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>類別</label>
                                            <select class="form-control category" name="category_list[]" required multiple="multiple">
                                            @foreach($categories as $id=>$category)
                                                <option value="{{ $id }}">{{ $category }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>商品圖片</label>
                                            {!! Form::file('image', null, ['class'=>'form-control','required'=>'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label>價錢</label>
                                            <input type="number" name="price" value="{{ old('price') }}" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>是否發布</label>
                                            <input type="checkbox" name="published" value="1" class="form-control">
                                        </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">確認創建</button>
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
<script src="/select2-4.0.0/select2.min.js"></script>
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