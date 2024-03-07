@extends("admin.layout")
@section("content_main")
    <div class="row">
        <div class="col-lg-12">
            <h3 class="mb-5">Mã đơn nhập: <span class="text-info">{{ $invoice->name }}</span></h3>
            <div class="box box-dark">
                <div class="box-body">
                    <div class="order-detail">
                        <h6 class="text-uppercase mt-3 mb-3 font-weight-bold">Danh sách sản phẩm của đơn nhập</h6>
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Ảnh</th>
                                <th style="width: 500px">Tên</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                            </tr>

                            @foreach($invoiceDetail as $item)
                                <tr>
                                    <td class="show-image">
                                        <img src="{{ \App\Helper\Functions::getImage("product", @$item->product->picture, "thumbnail") }}" alt="{{ @$item->product->name }}">
                                    </td>
                                    <td>{{ @$item->product->name }}</td>
                                    <td>{{ number_format(@$item->price) }} VND</td>
                                    <td>{{ @$item->amount }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <a href="{{ route("admin.invoices.index") }}" class="btn btn-info">Trở về</a>
                </div>
            </div>
        </div>
    </div>
@stop
