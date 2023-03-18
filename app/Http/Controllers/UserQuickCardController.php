<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserQuickCardRequest;
use App\Models\UserQuickCard;
use Illuminate\Http\JsonResponse;

class UserQuickCardController extends Controller
{
    public function __invoke(string $slug): JsonResponse
    {
        try {
            $userQuickCard = UserQuickCard::where('slug', $slug)->first();

            return $this->sendResponse([
                'username' => $userQuickCard->username,
                'linkedin_url' => $userQuickCard->linkedin_url,
                'github_url' => $userQuickCard->github_url,
            ], 'User quick card successfully retrieved.');
        } catch (\Exception $e) {
            return $this->sendErrorResponse('Error retrieving user quick card.');
        }
    }
}
