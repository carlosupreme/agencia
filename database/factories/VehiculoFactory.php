<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Placa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehiculo>
 */
class VehiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'marca_id' => Marca::factory()->create()->id,
            'modelo_id' => Modelo::factory()->create()->id,
            'placa_id' => Placa::factory()->create()->id,
            'categoria_id' => Categoria::all()->random()->id,
            'precio_dia' => fake()->randomFloat(2, 500, 5000),
        ];
    }
}
