<?php

namespace Tests\Request;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class ProfileRequestTest extends TestCase
{
    use RefreshDatabase;
    // use WithoutMiddleware;
    /**
     * get profile create path
     *
     * @return void
     */
    public function testGetProfileCreatePath()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/profile/create');

        $response->assertStatus(200);
    }

    /**
     * post profile create validation tel
     *
     * @return void
     */
    public function testPostProfileCreatePathTel_failed()
    {
        $user = factory(User::class)->create();

        // 必須チェック
        $data = [];
        $response = $this->actingAs($user)->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['tel' => '電話番号は必須です']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');

        // 下限チェック
        $data = ['tel' => '0123456'];
        $response = $this->actingAs($user)->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['tel' => '電話番号は8桁から11桁の間で入力してください']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');

        // 上限チェック
        $data = ['tel' => '012345678901'];
        $response = $this->actingAs($user)->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['tel' => '電話番号は8桁から11桁の間で入力してください']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');

        // 数値チェック
        $data = ['tel' => str_random(11)];
        $response = $this->actingAs($user)->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['tel' => '電話番号は数字を入力してください']);
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
        $user = factory(User::class)->create();

        // 必須チェック
        $data = [];
        $response = $this->actingAs($user)->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['age' => '年齢は必須です']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');

        // 下限チェック
        $data = ['age' => '19'];
        $response = $this->actingAs($user)->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['age' => '年齢は20以上で入力してください']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');

        // 上限チェック
        $data = ['age' => '81'];
        $response = $this->actingAs($user)->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['age' => '年齢は80以下で入力してください']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');

        // 数値チェック
        $data = ['age' => str_random(2)];
        $response = $this->actingAs($user)->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['age' => '年齢は数字を入力してください']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');
    }

    /**
     * post profile create validation sex
     *
     * @return void
     */
    public function testPostProfileCreatePathSex_failed()
    {
        $user = factory(User::class)->create();

        // 必須チェック
        $data = [];
        $response = $this->actingAs($user)->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['sex' => '性別は必須です']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');

        // 範囲チェック
        $data = ['sex' => 3];
        $response = $this->actingAs($user)->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['sex' => '正しい性別を入力してください']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');
    }


    /**
     * post profile create validation introduction
     *
     * @return void
     */
    public function testPostProfileCreatePathIntroduction_failed()
    {
        $user = factory(User::class)->create();

        // 必須チェック
        $data = [];
        $response = $this->actingAs($user)->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['introduction' => '自己紹介は必須です']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');

        // 上限チェック
        $data = ['introduction' => str_random(256)];
        $response = $this->actingAs($user)->from('/profile/create')
            ->post('/profile/create', $data);

        $response->assertSessionHasErrors(['introduction' => '自己紹介は255文字以下で入力してください']);
        $response->assertStatus(302)
            ->assertRedirect('/profile/create');
    }
}
