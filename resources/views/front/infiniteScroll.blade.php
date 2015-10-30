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
            <div class="col-md-12">
                <div class="row" id="itemList">
                    @foreach($items as $item)
                    <div class="col-sm-12 col-lg-12 col-md-12 item">
                        <div class="thumbnail">
                            <a href="/item={{ $item->id }}"><img src="/filemanager/userfiles/itemImage/{{ $item->id.'.jpg' }}" style="width:100%;" alt=""></a>
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
<script src="/js/jquery.infinitescroll.min.js"></script>
<script>
$(function(){
    $('.pagination').css('display','none');
    $('#itemList').infinitescroll({
    navSelector  : '.pagination',
                   // selector for the paged navigation (it will be hidden)
    nextSelector : "a[rel='next']",
                   // selector for the NEXT link (to page 2)
    itemSelector : "#itemList div.item"
                   // selector for all items you'll retrieve
  });
});
</script>
@endsection