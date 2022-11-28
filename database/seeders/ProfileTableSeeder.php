<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = new Profile();
        $profile->uuid = '0b764e48721f436d84535d1719a19518';
        $profile->players = '6e5848b5bdd14874819f51ac0921f440,30e4e490f8424ec986304c597030adc8';
        $profile->tracked = true;
        $profile->last_polled = microtime(true);
        $profile->save();
    }
}
