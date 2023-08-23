<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class paymethod extends Model
{
    use HasFactory;

    public function getPaymethods(){
        return DB::table('paymethods')->get();
    }
}
