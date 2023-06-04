<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use App\Models\Customer;

class CustomerApiTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * Test customer creation via API.
     *
     * @return void
     */
    public function testCustomerCreation()
    {
        $data = [
            'first_name' => 'shukri',
            'last_name' => 'rauf',
            'dob' => '1991-01-01',
            'email' => 'shukri@gmail.com',
        ];

        Http::fake();

        $response = $this->json('POST', '/api/customer', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('customers', $data);
    }

    /**
     * Test customer retrieval via API.
     *
     * @return void
     */
    public function testCustomerRetrieval()
    {
        $customer = Customer::factory()->create();

        Http::fake();

        $response = $this->json('GET', '/api/customer/' . $customer->id);

        $response->assertOk();
        $response->assertJson(array( "data"=> $customer->toArray() ));
    }

    /**
     * Test customer update via API.
     *
     * @return void
     */
    public function testCustomerUpdate()
    {
        $customer = Customer::factory()->create();

        $data = [
            'first_name' => 'shukri updated',
            'last_name' => 'Rauf',
            'dob' => '1990-01-01',
            'email' => 'updated@example.com',
        ];

        Http::fake();

        $response = $this->json('PUT', '/api/customer/' . $customer->id, $data);

        $response->assertOk();
        $this->assertDatabaseHas('customers', $data);
    }

    /**
     * Test customer deletion via API.
     *
     * @return void
     */
    public function testCustomerDeletion()
    {
        $customer = Customer::factory()->create();

        Http::fake();

        $response = $this->json('DELETE', '/api/customer/' . $customer->id);

        $response->assertOk();
        $this->assertDatabaseMissing('customers', ['id' => $customer->id]);
    }
}
