<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    /**
     * A basic Unit test example.
     *
     * @return void
     */
    public function test_cart_info()
    {
        $response = $this->get('/cart');

        $response->assertStatus(200);
    }
    public function test_cart_store()
    {
       $res= $this->get('/add-to-cart/517');
        $res->assertStatus($res->status(),200);
    }
    public function test_cart_store1()
    {
       $res= $this->get('/add-to-cart/517');
       $res1= $this->get('/add-to-cart/517');
       $res->assertStatus($res->status(),200);
        $res1->assertStatus($res->status(),200);
    }
    public function test_cart_edit()
    {
       $res= $this->call('post','/update_cart_item',["id"=>517]);
        $res->assertStatus($res->status(),200);
    }
    public function test_cart_delete()
    {
       $res= $this->get('/delete_item_cart',["id"=>3]);
        $res->assertStatus($res->status(),200);
    }
    
}
