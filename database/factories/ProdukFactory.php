<?php

namespace Database\Factories;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hargaBeli = $this->faker->numberBetween(5_000, 100_000);

        return [
            'user_id' => User::query()
                ->where('role_id', 1)
                ->inRandomOrder()
                ->first()
                ->id,
            'foto' => 'produk/' . $this->faker->uuid(),
            'nama' => $this->faker->words(3, true),
            'harga_beli' => $hargaBeli,
            'harga_jual' => $hargaBeli + $this->faker->numberBetween(5_000, 100_000),
            'stok' => $this->faker->numberBetween(1, 500),
        ];
    }
}