<?php

namespace Tests\Unit;

use App\Services\QRCodeService;
use App\Services\UserQuickCardService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QRCodeServicesTest extends TestCase
{
    use RefreshDatabase;

    private QRCodeService $qrCodeService;

    public function setUp(): void
    {
        parent::setUp();
        $this->qrCodeService = new QRCodeService();
    }

    public function test_generate_qr_code_returns_png_string(): void
    {
        $url = 'https://example.com/some-unique-slug';

        $qrCode = $this->qrCodeService->generateQRCodeAsPNG($url);

        $this->assertIsString($qrCode);
        $this->assertStringContainsString('data:image/png;base64,', $qrCode);
    }

    public function test_generate_qr_code_returns_svg_string(): void
    {
        $url = 'https://example.com/some-unique-slug';

        $qrCode = $this->qrCodeService->generateQrCodeAsSVG($url);

        $this->assertIsString($qrCode);
        $this->assertStringContainsString('<svg', $qrCode);
    }
}
