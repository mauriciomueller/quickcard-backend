<?php

namespace App\Services;

use App\Models\UserQueryCard;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserQueryCardService
{
    public function createUserQueryCard(array $data): UserQueryCard
    {
        $uniqueSlug = $this->generateUniqueSlug($data['username']);

        try {
            $userQueryCard = UserQueryCard::create([
                'username' => $data['username'],
                'slug' => $uniqueSlug,
                'linkedin_url' => $data['linkedInUrl'],
                'github_url' => $data['gitHubUrl'],
            ]);
        } catch (Exception $e) {
            throw new DatabaseException('Error saving UserQueryCard');
        }

        return $userQueryCard;
    }

    public function generateQrCodeAsPNG(string $url): string
    {
        try {
            $qrCode = $this->generateQrCode($url, 'png');
        } catch (Exception $e) {
            throw new QRCodeGenerationException('Error generating QR code');
        }

        return $qrCode;
    }

    public function generateQrCodeAsSVG(string $url): string
    {
        try {
            $qrCode = $this->generateQrCode($url, 'svg');
        } catch (Exception $e) {
            throw new QRCodeGenerationException('Error generating QR code');
        }

        return $qrCode;
    }

    private function generateQrCode(string $url, string $format): string
    {
        try {
            $qrCode = 'data:image/png;base64,' . base64_encode(QrCode::format('png')->size(200)->generate($url));
        } catch (Exception $e) {
            throw new QRCodeGenerationException('Error generating QR code');
        }

        return $qrCode;
    }

    private function generateUniqueSlug(string $username): string
    {
        $slug = Str::slug($username);
        $uniqueSlug = $slug;
        $counter = 1;

        while (UserQueryCard::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $counter;
            $counter++;
        }

        return $uniqueSlug;
    }
}
