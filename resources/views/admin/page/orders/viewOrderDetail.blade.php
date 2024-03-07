@extends("admin.layout")
@section("content_main")
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-dark">
                <div class="box-body">
                    @include("admin.template.notify")
                    <div class="order-details">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-uppercase mt-3 mb-3">Thông tin đơn hàng</h6>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="td-label">Mã</td>
                                            <td>#{{ @$order -> id }}</td>
                                        </tr>
                                        <tr>
                                            <td class="td-label">Thời gian</td>
                                            <td>{{ date_format(@$order -> updated_at, "H:i:s d/m/Y") }}</td>
                                        </tr>
                                        <tr>
                                            <td class="td-label">Phương thức thanh toán</td>
                                            <td>{{ @$order -> pay_method }}</td>
                                        </tr>
                                        <tr>
                                            <td class="td-label">Tổng đơn hàng</td>
                                            <td>{{ number_format(@$order -> price_total) }} VND</td>
                                        </tr>
                                        <tr>
                                            <td class="td-label">Giảm giá</td>
                                            <td>
                                                @if(isset($order_coupon))
                                                    {{ number_format($order_coupon) }} VND
                                                @else
                                                    0 VND
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-label">Tổng thanh toán</td>
                                            <td>{{ number_format( @$order -> price_total - $order_coupon )}} VND</td>
                                        </tr>
                                        <tr>
                                            <td class="td-label">Trạng thái</td>
                                            <td>
                                                <label class="label mr-3 text-dark text-bold" style="font-size: 16px">
                                                    {{ @$order -> status }}
                                                </label>
                                                <a href="" data-toggle="modal" data-target="#updateStatus">Cập nhật</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6">
                                <h6 class="text-uppercase mt-3 mb-3">Thông tin khách hàng</h6>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="td-label">Họ và tên</td>
                                            <td>{{ @$user -> user_name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="td-label">Email</td>
                                            <td>{{ @$user -> email }}</td>
                                        </tr>
                                        <tr>
                                            <td class="td-label">Số điện thoại</td>
                                            <td>{{ @$user -> phone }}</td>
                                        </tr>
                                        <tr>
                                            <td class="td-label">Ngày sinh</td>
                                            <td>{{ @$user -> date }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="order-address">
                        <h6 class="text-uppercase mt-3 mb-3">Thông tin nhận hàng</h6>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Tên</th>
                                    <th>Điện thoại</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Phường\Xã</th>
                                    <th>Quận\Huyện</th>
                                    <th>Phường\Xã</th>
                                </tr>
                                <tr>
                                    <td>{{ @$order_address -> name }}</td>
                                    <td>{{ @$order_address -> phone }}</td>
                                    <td>{{ @$order_address -> email }}</td>
                                    <td>{{ @$order_address -> home_address }}</td>
                                    <td>{{ @$order_address -> ward }}</td>
                                    <td>{{ @$order_address -> district }}</td>
                                    <td>{{ @$order_address -> province }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="order-detail">
                        <h6 class="text-uppercase mt-3 mb-3">Danh sách đơn hàng cần vận chuyển</h6>
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Ảnh</th>
                                <th style="width: 500px">Tên</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng giá</th>
                            </tr>

                            @foreach($order_details as $item)
                                <tr>
                                    <td>
                                        <img src="{{ \App\Helper\Functions::getImage("product", @$item -> product_picture, "thumbnail") }}" alt="{{ @$item -> product_name }}">
                                    </td>
                                    <td>{{ @$item -> product_name }}</td>
                                    <td>{{ number_format(@$item -> product_price) }} VND</td>
                                    <td>{{ @$item -> product_quantity }}</td>
                                    <td>{{ number_format(@$item -> price_total) }} VND</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <a href="{{ route("admin.order.index") }}" class="btn btn-info">Trở về</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Status Modal -->
    <div class="modal" id="updateStatus">
        <div class="modal-dialog">
            <form action="{{ route("admin.order.changeStatus", ['id' => @$order -> id]) }}" method="POST">
                @csrf
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Cập nhật trạng thái đơn hàng</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group pure-checkbox">
                            <input type="radio" name="status" id="processing" value="Đang xử lý">
                            <label for="processing">Đang xử lý</label>
                        </div>
                        <div class="form-group pure-checkbox">
                            <input type="radio" name="status" id="deleted" value="Đang giao hàng">
                            <label for="deleted">Đang giao hàng</label>
                        </div>
                        <div class="form-group pure-checkbox">
                            <input type="radio" name="status" id="done" value="Hoàn tất">
                            <label for="done">Hoàn tất</label>
                        </div>
                        <div class="form-group pure-checkbox">
                            <input type="radio" name="status" id="deleted" value="Hủy">
                            <label for="deleted">Hủy</label>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
