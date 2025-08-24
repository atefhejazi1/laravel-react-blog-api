<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{

    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['draft', 'published', 'archived'];

        return [
            'title'       => $this->faker->sentence,
            'body'        => $this->faker->paragraphs(3, true),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'user_id'     => User::inRandomOrder()->first()?->id ?? null,
            'status'      => $this->faker->randomElement($statuses),
        ];
    }
}
