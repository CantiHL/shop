<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * A basic Unit test example.
     *
     * @return void
     */
    public function test_admin_page()
    {
        $response = $this->get('/admin');

        $response->assertStatus($response->status(),200);
    }
    public function test_admin_list_order()
    {
        $response = $this->get('/admin/list-order');

        $response->assertStatus($response->status(),200);
    }
    public function test_admin_update_order()
    {
        $response = $this->get('/admin/list-order/update-order');

        $response->assertStatus($response->status(),200);
    }
    public function test_admin_delete_order()
    {
        $response = $this->get('/admin/list-order/delete-order',["id"=>1]);

        $response->assertStatus($response->status(),200);
    }
}
