<?php

namespace App\Http\Controllers;

use App\Models\Skill;

class SkillController extends Controller
{

    /**
     * Stores the skills in the database
     *
     * @param $profile
     * @param $player
     * @param $skill
     * @param $xp
     * @return void
     */
    public function store($profile, $player, $skill, $xp) {
            $skillNew = new Skill();
            $skillNew->profile = $profile;
            $skillNew->player = $player;
            $skillNew->skill = $skill;
            $skillNew->xp = $xp;
            $skillNew->save();
    }
}
