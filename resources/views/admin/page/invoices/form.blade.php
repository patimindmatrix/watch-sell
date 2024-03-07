@extends("admin.layout")
@section('content_main')
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-dark">
                <form
                    action="{{ route("admin." . $controllerName . ".store") }}" method="POST"
                    class="px-2 invoices-form">
                    @csrf
                    <div class="invoice-group my-4 d-flex flex-column">
                        <div class="d-flex justify-content-between header-invoice">
                            <h4 class="font-weight-bold mb-2 text-uppercase">Sản phẩm 1</h4>
                        </div>
                        <div class="card p-3">
                            <div class="row">
                                <div class="col-lg-3 mb-20">
                                    <div class="form-group">
                                        <label for="" class="mb-1 font-weight-bold">Nhà cung cấp</label>
                                        <select
                                            class="form-control form-checkout select-partner"
                                            name="partner_id[]"
                                        >
                                            <option value=" ">Chọn Nhà Cung Cấp</option>
                                            @foreach($partners as $item)
                                                <option value="{{ $item -> id }}">{{ $item -> name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-20">
                                    <div class="form-group">
                                        @if(str_contains(\Request::url(), 'old'))
                                            <input type="hidden" name="type" value="old">
                                            <label for="" class="mb-1 font-weight-bold">Sản phẩm</label>
                                            <select class="form-control form-checkout select-product" name="product_id[]">
                                            </select>
                                        @else
                                            <input type="hidden" name="type" value="new">
                                            <label for="" class="mb-1 font-weight-bold">Tên sản phẩm</label>
                                            <input type="text" class="form-control" name="name[]">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-20">
                                    <div class="form-group">
                                        <label for="" class="mb-1 font-weight-bold">Số lượng</label>
                                        <input type="number" name="amount[]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-20">
                                    <div class="form-group">
                                        <label for="" class="mb-1 font-weight-bold">Giá nhập</label>
                                        <input type="text" name="price[]" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body justify-content-end d-flex">
                        <button type="button" class="btn btn-info add-new-pd-for-invoice"
                                data-type="{{ str_contains(\Request::url(), 'old') ? 'old' : 'new'}}">
                            Thêm mới sản phẩm
                        </button>
                        <button type="submit" class="btn btn-success ml-2">Lưu</button>
                        <a class="btn btn-secondary ml-2" href="{{ route("admin." . $controllerName . ".index") }}">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
<style>
    .fa-trash {
        cursor: pointer;
        font-size: 25px;
        font-weight: bold;
    }
</style>
