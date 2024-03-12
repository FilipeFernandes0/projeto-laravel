<?php

namespace App\Jobs;

use App\Models\Team;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class TeamsJob implements ShouldQueue
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

        
        $token = 'f0fdb489b4aa4ccb9a4fddac9c2ad29e'; 
        $headers = [
            'X-Auth-Token' => $token,
        ];


        $competitionIds = [
            2000, 2001, 2002, 2003, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2021, 2152
        ];
    
        foreach ($competitionIds as $competitionId) {
            $url = "http://api.football-data.org/v4/competitions/{$competitionId}/teams";
            
            $response = Http::withHeaders($headers)->get($url);
            
                $data = $response->json();
                
                // dd($data);
        
            // Check if 'teams' key exists in the API response
            if (isset($data['teams']) && is_array($data['teams'])) {
                $teams = $data['teams'];
                $competitionId = $data['competition']['id'];

            
                foreach ($teams as $teamData) {
                   
                    
                    Team::updateOrCreate([
                        'teams_id' => $teamData['id'],
                        'name'    => $teamData['name'],
                        'founded' => $teamData['founded'] ?? 0, 
                        'stadium' => $teamData['venue'] ?? 'Unknown Stadium',
                        'crest'=> $teamData['crest'] ??'no link',
                        'competition_id' => $competitionId, 
                        
                    ]);

                    
                }

    }
    sleep(5);
 }



}

}

