<?php

namespace Tests\Feature;

use App\Models\UserQuickCard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class GetUserQuickCardTest extends TestCase
{
    use RefreshDatabase;

   public function test_get_user_quick_card_data_by_slug(): void
   {
        $createUserQuickCard = UserQuickCard::factory()->create();

       $this->get(route('user_quick_card.index', ['slug' => $createUserQuickCard->slug]))
           ->assertStatus(200)
           ->assertJsonStructure([
               'success',
               'result' => [
                   'username',
                   'linkedin_url',
                    'github_url',
               ],
               'message',
           ])
       ;
   }
}
