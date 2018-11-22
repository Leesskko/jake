<?php

namespace App\Console\Commands;

use App\Service\Video\Drivers\Singlove;
use Illuminate\Console\Command;

class GoGo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spider:go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SpiderGo';

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
     * @return mixed
     */
    public function handle()
    {
        $spider = new Singlove();
        $spider->runTask();

    }
}
