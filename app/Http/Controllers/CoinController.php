<?php

namespace App\Http\Controllers;

use App\Models\Coin;

class CoinController extends Controller
{
    /**
     * Stores the coins in the database
     *
     * @param $profile
     * @param $player
     * @param $coin
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($profile, $player, $coin)
    {
        $coins = new Coin();
        $coins->profile = $profile;
        $coins->player = $player;
        $coins->coins = $coin;
        $coins->save();

        return response()->json(['success' => true]);
    }
}
