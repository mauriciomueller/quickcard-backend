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

    public function generateQrCode(string $url): string
    {
        try {
            $qrCode = QrCode::format('svg')->size(200)->generate($url);
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
