<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Brand;

class BrandTest extends TestCase
{
    /**
     * A basic Unit test example.
     *
     * @return void
     */
    public function test_brand_list()
    {
        $this->get('/brand')
            ->assertStatus(200);
    }
    public function test_brand_add_form()
    {
        $this->get('/add-brand')
            ->assertStatus(200);
    }
    public function test_brand_store()
    {
       $res=$this->call('post','/add-brand',[
        'brand_name'=>'Apple',
        'brand_description'=>'no'
       ]);
       $res->assertStatus($res->status(),200);
       
    }
    public function test_brand_edit()
    {
        $this->get('/edit-brand/2')
            ->assertStatus(200);
    }
    public function test_brand_update()
    {
        $res=$this->call('post','/edit-brand/2',[
            'brand_name'=>'Apple',
            'brand_description'=>'no'
           ]);
           $res->assertStatus($res->status(),200);
    }
    public function test_brand_edit_status()
    {
        $res=$this->get('update-status-brand/2/0');
            $res->assertStatus($res->status(),200);
    }
    public function test_brand_delete()
    {
        $brand = brand::factory()->create();
        $res=$this->get('/delete-brand/'.$brand->id);
        $res->assertStatus($res->status(),200);
    }
}
