<?php

namespace App\Console\Commands;

use App\Jobs\StandingsJob;
use Illuminate\Console\Command;

class StandingsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'standings:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return void
     */
    public function handle()
    {
        dispatch(new StandingsJob());
        $this->info('standings dispateched successfully.');

    }
}
