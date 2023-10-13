<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        return [
            'name' => $this->generateRandomCarName(),
            'plat_code' => $this->generatePlatNumber(),
            'content' => fake()->randomElements(['human', 'goods', 'both'])[0],
            'is_owned' => fake()->boolean(),
        ];
    }

    public function generateRandomCarName() {
        $colors = ['Red', 'Blue', 'Green', 'Yellow', 'Black', 'White', 'Silver', 'Orange', 'Purple'];
        $carTypes = ['Sedan', 'SUV', 'Sports Car', 'Truck', 'Crossover', 'Convertible'];
        
        $cc = rand(4, 20) * 250;
        $year = rand(2000, 2023);
        
        $randomColor = fake()->randomElements($colors)[0];
        $randomCarType = fake()->randomElements($carTypes)[0];

        
        $randomCarName = "{$randomColor} {$randomCarType} {$cc}CC {$year}";
        
        return $randomCarName;
    }

    public function generatePlatNumber() {
        $code = ['DB','AS','SL','FK','TW','MN','WM','BA','SK','LF'];

        $number = rand(4, 20) * 24;

        $f = fake()->randomElements($code)[0];
        $e = fake()->randomElements($code)[0];

        return "{$f} {$number} {$e}";
    }
}
