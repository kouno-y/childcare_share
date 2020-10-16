<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileCreateTest extends DuskTestCase
{
    /**
     * A Dusk test example.
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
}
