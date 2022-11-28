<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GraphController extends Controller
{
    /**
     * Return Collection JSON data for Apexcharts.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function collection_graph_api(Request $request) {
        $validated = $request->validate([
            'uuid' => 'string|required',
            'profile' => 'string|required',
            'item' => 'string|required'
        ]);

        $collection = Collection::where([['profile_uuid', '=', $request->profile],
            ['player_uuid', '=', $request->uuid],
            ['name', '=', $request->item],
            ['created_at', '>', Carbon::now()->subHours(24)->toDateTimeString()]])->get();

        $xais = array();
        $data = array();

        foreach ($collection as $collectionItem) {
            $xais[] = $collectionItem->created_at;
            $data[] = $collectionItem->amount;
        }

        return response()->json(['name' => $request->item, 'series' => $data, 'xaxis' => $xais]);
    }

    /**
     * Return Coins JSON data for Apexcharts.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function coins_graph_api(Request $request) {
        $validated = $request->validate([
            'uuid' => 'string|required',
            'profile' => 'string|required',
        ]);

        $collection = Collection::where([['profile_uuid', '=', $request->profile],
            ['player_uuid', '=', $request->uuid],
            ['created_at', '>', Carbon::now()->subHours(24)->toDateTimeString()]])->get();

        $xais = array();
        $data = array();

        foreach ($collection as $collectionItem) {
            $xais[] = $collectionItem->created_at;
            $data[] = $collectionItem->amount;
        }

        return response()->json(['name' => $request->item, 'series' => $data, 'xaxis' => $xais]);
    }
}
