<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {     $segments = explode('/', str_replace(''.url('').'', '', $this->faker->image('public/storage/images', 300, 300)));
       
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph(nbSentences: 1),
            'user_id' => $this->faker->numberBetween(int1:1, int2: 2),
            'image'=>$segments[2]
        ];
    }
}
