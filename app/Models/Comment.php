<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class comment extends Model
{
    use HasFactory;

    public function list_comment()
    {
        return DB::table('comments')->join('users','users.id','comments.user_id')->paginate(4);
    }
    public function insert_comment($data)
    {
        return DB::table('comments')->insertGetId($data);
    }
    // public function update($id,$data)
    // {
    //     return DB::table('comments')->where('id',$id)->update($data);
    // }
}
