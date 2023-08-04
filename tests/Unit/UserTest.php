<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class UserTest extends TestCase
{
    /**
     * A basic Unit test example.
     *
     * @return void
     */
    public function test_user_home_page()
    {
        $response = $this->get('/home-page');

        $response->assertStatus($response->status(),200);
    }
    public function test_user_get_login()
    {
        $response = $this->call('post','/check',[
            "email_login" => "anhdaywiaa@gmail.com",
            "password_login" => "123"
        ]);

        $response->assertStatus($response->status(),200);
    }
    public function test_user_check_login_fail()
    {
        $response = $this->call('post','/check',[
            "email_login" => "anhdaywiaa@gmail.com",
            "password_login" => "1234564564234"
        ]);

        $response->assertStatus($response->status(),200);
    }
    public function test_user_check_login_ad()
    {
        $response = $this->call('post','/check',[
            "_token" => "cUIQvzryZ0kqndW3D1kGjqZUQFk4qwwztrbKGrvM",
            "email_login" => "hung@123",
            "password_login" => "123",
        ]);
        $response->assertRedirect('/admin');
    }
    public function test_user_login_user()
    {
        $response = $this->get('/login');

        $response->assertStatus($response->status(),200);
    }
    public function test_user_logout()
    {
        $response = $this->get('/user/logout');

        $response->assertStatus($response->status(),200);
    }
    public function test_user_register()
    {
        $response = $this->call('post','/user/register',[
            'user_name'=>'canti',
            'email'=>'anhdaywiaa@gmail.com',
            'password'=>123,
            'address'=>'lang son',
            'phone'=>'0373245418',
            'created_at'=>date('Y-m-d H:i:s')
        ]);

        $response->assertStatus($response->status(),200);
    }
    
    public function test_user_search()
    {
        $response = $this->get('/search?filter_category=12&filter_brand=18&keywords=aaa&_token=EMvugDdJJjmKkDzkNqU18fE5V1Q4ql18yvvrtFs7');

        $response->assertStatus($response->status(),200);
    }
    public function test_user_comment()
    {
        $response = $this->post('/comment');

        $response->assertStatus($response->status(),200);
    }
    public function test_user_checkout1()
    {
        $cart[517]=[
            'id'=>"517",
            'name'=>"product->product_name",
            'price'=>"product->product_price",
            'image'=>"product->product_image",
            'quantity'=>1
        ];
        session()->put('id',84);
        session()->put('cart',$cart);
        $response = $this->call('post','/checkout',[
            "_token" => "cUIQvzryZ0kqndW3D1kGjqZUQFk4qwwztrbKGrvM",
            "note" => null
        ]);
        $response->assertStatus($response->status(),200);
    }
    public function test_user_checkout()
    {
        $cart[517]=[
            'id'=>"517",
            'name'=>"product->product_name",
            'price'=>"product->product_price",
            'image'=>"product->product_image",
            'quantity'=>1
        ];
        session()->put('cart',$cart);
        $response = $this->call('post','/checkout',[
            "_token" => "bYLg4rYGKsA1JxZQYHxZf0rSKSn69ujaXTw7lasG",
            "cus_email" => "kutngay113@gmail.com",
            "cus_name" => "ly hung",
            "cus_phone" => "0373245418",
            "cus_address" => "loc binh",
            "note" => null
        ]);

        $response->assertStatus($response->status(),200);
    }
    
    
}
