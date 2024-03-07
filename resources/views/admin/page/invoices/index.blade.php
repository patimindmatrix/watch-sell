@extends("admin.layout")
@section("content_main")
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-dark">
                <div class="box-body">
                    @include("admin.template.notify")
                    <div class="sc-table">
                        <div class="tool-bar">
                            <div class="row">
                                <div class="col-md-6">
                                    @can($controllerName . ".create")
                                        <a href="{{ route("admin." . $controllerName . ".create", ['type' => 'old']) }}" class="">
                                            <button type="button" class="btn btn-primary">
                                                <span><i class="fa fa-plus"></i> Tạo đơn hàng cũ</span>
                                            </button>
                                        </a>

                                        <a href="{{ route("admin." . $controllerName . ".create", ['type' => 'new']) }}" class="">
                                            <button type="button" class="btn btn-info">
                                                <span><i class="fa fa-plus"></i> Tạo đơn hàng mới</span>
                                            </button>
                                        </a>
                                    @endcan
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <!-- Navbar Search-->
                                    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0 form-search">
                                        <div class="input-group">
                                            <input class="form-control"
                                                   type="text"
                                                   value="{{ request()->get('search-key') }}"
                                                   placeholder="Tìm kiếm theo tên"
                                                   aria-label="Search"
                                                   aria-describedby="basic-addon2"
                                                   name="search-key"/>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @include("admin.page.invoices.list")
                    </div>
                    @include("admin.template.pagination", ["pagination" => $data])
                </div>
            </div>
        </div>
    </div>
@stop
