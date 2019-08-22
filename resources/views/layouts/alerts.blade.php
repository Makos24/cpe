@if(Session::has('info'))
    <div class="alert alert-info" role="alert" id="info">
        {{Session::get('info')}}
    </div>
@elseif(Session::has('error'))
    <div class="alert alert-warning" role="alert" id="error">
        {{Session::get('error')}}
    </div>
@endif