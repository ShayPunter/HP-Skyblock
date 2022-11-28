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
            'API-Key' => env('HYPIXEL_API_KEY')
        ])->get('https://api.hypixel.net/skyblock/profile?profile=' . $this->profile);
        new APICallLoggerController('scheduled');


        // Fetch the profile from the database & decouple player uuids
        $dbProfile = Profile::get()->where('uuid', '=', $this->profile)->first();
        $playerUuids = explode(',', $dbProfile->players);

        // Decode the request
        $json = json_decode($request, false, 2147483647);

        // Loop through the player profiles & store profile into the database
        foreach ($playerUuids as $player) {

            // Check and store skills in the database
            if (isset($json->profile->members->$player->coin_purse)) {
                $coin = new Coin();
                $coin->profile_uuid = $this->profile;
                $coin->player_uuid = $player;
                $coin->coins = $json->profile->members->$player->coin_purse;
                $coin->save();
            }

            // Check the collection is set & store in db if it is
            if (isset($json->profile->members->$player->collection)) {

                foreach ($json->profile->members->$player->collection as $collection => $value) {
                    $dbCollection = new Collection();
                    $dbCollection->profile_uuid = $this->profile;
                    $dbCollection->player_uuid = $player;
                    $dbCollection->name = $collection;
                    $dbCollection->amount = $value;
                    $dbCollection->save();
                }
            }

            // Check and store skills in the database
            if (isset($json->profile->members->$player->experience_skill_runecrafting)) {

                $skill = new SkillController();
                $skill->store($this->profile, $player, "runecrafting", $json->profile->members->$player->experience_skill_runecrafting);
                $skill->store($this->profile, $player, "mining", $json->profile->members->$player->experience_skill_mining);
                $skill->store($this->profile, $player, "alchemy", $json->profile->members->$player->experience_skill_alchemy);
                $skill->store($this->profile, $player, "taming", $json->profile->members->$player->experience_skill_taming);
                $skill->store($this->profile, $player, "combat", $json->profile->members->$player->experience_skill_combat);
                $skill->store($this->profile, $player, "farming", $json->profile->members->$player->experience_skill_farming);
                $skill->store($this->profile, $player, "enchanting", $json->profile->members->$player->experience_skill_enchanting);
                $skill->store($this->profile, $player, "social", $json->profile->members->$player->experience_skill_social2);
                $skill->store($this->profile, $player, "fishing", $json->profile->members->$player->experience_skill_fishing);
                $skill->store($this->profile, $player, "foraging", $json->profile->members->$player->experience_skill_foraging);
                $skill->store($this->profile, $player, "carpentry", $json->profile->members->$player->experience_skill_carpentry);

            }
        }

        return Command::SUCCESS;
    }
}