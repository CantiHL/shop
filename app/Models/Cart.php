<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Cart extends Model
{
    use HasFactory;

    public function insert_cart($data)
    {
        return DB::table('carts')->insertGetId($data);
    }
    public function list_order()
    {
        return DB::table('products')->join('carts','products.id','=','carts.id_product')->get();
    }
    public function update_status($id,$data)
    {
        return DB::table('carts')->where('id',$id)->update($data);
    }
    public function deleteoder($id)
    {
        return DB::table('carts')->where('id','=',$id)->delete();
    }


}
