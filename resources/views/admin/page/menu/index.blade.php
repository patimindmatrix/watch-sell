@extends("admin.layout")
@section("content_main")
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-dark">
                <div class="box-body">
                    @include("admin.template.notify")
                    <div class="sc-table">
                        {!! Menu::render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    {!! Menu::scripts() !!}
@endpush

