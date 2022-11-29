<?php

namespace Tests\Unit;

use App\Http\Controllers\SkillController;
use Tests\TestCase;

class StoreSkillTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_calling_skill_profile_method()
    {
        $skill = new SkillController();
        $skill->store('0b764e48721f436d84535d1719a19519', '30e4e490f8424ec986304c597030adc9', 'combat', 999);
        $this->assertTrue(true);
    }
}
