<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class GenerateQRCodeImageTest extends TestCase
{
    use RefreshDatabase;


    public function test_generate_qr_code_image_returns_svg(): void
    {
        $data = [
            'username' => 'John Doe',
            'linkedInUrl' => 'https://www.linkedin.com/in/johndoe',
            'gitHubUrl' => 'https://github.com/johndoe',
        ];

        $this->post(Route('generateQRCodeImage.store'), $data)
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'image/svg+xml')
            ->assertSee('<svg', false);
    }
    public function test_generate_qr_code_image_with_long_username_fails(): void
    {
        $data = [
            'username' => str_repeat('a', 51),
            'linkedInUrl' => 'https://www.linkedin.com/in/johndoe',
            'gitHubUrl' => 'https://github.com/johndoe',
        ];

        $this->post(Route('generateQRCodeImage.store'), $data)
            ->assertStatus(422);
    }

    public function test_generate_qr_code_image_with_long_linkedin_url_fails(): void
    {
        $data = [
            'username' => 'John Doe',
            'linkedInUrl' => 'https://www.linkedin.com/in/' . str_repeat('a', 151),
            'gitHubUrl' => 'https://github.com/johndoe',
        ];

        $this->post(Route('generateQRCodeImage.store'), $data)
            ->assertStatus(422);
    }

    public function test_generate_qr_code_image_with_long_github_url_fails(): void
    {
        $data = [
            'username' => 'John Doe',
            'linkedInUrl' => 'https://www.linkedin.com/in/johndoe',
            'gitHubUrl' => 'https://github.com/' . str_repeat('a', 151),
        ];

        $this->post(Route('generateQRCodeImage.store'), $data)
            ->assertStatus(422); // Validation error
    }


    public function test_generate_qr_code_image_with_empty_username_fails(): void
    {
        $data = [
            'username' => '',
            'linkedInUrl' => 'https://www.linkedin.com/in/johndoe',
            'gitHubUrl' => 'https://github.com/johndoe',
        ];

        $this->post(Route('generateQRCodeImage.store'), $data)
            ->assertStatus(422)
            ->assertJsonValidationErrors('username');
    }

    public function test_generate_qr_code_image_with_empty_linkedin_url_fails(): void
    {
        $data = [
            'username' => 'John Doe',
            'linkedInUrl' => '',
            'gitHubUrl' => 'https://github.com/johndoe',
        ];

        $this->post(Route('generateQRCodeImage.store'), $data)
            ->assertStatus(422)
            ->assertJsonValidationErrors('linkedInUrl');
    }

    public function test_generate_qr_code_image_with_empty_github_url_fails(): void
    {
        $data = [
            'username' => 'John Doe',
            'linkedInUrl' => 'https://www.linkedin.com/in/johndoe',
            'gitHubUrl' => '',
        ];

        $this->post(Route('generateQRCodeImage.store'), $data)
            ->assertStatus(422)
            ->assertJsonValidationErrors('gitHubUrl');
    }

    public function test_generate_qr_code_image_with_invalid_linkedin_url_fails(): void
    {
        $data = [
            'username' => 'John Doe',
            'linkedInUrl' => 'https://www.linkedin.com/invalid/johndoe',
            'gitHubUrl' => 'https://github.com/johndoe',
        ];

        $this->post(Route('generateQRCodeImage.store'), $data)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['linkedInUrl']);
    }

    public function test_generate_qr_code_image_with_invalid_github_url_fails(): void
    {
        $data = [
            'username' => 'John Doe',
            'linkedInUrl' => 'https://www.linkedin.com/in/johndoe',
            'gitHubUrl' => 'https://gitlab.com/johndoe',
        ];

        $this->post(Route('generateQRCodeImage.store'), $data)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['gitHubUrl']);
    }

}
