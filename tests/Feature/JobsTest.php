<?php

namespace Tests\Feature;

use App\Jobs\FetchAndStoreProfile;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class JobsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fetch_and_store_job()
    {
        Bus::fake();

        $job = new FetchAndStoreProfile('0b764e48721f436d84535d1719a19518');
        Bus::dispatch($job);

        Bus::assertDispatched(FetchAndStoreProfile::class);
    }
}
