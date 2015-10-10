@extends('template')

@section('meta')
<meta name="csrf-token" content="<?php echo csrf_token()?>">
@endsection
@section('title')
Yida商城-{{ $item->title }}
@endsection

@section('link')
<link href="/css/front/shop-item.css" rel="stylesheet">
@endsection

@section('body')

@include('front.partial.nav')
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">Shop Name</p>
                <div class="list-group">
                @foreach($categories as $category)
                    <a href="/{{ $category->category }}" class="list-group-item">{{ $category->category }}</a>
                @endforeach
                </div>
            </div>

            <div class="col-md-9">

                <div class="thumbnail">
                    <img class="img-responsive" src="/filemanager/userfiles/itemImage/{{ $item->id.'.jpg' }}" style="width:800px;height:300px" alt="">
                    <div class="caption-full">
                        <h4 class="pull-right">$ {{ $item->price }}</h4>
                        <h4><a href="#">{{ $item->title }}</a>
                        </h4>
                        {!! $item->content !!}
                    </div>
                    <div class="ratings">
                        <p class="pull-right">3 reviews</p>
                        <p>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            4.0 stars
                        </p>
                    </div>
                </div>

                <div class="well">
                    @if(Auth::guest())
                    <div class="alert alert-warning">
                    <a href="{{ url('/auth/login') }}"><strong>評論請先登入</strong></a>
                    </div>
                    @else
                    <div>
                    <label>{{ Auth::user()->name }} :</label>
                    <input name="content" type="text" class="form-control" placeholder="ajax評論">
                        <button class="review btn btn-success btn-block">留下評論</button>
                    </div>
                    @endif

                    @foreach($item->reviews as $review)
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                        {{ $review->user->name }}&nbsp;&nbsp;
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="pull-right">
                            {{ $review->created_at->format('Y-m-d H:i') }}</span>
                            <p>{{ $review->content }}</p>
                        </div>
                    </div>
                    @endforeach
                    <div class="review"></div>

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->
@include('front.partial.footer')

@endsection

@section('script')
<script>
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("button.review").click(function(){
        var input = $('input[name=content]').val();
        if(input){
        $.ajax({
            url: '/storeReview',
            type: 'POST',
            data: "content=" + input + "&user_id=@if(Auth::check()){{ Auth::user()->id }}@endif"
                    +  "&item_id={{ $item->id }}"
        })
        .done(function(data) {
            $('input[name=content]').val('');
            $('div.review:last-child').after('<hr><div class="row review"><div class="col-md-12">'+data.user+'&nbsp;&nbsp;<span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="pull-right">'+data.time+'</span><p>'+data.content+'</p></div></div>');



        })
        .fail(function() {
            alert('發布評論失敗');
        });
        } else {
            alert("請輸入內容");
        }
    });

});
</script>
@endsection