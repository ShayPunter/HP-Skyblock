<?php

namespace App\Jobs;

use App\Http\Controllers\APICallLoggerController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\SkillController;
use App\Models\Collection;
use App\Models\Profile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class FetchAndStoreProfile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $profile;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($uuid)
    {
        $this->profile = $uuid;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Send request for Skyblock data for the profile
        $request = Http::withHeaders([
            'API-Key' => env('HYPIXEL_API_KEY'),
        ])->get('https://api.hypixel.net/skyblock/profile?profile='.$this->profile);
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
                $coin = new CoinController();
                $coin->store($this->profile, $player, $json->profile->members->$player->coin_purse);
            }

            // Check the collection is set & store in db if it is
            if (isset($json->profile->members->$player->collection)) {
                foreach ($json->profile->members->$player->collection as $collection => $value) {
                    $collectionController = new CollectionController();
                    $collectionController->store($this->profile, $player, $collection, $value);
                }
            }

            // Check and store skills in the database
            if (isset($json->profile->members->$player->experience_skill_runecrafting)) {
                $skill = new SkillController();
                $skill->store($this->profile, $player, 'runecrafting', $json->profile->members->$player->experience_skill_runecrafting);
                $skill->store($this->profile, $player, 'mining', $json->profile->members->$player->experience_skill_mining);
                $skill->store($this->profile, $player, 'alchemy', $json->profile->members->$player->experience_skill_alchemy);
                $skill->store($this->profile, $player, 'taming', $json->profile->members->$player->experience_skill_taming);
                $skill->store($this->profile, $player, 'combat', $json->profile->members->$player->experience_skill_combat);
                $skill->store($this->profile, $player, 'farming', $json->profile->members->$player->experience_skill_farming);
                $skill->store($this->profile, $player, 'enchanting', $json->profile->members->$player->experience_skill_enchanting);
                $skill->store($this->profile, $player, 'social', $json->profile->members->$player->experience_skill_social2);
                $skill->store($this->profile, $player, 'fishing', $json->profile->members->$player->experience_skill_fishing);
                $skill->store($this->profile, $player, 'foraging', $json->profile->members->$player->experience_skill_foraging);
                $skill->store($this->profile, $player, 'carpentry', $json->profile->members->$player->experience_skill_carpentry);
            }
        }
    }
}
