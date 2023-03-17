<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\UserQuickCard;

class UniqueSlugService
{
    public function generateUniqueSlug(string $username): string
    {
        $slug = Str::slug($username);
        $uniqueSlug = $slug;
        $counter = 1;

        while (UserQuickCard::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $counter;
            $counter++;
        }

        return $uniqueSlug;
    }
}
