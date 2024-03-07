<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Helper\Functions;
use App\Order;
use App\Setting as MainModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class StatisticalController extends BaseController
{
    protected $date_from;
    protected $date_to;
    protected $end_date;

    public function __construct() {
        $currentDate = new \DateTime();
        $this->date_from = request('date_from') ? new \DateTime(request('date_from')) : $currentDate->modify('-7 day');
        $this->date_to = request('date_to') ? new \DateTime(request('date_to')) : new \DateTime();
        $this->end_date = $this->date_to->modify('+1 day');
    }

    public function index(Request $request) {
        $orderConfirmed = $this->getOrderByStatus('Hoàn tất');
        $orderAll = $this->getOrderByStatus();
        $orderStatus = Order::select(
            'status',
            DB::raw('COUNT(id) as count')
        )->whereBetween('updated_at', [$this->date_from, $this->date_to])->groupBy('status')->get();
        return view("admin.page.statistical.index", [
            'orderConfirmed'=>$this->getResult($orderConfirmed),
            'orderAll'=>$this->getResult($orderAll),
            'orderStatus'=>$orderStatus
        ]);
    }

    public function getResult($order) {
        $begin = $this->date_from;
        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($begin, $interval, $this->end_date);
        $result = [];
        foreach ($period as $dt) {
            $orderResult = new \stdClass();
            $formatDate = $dt->format('Y-m-d');
            $findOrder = $order->firstWhere('date', $formatDate);
            $orderResult->date = $formatDate;
            $orderResult->price = $findOrder ? $findOrder->price : 0;
            $orderResult->count = $findOrder ? $findOrder->count : 0;
            $result[] = $orderResult;
        }
        return $result;
    }

    public function getOrderByStatus($status = null) {
        $order = Order::select(
            DB::raw('DATE(updated_at) as date'),
            DB::raw('SUM(price_total) as price'),
            DB::raw('COUNT(id) as count')
        );
        if ( $status ) {
            $order = $order->where('status', $status);
        }

        return $order->whereBetween('updated_at', [$this->date_from, $this->date_to])
            ->groupBy('date')
            ->get();
    }
}
