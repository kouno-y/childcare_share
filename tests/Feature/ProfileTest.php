<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $user = factory(User::class)->create();

        $data = [
            'tel' => '09012345678',
            'age' => 20,
            'sex' => 1,
            'introduction' => str_random(255),
        ];
        $response = $this->actingAs($user)
            ->post('/profile/create', $data);

        $response->assertStatus(200)
            ->assertDatabaseHas('profiles', $data);
    }
}
