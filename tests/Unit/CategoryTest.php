<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryTest extends TestCase
{
    /**
     * A basic Unit test example.
     *
     * @return void
     */
    public function test_category_list()
    {
        $this->get('/category')
            ->assertStatus(200);
    }
    public function test_category_add_form()
    {
        $this->get('/add-category')
            ->assertStatus(200);
    }
    public function test_category_store()
    {
       $res=$this->call('post','/add-category',[
        'category_name'=>'Apple',
        'category_description'=>'no'
       ]);
       $res->assertStatus($res->status(),200);
       
    }
    public function test_category_edit()
    {
        $this->get('/edit-category/2')
            ->assertStatus(200);
    }
    public function test_category_update()
    {
        $res=$this->call('post','/edit-category/2',[
            'category_name'=>'Apple',
            'category_description'=>'no'
           ]);
           $res->assertStatus($res->status(),200);
    }
    public function test_category_edit_status()
    {
        $res=$this->get('update-status-category/2/0');
            $res->assertStatus($res->status(),200);
    }
    public function test_category_delete()
    {
        $category = Category::factory()->create();
        $res=$this->get('/delete-category/'.$category->id);
        $res->assertStatus($res->status(),200);
    }
}
