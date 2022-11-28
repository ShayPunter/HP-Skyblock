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
            $skillNew->profile_uuid = $profile;
            $skillNew->player_uuid = $player;
            $skillNew->name = $skill;
            $skillNew->xp = $xp;
            $skillNew->save();
    }
}
