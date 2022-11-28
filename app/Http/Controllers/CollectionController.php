<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Carbon\Carbon;

class CollectionController extends Controller
{
    /**
     * Get all player collections progress from a profile within the past 24 hours.
     *
     * @param $profile
     * @param $player
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($profile, $player)
    {
        $collection = Collection::where([
            ['profile', '=', $profile],
            ['player', '=', $player],
            ['created_at', '>', Carbon::now()->subHours(24)->toDateTimeString()],
        ])->get();

        return response()->json($collection);
    }
}
