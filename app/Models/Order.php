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
    public function updateStatus($id,$data)
    {
        return DB::table('orders')->where('id',$id)->update($data);
    }
    public function deleteOrder($id)
    {
        return DB::table('orders')->where('id','=',$id)->delete();
    }

    public function update_status(mixed $id, array $data)
    {
        return DB::table('orders')->where('id','=',$id)->update($data);
    }
    public function updatePaymentId($id,$idPayment)
    {
        return DB::table('orders')->where('id','=',$id)->update(['payment_id'=>$idPayment]);
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
