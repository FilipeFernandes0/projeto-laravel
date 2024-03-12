<?php

namespace App\Jobs;

use App\Models\Area;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PopulateDatabase implements ShouldQueue
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
        $response = Http::withHeaders($headers)->get('http://api.football-data.org/v4/areas');
        $data = $response->json();

        if (isset($data['areas']) && is_array($data['areas'])) {
            $areas = $data['areas'];
    
            foreach ($areas as $areaData) {
                // dd($areaData);
                // Check if 'id' and 'name' keys exist in $areaData
                if (isset($areaData['id'], $areaData['name'])) {
                    Area::updateOrCreate([
                        'areas_id'=> $areaData['id'],
                        'name' => $areaData['name'],
                        'flag' => $areaData['flag'] ?? 'no flag',
                    ]);

                } 
            }

            

    }
}

}





