<?php

namespace Tests\Feature;

use Tests\TestCase;

class GraphAPITest extends TestCase
{
    /**
     * Test to ensure collection graph API returns expected json structure
     *
     * @return void
     */
    public function test_graph_collection_returns_expected_json()
    {
        // Run Http Test
        $response = $this->post('/api/graph/collection', [
            'item' => 'cobblestone',
            'uuid' => '30e4e490f8424ec986304c597030adc8',
            'profile' => '0b764e48721f436d84535d1719a19518',
        ]);

        // Ensure response is 200 & JSON is expected
        $response->assertStatus(200)->assertJsonStructure([
            'name',
            'series' => [],
            'xaxis' => [],
        ]);
    }

    /**
     * Test to ensure coins graph API returns expected json structure
     *
     * @return void
     */
    public function test_graph_coins_returns_expected_json()
    {
        // Run Http Test
        $response = $this->post('/api/graph/coins', [
            'uuid' => '30e4e490f8424ec986304c597030adc8',
            'profile' => '0b764e48721f436d84535d1719a19518',
        ]);

        // Ensure response is 200 & JSON is expected
        $response->assertStatus(200)->assertJsonStructure([
            'name',
            'series' => [],
            'xaxis' => [],
        ]);
    }
}
