<?php

namespace App\Http\Controllers;

use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Store the skyblock profile.
     *
     * @param $uuid
     * @param $players
     * @param $tracked
     * @param $last_polled
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($uuid, $players, $tracked, $last_polled)
    {
        $profile = new Profile();
        $profile->uuid = $uuid;
        $profile->players = $players;
        $profile->tracked = $tracked;
        $profile->last_polled = $last_polled;
        $profile->save();

        return response()->json(['success' => true]);
    }
}
