<style type="text/css">
    #cart {
        position: fixed;
        right: 2px;
        bottom: 2px;
        @unless(Session::has('cart'))
        display: none;
        @endunless
    }
</style>
<div id="cart">
    <a href="/cart/show" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-shopping-cart"></span>結帳</a>
</div>