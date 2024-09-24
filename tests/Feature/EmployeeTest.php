<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_an_employee()
    {
        $company = Company::factory()->create();
        $data = [
            'name' => 'Test Employee',
            'email' => 'employee@example.com',
            'phone' => '123456789',
            'company_id' => $company->id,
            'profile' => null,
        ];

        $admin = User::factory()->create(['role' => 'Administrator']);

        $response = $this->actingAs($admin)->post('/api/employees', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('employees', ['name' => 'Test Employee']);
    }

    /** @test */
    public function user_can_update_an_employee()
    {
        $employee = Employee::factory()->create();
        $company = Company::factory()->create();
        $updateData = [
            'name' => 'Updated Employee Name',
            'email' => 'updatedemployee@example.com',
            'phone' => '987654321',
            'company_id' =>$company->id,
        ];

        $admin = User::factory()->create(['role' => 'Administrator']);

        $response = $this->actingAs($admin)->post("/api/employees/{$employee->id}", $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('employees', ['name' => 'Updated Employee Name']);
    }

    /** @test */
    public function user_can_delete_an_employee()
    {
        $employee = Employee::factory()->create();

        $admin = User::factory()->create(['role' => 'Administrator']);

        $response = $this->actingAs($admin)->delete("/api/employees/{$employee->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }
}
