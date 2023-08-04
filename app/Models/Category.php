<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Category extends Model
{
    use HasFactory;

    public function list_active(){
        return DB::table('categories')->where('category_status',0)->get();
    }
    public function list(){
        return DB::table('categories')->get();
     }
     public function updateStatus($id,$value)
     {
         return DB::table('categories')->where('category_id',$id)->update(['category_status'=>$value],);
     }
     public function listId($id)
     {
         return DB::table('categories')->where('category_id',$id)->get();
     }
     public function updateById($data,$id)
     {
         return DB::table('categories')->where('category_id',$id)->update($data);
     }
     public function insert($data)
    {
        return DB::table('categories')->insertGetId($data);
    }
    public function deleteById($id)
    {
        return DB::table('categories')->where('category_id',$id)->delete();
    }
}
