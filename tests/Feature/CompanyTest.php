<?php

namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_a_company()
    {
        $data = [
            'name' => 'Test Company',
            'email' => 'test@example.com',
            'website' => 'https://example.com',
            'logo' => null,
        ];

        $admin = User::factory()->create(['role' => 'Administrator']);

        $response = $this->actingAs($admin)->post('/api/companies', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('companies', ['name' => 'Test Company']);
    }

    /** @test */
    public function user_can_update_a_company()
    {
        $company = Company::factory()->create();

        $updateData = [
            'name' => 'Updated Company Name',
            'email' => 'updated@example.com',
        ];

        $admin = User::factory()->create(['role' => 'Administrator']);

        $response = $this->actingAs($admin)->post("/api/companies/{$company->id}", $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('companies', ['name' => 'Updated Company Name']);
    }

    /** @test */
    public function user_can_delete_a_company()
    {
        $company = Company::factory()->create();

        $admin = User::factory()->create(['role' => 'Administrator']);

        $response = $this->actingAs($admin)->delete("/api/companies/{$company->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('companies', ['id' => $company->id]);
    }
}

