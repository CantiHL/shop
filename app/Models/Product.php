<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'quantity',
        'brand_id',
        'category_id',
        'created_at',
    ];

    public function list()
    {
        return DB::table('products')->join('brands','products.id','=','brands.id')->join('categories','products.id','=','categories.id')->get();

    }
    public function list_show($filter,$keyword)
    {
        $data=Product::with(['brand','category']);
        if(!empty($filter['product_brand_id'])){
            $data=$data->whereHas('brand', function ($query) use ($filter){
                    $query->where('brand_id',$filter['product_brand_id']);
                }
            );
        }
        if(!empty($filter['product_category_id'])){
            $data=$data->whereHas('category', function ($query) use ($filter){
                $query->where('category_id',$filter['product_category_id']);
            }
            );
        }
        if(!empty($keyword)){
            $data=$data->where(function ($query) use ($keyword){
                $query->where('name','like',"%$keyword%");
                $query->orWhere('price',"$keyword");
            });
        }
        return $data=$data->orderBy('id','ASC')->paginate(9);
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
    public function updateQuantity($id,$value)
    {
        return DB::table('products')->where('id',$id)->update(['quantity'=>$value],);
    }
    public function get_detail($id)
    {
        return DB::table('products')
        ->join('brands','products.id','=','brands.id')
        ->join('categories','products.id','=','categories.id')
        ->where('id',$id)
        ->get();

    }
    public function averageRating()
    {
        return round($this->reviews()->avg('rating'),2);
    }
    public function countRating()
    {
        return $this->reviews()->count('rating');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
