<?php

namespace Tests\Unit;

use App\Http\Controllers\ProfileController;
use Tests\TestCase;

class StoreProfileTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_calling_store_profile_method()
    {
        $profile = new ProfileController();
        $profile->store('0b764e48721f436d84535d1719a19519', '30e4e490f8424ec986304c597030adc9,30e4e490f8424ec986304c597030add9', false, microtime(true));
        $this->assertTrue(true);
    }
}
