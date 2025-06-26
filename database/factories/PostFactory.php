<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $image = UploadedFile::fake()->image($this->faker->uuid.'.jpg');
        $path = $image->store('posts', 'public');

        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => $this->faker->sentence,
            'slug' => $this->faker->unique()->slug,
            'image_path' => $path,
            'content' => $this->faker->paragraph,
            'status' => 'published',
        ];
    }
}
