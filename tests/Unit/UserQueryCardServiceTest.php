<?php

namespace Tests\Unit;

use App\Models\UserQueryCard;
use App\Services\UserQueryCardService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserQueryCardServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user_query_card_creates_and_returns_user_query_card(): void
    {
        $data = [
            'username' => 'John Doe',
            'linkedInUrl' => 'https://www.linkedin.com/in/johndoe',
            'gitHubUrl' => 'https://github.com/johndoe',
        ];

        $userQueryCardService = new UserQueryCardService();
        $userQueryCard = $userQueryCardService->createUserQueryCard($data);

        $this->assertInstanceOf(UserQueryCard::class, $userQueryCard);
        $this->assertDatabaseHas('user_query_cards', $data);
    }

    public function test_generate_qr_code_returns_png_string(): void
    {
        $url = 'https://example.com/some-unique-slug';

        $userQueryCardService = new UserQueryCardService();
        $qrCode = $userQueryCardService->generateQrCodeAsPNG($url);

        $this->assertIsString($qrCode);
    }
}
