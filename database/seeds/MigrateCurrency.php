<?php

use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Database\Seeder;

class MigrateCurrency extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = Order::all();
        foreach($order as $ord) {
            $ord->update([
                'price_total'=>$ord->price_total*1000
            ]);
        }

        $orderDetail = OrderDetail::all();
        foreach($orderDetail as $ord) {
            $ord->update([
                'product_price'=>$ord->product_price*1000,
                'price_total'=>$ord->price_total*1000
            ]);
        }

        $products = Product::all();
        foreach($products as $product) {
            $product->update([
                'price_final'=>$product->price_final*23000,
                'price_base'=>$product->price_base*23000,
            ]);
            
            switch($product->type) {
                case 'sale':
                    $product->update([
                        'type'=> 'giảm giá'
                    ]);
                    break;
                case 'best seller':
                    $product->update([
                        'type'=> 'bán chạy'
                    ]);
                    break;
                case 'new':
                    $product->update([
                        'type'=> 'mới'
                    ]);
                    break;
            }
        }
    }
}
