<?php

namespace App\Console\Commands;

use App\Jobs\CompetitionsJob;
use App\Jobs\MatchesJob;
use App\Jobs\PersonJob;
use App\Jobs\PopulateDatabase;
use App\Jobs\SeasonsJob;
use App\Jobs\StandingsJob;
use App\Jobs\TeamsJob;
use Illuminate\Console\Command;

class RunAllJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'areas:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run custom jobs';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     *@return void
     */
    public function handle()
    {
        dispatch(new PopulateDatabase());
        

        $this->info('area dispateched successfully.');



    }
}
