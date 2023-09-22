<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Brand extends Model
{
    use HasFactory;
    public function list(){
        return DB::table('brands')->get();
     }
     public function listId($id)
     {
         return DB::table('brands')->where('id',$id)->get();
     }
     public function updateById($data,$id)
     {
         return DB::table('brands')->where('id',$id)->update($data);
     }
     public function insert($data)
     {
         return DB::table('brands')->insertGetId($data);
     }
     public function deleteById($id)
    {
        return DB::table('brands')->where('id',$id)->delete();
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
