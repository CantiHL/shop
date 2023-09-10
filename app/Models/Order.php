<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    use HasFactory;
    public function insertOrder($data)
    {
        return DB::table('orders')->insertGetId($data);
    }
    public function list_order()
    {
        return DB::table('orders')->get();
    }
    public function getDetailsOrder()
    {
        return DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->select('product_id', DB::raw('SUM(orders.quantity) as quantity'), 'products.name', 'products.price')
            ->where('orders.status', '=', 'done')
            ->groupBy('product_id', 'products.name', 'products.price')
            ->get();;
    }
    public function getStatiscalUser()
    {
        return DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->select('user_name','users.email','users.phone', DB::raw('SUM(quantity) as quantity'))
            ->where('status', '=', 'done')
            ->groupBy('user_id', 'user_name', 'email','phone')
            ->get();
    }
    public function deleteOrder($id)
    {
        return DB::table('orders')->where('id','=',$id)->delete();
    }

    public function update_status($id, $data)
    {
        return DB::table('orders')->where('id','=',$id)->update($data);
    }
    public function updatePaymentId($id,$idPayment)
    {
        return DB::table('orders')->where('id','=',$id)->update(['payment_id'=>$idPayment]);
    }
    public function updateQuantity($id,$value)
    {
        return DB::table('orders')->where('id','=',$id)->update(['quantity'=>$value]);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

}
