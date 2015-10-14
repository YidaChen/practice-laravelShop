@extends('template')

@section('title','Yida商城')

@section('link')
<link href="/css/front/shop-homepage.css" rel="stylesheet">
@endsection

@section('body')
@include('front.partial.analyticstracking')
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
                @if(isset($take3Items))
                <div class="row carousel-holder">
                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                            @foreach($take3Items as $item)
                                <div class="item">
                                    <a href="/item={{ $item->id }}"><img class="slide-image" src="/filemanager/userfiles/itemImage/{{ $item->id.'.jpg' }}" alt=""></a>
                                </div>
                            @endforeach
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    @foreach($items as $item)
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="/item={{ $item->id }}"><img src="/filemanager/userfiles/itemImage/{{ $item->id.'.jpg' }}" style="width:320px;height:150px" alt=""></a>
                            <div class="caption">
                                <h4 class="pull-right">$ {{ $item->price }}</h4>
                                <h4><a href="/item={{ $item->id }}">{{ $item->title }}</a>
                                </h4>
                                <p>{!! $item->summary !!}</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            {!! $items->render() !!}
            </div>
        </div>

    </div>
    <!-- /.container -->
@include('front.partial.footer')
@include('front.partial.cart')
@endsection

@section('script')
<script>
$(function(){
    $('div.item:first-child').addClass('active');
});
</script>
@endsection