<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    use HasFactory;

    public function list_payed()
    {
        return DB::table('payments')->get();
    }
    public function insert($data){
        return DB::table('payments')->insertGetId($data);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
