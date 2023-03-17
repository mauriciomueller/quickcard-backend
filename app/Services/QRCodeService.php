<?php

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Exception;

class QRCodeService
{
    public function generateQRCodeAsPNG(string $url): string
    {
        return 'data:image/png;base64,' . base64_encode($this->generateQrCode($url, 'png'));
    }

    public function generateQrCodeAsSVG(string $url): string
    {
        return $this->generateQrCode($url, 'svg');
    }

    private function generateQrCode(string $url, string $format): string
    {
        try {
            return QrCode::format($format)->size(200)->generate($url);
        } catch (Exception $e) {
            throw new QRCodeGenerationException('Error generating QR code');
        }
    }
}
