<?php

namespace App\Jobs;

use App\Models\Season;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SeasonsJob implements ShouldQueue
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

        
            $url = "http://api.football-data.org/v4/competitions/{$competitionId}/?seasons";
            
            $response = Http::withHeaders($headers)->get($url);
            
                $data = $response->json();

                // dd($data);
              
            if (isset($data['seasons']) && is_array($data['seasons'])) {
                $seasons = $data['seasons'];
    
                foreach ($seasons as $seasonData) {
                    $competitionId = $data['id'];
                    Season::updateOrCreate([
                        'seasons_id'=> $seasonData['id'],
                        'startDate' => $seasonData['startDate'],
                        'endDate' => $seasonData['endDate'],
                        'currentMatchday' => $seasonData['currentMatchday'] ?? 0,
                        'winner' => $seasonData['winner']['name'] ?? 'No data',
                        'competition_id' => $competitionId ?? 0,

                    ]);
                    dump($seasonData);

                }
                

                


               
 }
 
sleep(5);



}

}

}
