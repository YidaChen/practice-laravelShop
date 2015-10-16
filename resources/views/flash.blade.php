@if(Session::has('flash_message'))
    <div class="alert {{ Session::has('flash_message_important') ? 'alert-danger' : 'alert-success' }}">
            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('flash_message') }}
    </div>
@endif