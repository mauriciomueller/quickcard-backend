<?php

namespace Database\Seeders;

use App\Models\UserQuickCard;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        UserQuickCard::factory(10)->create();
    }
}
