<?php

namespace Database\Factories;

use App\Models\UserQuickCard;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserQuickCardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserQuickCard::class;

    public function definition(): array
    {
        $username = fake()->unique()->name;
        $slug = Str::slug($username);

        $uniqueSlug = $slug;
        $counter = 1;
        while (UserQuickCard::where('slug', $uniqueSlug)->exists()) {
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
