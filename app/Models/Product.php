<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_price',
        'product_brand_id',
        'product_category_id',
        'product_description',
        'product_date'
    ];

    public function list()
    {
        return DB::table('products')->join('brands','products.product_brand_id','=','brands.brand_id')->join('categories','products.product_category_id','=','categories.category_id')->get();
    }
    public function list_for_client($filter,$keyword)
    {
        $data=DB::table('products')
        ->join('brands','products.product_brand_id','=','brands.brand_id')
        ->join('categories','products.product_category_id','=','categories.category_id')
        ->where('product_status',0);
        if(!empty($filter)){
            $data=$data->where($filter);
        }
        if(!empty($keyword)){
            $data=$data->where('product_name','like',"%$keyword%")
            ->orwhere('product_price','like',"%$keyword%")
            ->orwhere('product_description','like',"%$keyword%")
            ->orwhere('product_date','like',"%$keyword%")
            ->orwhere('brand_name','like',"%$keyword%")
            ->orwhere('category_name','like',"%$keyword%");

        }
        return $data=$data->paginate(9);

    }
    public function listId($id)
    {
        return DB::table('products')->where('id',$id)->get();
    }
    public function insert($data)
    {
        return DB::table('products')->insertGetId($data);
    }
     public function deleteById($id)
    {
        return DB::table('products')->where('id',$id)->delete();
    }
    public function updateById($data,$id)
    {
        return DB::table('products')->where('id',$id)->update($data);
    }
    public function updateStatus($id,$value)
    {
        return DB::table('products')->where('id',$id)->update(['product_status'=>$value],);
    }
    public function get_product_detail($id)
    {
        return DB::table('products')
        ->join('brands','products.product_brand_id','=','brands.brand_id')
        ->join('categories','products.product_category_id','=','categories.category_id')
        ->where('id',$id)
        ->get();

    }
}
