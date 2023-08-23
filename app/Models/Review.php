<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Review extends Model
{
    use HasFactory;

    public function list_comment($id)
    {
        return DB::table('reviews')->join('users','users.id','reviews.user_id')->where('product_id',$id)->select('reviews.*','users.user_name')->limit(8)->get();
    }
    public function insert($data)
    {
        return DB::table('reviews')->insertGetId($data);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
