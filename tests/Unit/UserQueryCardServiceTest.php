<?php

namespace Tests\Unit;

use App\Models\UserQueryCard;
use App\Services\UserQueryCardService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserQueryCardServiceTest extends TestCase
{
    use RefreshDatabase;

    private UserQueryCardService $userQueryCardService;

    public function setUp(): void
    {
        parent::setUp();
        $this->userQueryCardService = new UserQueryCardService(/* constructor parameters if needed */);
    }

    public function test_create_user_query_card_creates_and_returns_user_query_card(): void
    {
        $data = [
            'username' => 'John Doe',
            'linkedInUrl' => 'https://www.linkedin.com/in/johndoe',
            'gitHubUrl' => 'https://github.com/johndoe',
        ];

        $userQueryCard = $this->userQueryCardService->createUserQueryCard($data);

        $this->assertInstanceOf(UserQueryCard::class, $userQueryCard);
        $this->assertEquals($data['username'], $userQueryCard->username);
        $this->assertEquals($data['linkedInUrl'], $userQueryCard->linkedin_url);
        $this->assertEquals($data['gitHubUrl'], $userQueryCard->github_url);
    }

    public function test_generate_qr_code_returns_svg_string(): void
    {
        $url = 'https://example.com/some-unique-slug';

        $qrCode = $this->userQueryCardService->generateQrCodeAsSVG($url);

        $this->assertIsString($qrCode);
        $this->assertStringContainsString('<svg', $qrCode);
    }
}
