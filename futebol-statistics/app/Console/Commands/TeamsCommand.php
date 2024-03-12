<?php

namespace App\Console\Commands;

use App\Jobs\TeamsJob;
use Illuminate\Console\Command;

class TeamsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teams:run';

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
        dispatch(new TeamsJob());
        $this->info('teams dispateched successfully.');

    }
}
