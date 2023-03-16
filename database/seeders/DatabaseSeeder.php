<?php

namespace Database\Seeders;

use App\Models\UserQueryCard;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        UserQueryCard::factory(10)->create();
    }
}
