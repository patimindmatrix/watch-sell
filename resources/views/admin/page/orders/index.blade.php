@extends("admin.layout")
@section("content_main")
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-dark">
                <div class="box-body">
                    @include("admin.template.notify")
                    <div class="sc-table">
                        @include("admin.template.tool_bar_index")
                        @include("admin.page.orders.list")
                    </div>
                    @include("admin.template.pagination", ["pagination" => $data])
                </div>
            </div>
        </div>
    </div>
@stop
