<?php

namespace App\Console\Commands;

use App\Jobs\CompetitionsJob;
use Illuminate\Console\Command;

class CompetitionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'competitions:run';

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
        dispatch(new CompetitionsJob());

        $this->info('competitions dispateched successfully.');


    }
}
