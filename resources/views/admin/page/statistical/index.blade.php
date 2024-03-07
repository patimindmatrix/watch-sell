@php
    $currentDate = new \DateTime();
    $date_from = request('date_from') ? new \DateTime(request('date_from')) : $currentDate->modify('-7 day');
    $date_to = request('date_to') ? new \DateTime(request('date_to')) : new \DateTime();
@endphp
@extends("admin.layout")
@section("content_main")
    <form class="d-flex align-items-center">
        <div class="form-group mr-4">
            <label for="" class="font-weight-bold">Từ ngày</label>
            <input type="date" name="date_from" class="form-control" value="{{ $date_from->format('Y-m-d') }}">
        </div>
        <div class="form-group">
            <label for="" class="font-weight-bold">Đến ngày</label>
            <input type="date" name="date_to" class="form-control" value="{{ $date_to->format('Y-m-d') }}">
        </div>
        <button class="btn btn-success ml-4 mt-3" type="submit">Xác nhận</button>
    </form>
    <div class="row mt-5">
        <div class="col-6">
            <h3 class="text-center font-weight-bold mb-3">Thống kê doanh thu đơn hàng</h3>
            <canvas id="chart-price"></canvas>
        </div>
        <div class="col-6">
            <h3 class="text-center font-weight-bold mb-3">Thống kê số lượng đơn hàng</h3>
            <canvas id="chart-count"></canvas>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12 d-flex flex-column align-items-center" style="height: 400px !important;">
            <h3 class="text-center font-weight-bold mb-3">Thống kê trạng thái đơn hàng</h3>
            <canvas id="pie-chart"></canvas>
        </div>
    </div>
@stop
@push('scripts')
    <script>
        const ctx = document.getElementById('chart-price');
        const orderConfirmed = @json($orderConfirmed);
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: orderConfirmed.map(d => d.date.substring(8, 10) + '/' + d.date.substring(5,7)),
                datasets: [{
                    label: 'Doanh thu',
                    data: orderConfirmed.map(d => d.price),
                    borderWidth: 1.5,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                elements: {
                    line: {
                        tension: 0.5
                    }
                }
            }
        });

        const chartCount = document.getElementById('chart-count');
        const orderAll = @json($orderAll);
        new Chart(chartCount, {
            type: 'line',
            data: {
                labels: orderAll.map(d => d.date.substring(8, 10) + '/' + d.date.substring(5,7)),
                datasets: [{
                    label: 'Số lượng đơn',
                    data: orderAll.map(d => d.count),
                    borderWidth: 1.5,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                elements: {
                    line: {
                        tension: 0.5
                    }
                }
            }
        });

        const pieChart = document.getElementById('pie-chart');
        const orderStatus = @json($orderStatus);
        new Chart(pieChart, {
            type: 'doughnut',
            data: {
                labels: orderStatus.map(o => o.status),
                datasets: [{
                    label: 'Số lượng',
                    data: orderStatus.map(o => o.count),
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            }
        });
    </script>
@endpush
