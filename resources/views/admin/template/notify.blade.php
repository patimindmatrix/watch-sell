@if( session("action_success") )
    <div class="alert alert-success fade in alert-dismissible show" role="alert" style="background: #009225; border: #009225">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="font-size: 20px">x</span>
        </button>
        <strong style="color: #ffffff"> {{ session("action_success") }} </strong>
    </div>
@endif

@if( session("changePassword") )
    <div class="alert alert-success fade in alert-dismissible show" role="alert" style="background: #009225; border: #009225">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="font-size: 20px">x</span>
        </button>
        <strong style="color: #ffffff"> {{ session("changePassword") }} </strong>
    </div>
@endif

@if( session("login_failed") )
    <div class="alert alert-danger fade in alert-dismissible show" role="alert" style="background: #D11718; border: #D11718">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="font-size: 20px; color: white">x</span>
        </button>
        <strong style="color: #ffffff"> {{ session("login_failed") }} </strong>
    </div>
@endif
