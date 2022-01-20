<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostCustomerTest extends TestCase
{
    public function a_post_can_be_created()
    {
        $response = $this->post('/api/customers', [
            'first_name' => 'Juan',
            'last_name' => 'Torres',
            'email' => 'test@test.com',
            'gender' => 'Male',
            'company' => 'Google',
            'city' => 'Warner, NH',
            'title' => 'CEO'
        ]);

        $this->assertOk();
        $this->assertCount(1, Customer::all());

        $customer = Customer::first();

        $this->assertEquals($customer->first_name, 'Juan');
        $this->assertEquals($customer->last_name, 'Torres');
    }
}
