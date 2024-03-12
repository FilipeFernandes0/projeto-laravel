<?php

namespace App\Jobs;

use App\Models\Area;
use App\Models\Competition;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CompetitionsJob implements ShouldQueue
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

        $response = Http::withHeaders($headers)->get('http://api.football-data.org/v4/competitions/');
        $data = $response->json();

        // dump($data);

        if (isset($data['competitions']) && is_array($data['competitions'])) {
            $competitions = $data['competitions'];
            foreach ($competitions as $competitionData) {
                $areaId = $competitionData['area']['id'];

                Competition::updateOrCreate([
                    'competitions_id'      => $competitionData['id'],
                    'name'    => $competitionData['name'],
                    'type'    => $competitionData['type'],
                    'emblem'=> $competitionData['emblem'] ?? 'no emblem',
                    'area_id' => $areaId,
                    
                ]);
            }
        }
    }
}
