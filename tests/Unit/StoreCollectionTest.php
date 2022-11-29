<?php

namespace Tests\Unit;

use App\Http\Controllers\CollectionController;
use Tests\TestCase;

class StoreCollectionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_calling_store_collection_method()
    {
        $collection = new CollectionController();
        $collection->store('0b764e48721f436d84535d1719a19519', '30e4e490f8424ec986304c597030adc9', 'LOG', 999);
        $this->assertTrue(true);
    }
}
