<?php

namespace App\Console\Commands;

use App\Jobs\SeasonsJob;
use Illuminate\Console\Command;

class SeasonsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seasons:run';

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
        dispatch(new SeasonsJob());
        $this->info('seasons dispateched successfully.');

    }
}
