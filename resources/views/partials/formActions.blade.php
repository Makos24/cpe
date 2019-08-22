@if(Auth::user()->level == 1)
<div class="row justify-content-center">


    @if($restoreUrl === 0)
    <a href="{!! $viewUrl !!}" target="_blank" class="btn btn-primary" style="margin-right: 5px" role="button" aria-pressed="true">
        <span class="fa fa-eye"></span>
        View</a>
    @if($c === null)
    <form action="{!! $confirmUrl !!}" method="POST" id="cForm">
        {{ csrf_field() }}
        <button type="button" class="btn btn-success" id="btn-confirm-user">
            <span class="fa fa-check-circle"></span>
            Confirm</button>
    </form>
    @endif
        <form action="{!! $deleteUrl !!}" method="POST" id="dForm">
        {{ csrf_field() }}
        <button type="button" class="btn btn-danger" id="btn-delete-user">
            <span class="fa fa-trash"></span>
            Delete</button>
    </form>
    @else

        <form action="{!! $restoreUrl !!}" method="POST" id="rForm">
            {{ csrf_field() }}
            <input type="hidden" value="{{$id}}" name="id">
            <button type="button" class="btn btn-success" style="margin-right: 5px"
                   id="btn-restore-user" role="button" aria-pressed="true">
                <span class="fa fa-recycle"></span>
                Restore</button>
        </form>

    @endif

</div>
@endif