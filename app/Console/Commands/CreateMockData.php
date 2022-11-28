<?php

namespace App\Console\Commands;

use App\Http\Controllers\APICallLoggerController;
use App\Http\Controllers\SkillController;
use App\Models\Coin;
use App\Models\Collection;
use App\Models\Profile;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CreateMockData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mock:api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create mock data in database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Send request for Skyblock data for the profile
        $request = Http::withHeaders([
            'API-Key' => env('HYPIXEL_API_KEY'),
        ])->get('https://api.hypixel.net/skyblock/profile?profile=0b764e48721f436d84535d1719a19518');
        new APICallLoggerController('mock');

        // Fetch the profile from the database & decouple player uuids
        $dbProfile = Profile::get()->where('uuid', '=', '0b764e48721f436d84535d1719a19518')->first();
        $playerUuids = explode(',', $dbProfile->players);

        // Decode the request
        $json = json_decode($request, false, 2147483647);

        // Loop through the player profiles & store profile into the database
        foreach ($playerUuids as $player) {
            // Check and store skills in the database
            if (isset($json->profile->members->$player->coin_purse)) {
                $coin = new Coin();
                $coin->profile = '0b764e48721f436d84535d1719a19518';
                $coin->player = $player;
                $coin->coins = $json->profile->members->$player->coin_purse;
                $coin->save();
            }

            // Check the collection is set & store in db if it is
            if (isset($json->profile->members->$player->collection)) {
                foreach ($json->profile->members->$player->collection as $collection => $value) {
                    $dbCollection = new Collection();
                    $dbCollection->profile = '0b764e48721f436d84535d1719a19518';
                    $dbCollection->player = $player;
                    $dbCollection->name = $collection;
                    $dbCollection->amount = $value;
                    $dbCollection->save();
                }
            }

            // Check and store skills in the database
            if (isset($json->profile->members->$player->experience_skill_runecrafting)) {
                $skill = new SkillController();
                $skill->store('0b764e48721f436d84535d1719a19518', $player, 'runecrafting', $json->profile->members->$player->experience_skill_runecrafting);
                $skill->store('0b764e48721f436d84535d1719a19518', $player, 'mining', $json->profile->members->$player->experience_skill_mining);
                $skill->store('0b764e48721f436d84535d1719a19518', $player, 'alchemy', $json->profile->members->$player->experience_skill_alchemy);
                $skill->store('0b764e48721f436d84535d1719a19518', $player, 'taming', $json->profile->members->$player->experience_skill_taming);
                $skill->store('0b764e48721f436d84535d1719a19518', $player, 'combat', $json->profile->members->$player->experience_skill_combat);
                $skill->store('0b764e48721f436d84535d1719a19518', $player, 'farming', $json->profile->members->$player->experience_skill_farming);
                $skill->store('0b764e48721f436d84535d1719a19518', $player, 'enchanting', $json->profile->members->$player->experience_skill_enchanting);
                $skill->store('0b764e48721f436d84535d1719a19518', $player, 'social', $json->profile->members->$player->experience_skill_social2);
                $skill->store('0b764e48721f436d84535d1719a19518', $player, 'fishing', $json->profile->members->$player->experience_skill_fishing);
                $skill->store('0b764e48721f436d84535d1719a19518', $player, 'foraging', $json->profile->members->$player->experience_skill_foraging);
                $skill->store('0b764e48721f436d84535d1719a19518', $player, 'carpentry', $json->profile->members->$player->experience_skill_carpentry);
            }
        }

        return Command::SUCCESS;
    }
}
