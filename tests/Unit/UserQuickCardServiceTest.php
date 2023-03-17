<?php

namespace Tests\Unit;

use App\Models\UserQuickCard;
use App\Services\UniqueSlugService;
use App\Services\UserQuickCardService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserQuickCardServiceTest extends TestCase
{
    use RefreshDatabase;

    private UserQuickCardService $userQuickCardService;

    public function setUp(): void
    {
        parent::setUp();
        $uniqueSlugService = new UniqueSlugService();
        $this->userQuickCardService = new UserQuickCardService($uniqueSlugService);
    }

    public function test_create_user_query_card_creates_and_returns_user_query_card(): void
    {
        $data = [
            'username' => 'John Doe',
            'linkedInUrl' => 'https://www.linkedin.com/in/johndoe',
            'gitHubUrl' => 'https://github.com/johndoe',
        ];

        $userQuickCard = $this->userQuickCardService->createUserQuickCard($data);

        $this->assertInstanceOf(UserQuickCard::class, $userQuickCard);
        $this->assertEquals($data['username'], $userQuickCard->username);
        $this->assertEquals($data['linkedInUrl'], $userQuickCard->linkedin_url);
        $this->assertEquals($data['gitHubUrl'], $userQuickCard->github_url);
    }
}
