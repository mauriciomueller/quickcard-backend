<?php

namespace App\Services;

use App\Models\UserQuickCard;
use Exception;

class UserQuickCardService
{

    public function __construct(
        private UniqueSlugService $uniqueSlugService
    )
    {
    }

    public function createUserQuickCard(array $data): UserQuickCard
    {
        $uniqueSlug = $this->uniqueSlugService->generateUniqueSlug($data['username']);

        try {
            $userQuickCard = UserQuickCard::create([
                'username' => $data['username'],
                'slug' => $uniqueSlug,
                'linkedin_url' => $data['linkedInUrl'],
                'github_url' => $data['gitHubUrl'],
            ]);
        } catch (Exception $e) {
            throw new DatabaseException('Error saving UserQuickCard');
        }

        return $userQuickCard;
    }
}
