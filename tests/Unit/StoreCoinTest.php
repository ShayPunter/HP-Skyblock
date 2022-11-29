<?php

namespace Tests\Unit;

use App\Http\Controllers\CoinController;
use Tests\TestCase;

class StoreCoinTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_calling_store_coin_method()
    {
        $coin = new CoinController();
        $coin->store('0b764e48721f436d84535d1719a19518', '30e4e490f8424ec986304c597030adc8', 999);
        $this->assertTrue(true);
    }
}
