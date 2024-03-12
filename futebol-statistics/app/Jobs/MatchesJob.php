<?php

namespace App\Jobs;

use App\Models\GameMatch;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class MatchesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $token = 'f0fdb489b4aa4ccb9a4fddac9c2ad29e'; // Replace with your actual API token
        $headers = [
            'X-Auth-Token' => $token,
        ];

        $competitionIds = [
            2000, 2001, 2002, 2003, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2021, 2152
        ];

        foreach ($competitionIds as $competitionId) {
            $url = "http://api.football-data.org/v4/competitions/{$competitionId}/matches";

            $response = Http::withHeaders($headers)->get($url);
            $data = $response->json();


            if (isset($data['matches']) && is_array($data['matches'])) {
                $matches = $data['matches'];

                foreach ($matches as $matchesData) {
                    if (isset($matchesData['homeTeam']['id']) && isset($matchesData['awayTeam']['id'])) {

                        $awayTeamId = $matchesData['awayTeam']['id'];
                        $homeTeamId = $matchesData['homeTeam']['id'];
                        $competitionId = $matchesData['competition']['id'];
                        $utcDate = Carbon::parse($matchesData['utcDate'])->toDateTimeString();



                        GameMatch::updateOrCreate(
                            [
                                'matches_id' => $matchesData['id'],
                                'utc_date' => $utcDate,
                                'home_team_id' => $homeTeamId ?? 0,
                                'away_team_id' => $awayTeamId ?? 0,
                                'matchday' => $matchesData['matchday'] ?? 0,

                                'score' => isset($matchesData['score']['fullTime']['home']) &&
                                    isset($matchesData['score']['fullTime']['away'])
                                    ? $matchesData['score']['fullTime']['home'] . '-' . $matchesData['score']['fullTime']['away']
                                    : '0-0',
                               
                                'winner' => $matchesData['score']['winner'] ?? 'No Data',
                                'competition_id'=> $competitionId
                            ]
                        );
                        dump($matchesData);

                    }

                }
            }
            
            sleep(3);
        }
    }
}
