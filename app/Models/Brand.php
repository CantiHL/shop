<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Brand extends Model
{
    use HasFactory;
    public function list_active(){
       return DB::table('brands')->where('brand_status',0)->get();
    }
    public function list(){
        return DB::table('brands')->get();
     }
     public function updateStatus($id,$value)
     {
         return DB::table('brands')->where('brand_id',$id)->update(['brand_status'=>$value],);
     }
     public function listId($id)
     {
         return DB::table('brands')->where('brand_id',$id)->get();
     }
     public function updateById($data,$id)
     {
         return DB::table('brands')->where('brand_id',$id)->update($data);
     }
     public function insert($data)
     {
         return DB::table('brands')->insertGetId($data);
     }
     public function deleteById($id)
    {
        return DB::table('brands')->where('brand_id',$id)->delete();
    }
}
