<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticalController extends Controller
{
    public function __construct(
        private readonly Order $order,
        private readonly User $user
    ){

    }
    public function statistical(Request $request){
        $quantity = Order::where('orders.status','done')->sum('quantity');
        $revenue = Order::join('products', 'orders.product_id', '=', 'products.id')->where('orders.status','done')
            ->sum(DB::raw('orders.quantity * products.price'));
        $details = $this->order->getDetailsOrder();
        $statiscalUsers = $this->order->getStatiscalUser();
        return view('admin.statistical.statistical', compact(['quantity','revenue','details','statiscalUsers']));
    }
}
