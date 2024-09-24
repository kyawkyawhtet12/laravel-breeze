<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'company_id' => Company::factory(),
            'profile' => $this->faker->imageUrl(),
        ];
    }
}
