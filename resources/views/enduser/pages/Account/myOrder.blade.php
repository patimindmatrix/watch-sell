<h3 class="layout-title">Đơn hàng của tôi</h3>
<div class="user-layout-table">
    @if(count($orders) <= 0)
        <div class="empty-order">
            <div class="empty-order-img"></div>
            <span>Chưa có đơn hàng</span>
        </div>
    @else
        <table class="my-course-table">
        <thead>
            <tr>
                <td class="col-center nowrap">STT</td>
                <td class="col-center nowrap">Mã</td>
                <td class="col-center nowrap">Thời gian</td>
                <td class="col-center nowrap">Trạng thái</td>
            </tr>
        </thead>
        <tbody>
            @foreach(@$orders as $count => $item)
                <tr>
                    <td class="col-center">{{ $count + 1 }}</td>
                    <td class="col-id col-center">
                        <a href="{{ route("user_profile.orderDetail", ['id' => $item -> id]) }}">#{{ $item -> id }}</a>
                    </td>
                    <td class="col-center nowrap">{{ date_format($item -> updated_at,"d/m/Y H:i:s") }}</td>
                    <td class="tags">
                        <div class="tag-group d-flex flex-wrap justify-content-center">
                            @switch($item->status)
                                @case("Hoàn tất")
                                    <span class="tag-item bg-success text-white" style="font-size: 12px">{{ $item -> status }}</span>
                                @break
                                @case("Đang giao hàng")
                                <span class="tag-item bg-info text-white" style="font-size: 12px">{{ $item -> status }}</span>
                                @break
                                @case("Đang xử lý")
                                    <span class="tag-item bg-primary text-white" style="font-size: 12px">{{ $item -> status }}</span>
                                @break
                                @case("Hủy")
                                    <span class="tag-item bg-danger text-white" style="font-size: 12px">{{ $item -> status }}</span>
                                @break
                            @endswitch
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

@include("enduser.components.pagination", ["pagination" => $orders])

<style>
    .empty-order-img{
        background-position: 50%;
        background-size: contain;
        background-repeat: no-repeat;
        width: 100px;
        height: 100px;
        background-image: url({{ asset("picture/don-hang.png") }});
    }
</style>
