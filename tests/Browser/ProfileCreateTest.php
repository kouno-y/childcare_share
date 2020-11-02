<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileCreateTest extends DuskTestCase
{
    /**
     * 画面表示テスト
     *
     * @return void
     */
    public function testView()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/profile/create')
                    ->assertTitle('プロフィール登録｜育シェア')
                    ->assertSeeIn('@tel', '電話番号')
                    ->assertSeeIn('@age', '年齢')
                    ->assertSeeIn('@sex', '性別')
                    ->assertSeeIn('@introduction', '自己紹介')
                    ->assertSeeIn('@register', 'プロフィール登録');
        });
    }

    /**
     * tel validation
     *
     * @return void
     */
    public function testTelValidation()
    {
        // エラー表示チェック（個別のエラーはRequestのテストで確認済）
        $this->browse(function (Browser $browser) {
            $browser->visit('profile/create')
                    ->type('tel', '0123456')
                    ->type('age', '20')
                    ->type('introduction', str_random(10))
                    ->press('プロフィール登録')
                    ->assertPathIs('/childcare_share/public/profile/create')
                    ->assertSeeIn('@tel_error', '電話番号は8桁から11桁の間で入力してください')
                    ->screenshot('request/profile/create/short_tel');
        });
    }

    /**
     * age validation
     *
     * @return void
     */
    public function testAgeValidation()
    {
        // エラー表示チェック（個別のエラーはRequestのテストで確認済）
        $this->browse(function (Browser $browser) {
            $browser->visit('profile/create')
                    ->type('tel', '01234567')
                    ->type('age', '19')
                    ->type('introduction', str_random(10))
                    ->press('プロフィール登録')
                    ->assertPathIs('/childcare_share/public/profile/create')
                    ->assertSeeIn('@age_error', '年齢は20以上で入力してください')
                    ->screenshot('request/profile/create/young_age');
        });
    }

    /**
     * introduction validation
     * sex validation
     * @return void
     */
    public function testIntroductionValidation()
    {
        // エラー表示チェック（個別のエラーはRequestのテストで確認済）
        $this->browse(function (Browser $browser) {
            $browser->visit('profile/create')
                    ->type('tel', '01234567')
                    ->type('age', '20')
                    ->type('introduction', str_random(256))
                    ->press('プロフィール登録')
                    ->assertPathIs('/childcare_share/public/profile/create')
                    ->assertSeeIn('@introduction_error', '自己紹介は255文字以下で入力してください')
                    ->screenshot('request/profile/create/long_introduction');
        });
    }
}
