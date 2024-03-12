<?php

namespace App\Jobs;

use App\Models\Standing;
use App\Models\Team;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class StandingsJob implements ShouldQueue
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
            $url = "http://api.football-data.org/v4/competitions/{$competitionId}/standings";

            $response = Http::withHeaders($headers)->get($url);
            $data = $response->json();

            // dd($data);

            if (isset($data['standings']) && is_array($data['standings'])) {

                $standingsGroups = $data['standings'];
                $competitionId = $data['competition']['id'];
                

                

                foreach ($standingsGroups as $group) {
                    $groupes = $group['group'];
                    $stage = $group['stage'];
                    $standings = $group['table'];
                
                    foreach ($standings as $standingsData) {
                        if (isset($standingsData['team']['id'])) {
                            $teamId = $standingsData['team']['id'];
                        
                           
                
                            Standing::updateOrCreate(

                                [
                                    
                                    'position' => $standingsData['position'] ?? 0,
                                    'playedGames' => $standingsData['playedGames'] ?? 0,
                                    'won' => $standingsData['won'] ?? 0,
                                    'draw' => $standingsData['draw'] ?? 0,
                                    'lost' => $standingsData['lost'] ?? 0,
                                    'points' => $standingsData['points'] ?? 0,
                                    'team_id' => $teamId,
                                    'competition_id' => $competitionId,
                                    'stage' => $stage,
                                    'group' => $groupes,

                                ]
                            );

                           dump($standingsData);

                        }

                        
                      
                        
                    }

                    sleep(5);
                  
                }


            }
            
            
           
        }
    }
}




