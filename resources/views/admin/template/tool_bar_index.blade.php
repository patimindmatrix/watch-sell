<div class="tool-bar">
    <div class="row">
        <div class="col-md-6">
            @can($controllerName . ".create")
                <a href="{{ route("admin." . $controllerName . ".create") }}" class="">
                    <button type="button" class="btn btn-primary">
                        <span><i class="fa fa-plus"></i> Tạo mới</span>
                    </button>
                </a>
            @endcan
{{--            @can($controllerName . ".delete")--}}
{{--                <a href="#" class="">--}}
{{--                    <button type="button" class="btn btn-danger">--}}
{{--                        <span><i class="fa fa-trash"></i> Xóa</span>--}}
{{--                    </button>--}}
{{--                </a>--}}
{{--            @endcan--}}
{{--            @if(\Route::has('admin.' . $controllerName . ".ordering" ))--}}
{{--                <a href="javascript:ordering('{{ route('admin.' . $controllerName . ".ordering" ) }}')">--}}
{{--                    <button type="button" class="btn btn-warning">--}}
{{--                        <span><i class="fa fa-circle"></i> Thứ tự</span>--}}
{{--                    </button>--}}
{{--                </a>--}}
{{--            @endif--}}
        </div>

        {{--        <div class="col-md-6">--}}
        {{--            <div class="group-search text-right">--}}
        {{--                <div class="dropdown box-search" style="display: inline-block">--}}
        {{--                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">--}}
        {{--                        {{ $params['search_list'][$params['search_type']] }}--}}

        {{--                        <span class="caret"></span></button>--}}
        {{--                    <ul class="dropdown-menu">--}}
        {{--                        @foreach($searchList as $k => $v)--}}
        {{--                            <li><a onclick="changeSearch(this,'{{ $k }}', '{{ $v }}')" href="javascript:void(0)">{{ $v }}</a></li>--}}
        {{--                        @endforeach--}}
        {{--                    </ul>--}}
        {{--                </div>--}}
        {{--                <input value="{{ $params['search_value'] }}" name="search_value" placeholder="search..." style="width: initial; display: inline-block" type="text" rows="2"  class="form-control" />--}}
        {{--                <a onclick="searchAction()" href="javascript:void(0)" class="btn btn-primary">Search</a>--}}
        {{--                <a onclick="clearSearchAction()" href="javascript:void(0)" class="btn btn-default">Clear</a>--}}
        {{--            </div>--}}
        {{--        </div>--}}

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
