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
    <button class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-shopping-cart"></span>結帳</button>
</div>