<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileControllerTest extends TestCase
{
    /**
     * get profile create path
     *
     * @return void
     */
    public function testGetProfileCreatePath()
    {
        $response = $this->get('/profile/create');

        $response->assertStatus(200);
    }

    /**
     * post profile create validation tel
     *
     * @return void
     */
    public function testPostProfileCreatePathTel_failed()
    {
        // 必須チェック
        $data = [];
        $response = $this->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['tel' => 'The tel field is required.']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');

        // 下限チェック
        $data = ['tel' => '0123456'];
        $response = $this->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['tel' => 'The tel must be between 8 and 11 digits.']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');

        // 上限チェック
        $data = ['tel' => '012345678901'];
        $response = $this->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['tel' => 'The tel must be between 8 and 11 digits.']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');

        // 数値チェック
        $data = ['tel' => str_random(11)];
        $response = $this->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['tel' => 'The tel must be a number.']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');
    }

    /**
     * post profile create validation age
     *
     * @return void
     */
    public function testPostProfileCreatePathAge_failed()
    {
        // 必須チェック
        $data = [];
        $response = $this->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['age' => 'The age field is required.']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');

        // 下限チェック
        $data = ['age' => '19'];
        $response = $this->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['age' => 'The age must be at least 20.']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');

        // 上限チェック
        $data = ['age' => '81'];
        $response = $this->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['age' => 'The age may not be greater than 80.']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');

        // 数値チェック
        $data = ['age' => str_random(2)];
        $response = $this->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['age' => 'The age must be a number.']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');
    }

    /**
     * post profile create validation sex
     *
     * @return void
     */
    public function testPostProfileCreatePathWithoutSex_failed()
    {
        $data = [];
        $response = $this->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['sex' => 'The sex field is required.']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');
    }
}
