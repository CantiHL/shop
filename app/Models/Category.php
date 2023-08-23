<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Category extends Model
{
    use HasFactory;
    public function list(){
        return DB::table('categories')->limit(5)->get();
     }
     public function updateStatus($id,$name)
     {
         return DB::table('categories')->where('id',$id)->update($name);
     }
     public function listId($id)
     {
         return DB::table('categories')->where('id',$id)->get();
     }
     public function updateById($data,$id)
     {
         return DB::table('categories')->where('id',$id)->update($data);
     }
     public function insert($data)
    {
        return DB::table('categories')->insertGetId($data);
    }
    public function deleteById($id)
    {
        return DB::table('categories')->where('id',$id)->delete();
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
