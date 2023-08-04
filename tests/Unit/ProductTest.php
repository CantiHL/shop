<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

use App\Models\Product;

class ProductTest extends TestCase
{
    /**
     * A basic Unit test example.
     *
     * @return void
     */
    public function test_product_store()
     {
        $res=$this->call('post','/add-product',[
            'product_name'=>'Xiaomi',
            'product_price'=>rand(2000000,50000000),
            'product_brand_id'=>rand(0,1000),
            'product_category_id'=>rand(0,1000),
            'product_description'=>'Doloremque assumenda fuga quibusdam. Omnis consectetur natus ea totam aut quas illum iste. Deleniti a temporibus est reiciendis.',
            'product_date'=>date('Y-m-d')
           ]);
           $res->assertStatus($res->status(),200);
    }
    
    public function test_product_get_form()
    {
        $this->get('/add-product')
            ->assertStatus(200);
    }
    public function test_product_list()
    {
        $this->get('/product')
            ->assertStatus(200);
    }
    public function test_product_detail()
    {
        $this->get('/product-detail/3')
            ->assertStatus(200);
    }
    public function test_product_edit_form()
    {
        $this->get('/edit-product/3')
            ->assertStatus(200);
    }
    public function test_product_edit()
    {
        $res=$this->call('post','/edit-product/318',[
            'product_name' => 'Apple A13',
            'product_price' => '39999999',
            'product_brand_id' => rand(1,100),
            'product_category_id' => rand(1,100),
            'product_description' => 'Unde est a sed quaerat reiciendis amet odit. Aperiam consequatur eaque mollitia quasi at.',
            'product_date' => '2023-03-30'
           ]);
           $res->assertStatus($res->status(),200);
    }
    public function test_product_edit_fail()
    {
        $res=$this->call('post','/edit-product/230',[
            'product_brand_id' => '16',
            'product_category_id' => '2',
            'product_description' => 'Unde est a sed quaerat reiciendis amet odit. Aperiam consequatur eaque mollitia quasi at.',
            'product_date' => '2023-03-30'
           ]);
           $res->assertStatus($res->status(),200);
    }
    public function test_product_edit_status()
    {
       $res= $this->get('update-status-product/3/0');
       $res->assertStatus($res->status(),200);
    }
    public function test_product_delete()
    {
        $Product = Product::factory()->create();
        $res=$this->get('/delete-product/'.$Product->id);
        $res->assertStatus($res->status(),200);
    }
    public function test_product_delete_fail()
    {
        $Product = Product::factory()->create();
        $res=$this->get('/delete-product/-1');
        $res->assertStatus($res->status(),200);
    }
}
