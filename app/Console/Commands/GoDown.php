<?php

namespace App\Console\Commands;

use App\Models\Video;
use App\Service\Video\Drivers\Singlove;
use Illuminate\Console\Command;

class GoDown extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spider:down';

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
     * @return mixed
     */
    public function handle()
    {
        while (true) {
            $video = Video::where('is_get_file_already', '=', 0)
                ->orderBy(\DB::raw('RAND()'))
                ->take(1)
                ->first();
            if ($video) {
                $downloader = new Singlove();
                console("开始下载[{$video->title}]");
                $downloader->DownloadVideo($video->id);
                console("下载完毕");
            } else {
                console("没有可用任务，睡眠");
                sleep(10);
            }

        }
    }
}
