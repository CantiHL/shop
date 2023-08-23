<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function register($data)
    {
        return DB::table('users')->insertGetId($data);
    }
    public function getUserById($id)
    {
        return DB::table('users')->where('id',$id)->first();
    }
    public function getUserByEmail($email)
{
    return DB::table('users')->where('email',$email)->first();
}

    public function update_user($data,$id)
    {
        return DB::table('users')->where('id',$id)->update($data);
    }
    public function list_user()
    {
        //DB::enableQueryLog();
        return DB::table('users')->where('position',1)->get();
       // dd(DB::getQueryLog($sql));
    }

    public function insert(array $data)
    {
        return DB::table('users')->insertGetId($data);
    }

    public function deleteById($id)
    {
        return DB::table('users')->where('id',$id)->delete();

    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
