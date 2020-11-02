<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ランダム
        DB::table('profiles')->insert([
            'user_id' => 1,
            'tel' => '09012341234',
            'age' => 20,
            'sex' => 1,
            'introduction' => str_random(512),
        ]);

        DB::table('profiles')->insert([
            'user_id' => 2,
            'tel' => '09012341234',
            'age' => 20,
            'sex' => 2,
            'introduction' => str_random(512),
        ]);

        DB::table('profiles')->insert([
            'user_id' => 3,
            'tel' => '09012341234',
            'age' => 20,
            'sex' => 2,
            'introduction' => str_random(512),
        ]);
    }
}
