<?php

namespace Database\Factories;

use App\Models\UserQueryCard;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserQueryCardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserQueryCard::class;

    public function definition(): array
    {
        $username = fake()->unique()->name;
        $slug = Str::slug($username);

        $uniqueSlug = $slug;
        $counter = 1;
        while (UserQueryCard::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $counter;
            $counter++;
        }

        return [
            'username' => $username,
            'slug' => $uniqueSlug,
            'linkedin_url' => 'https://linkedin.com/in/' . fake()->slug(),
            'github_url' => 'https://github.com/' . fake()->slug(),
        ];
    }
}
