<?php

namespace App\Jobs;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DownloadVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $video;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($videoid)
    {
        $this->video = Video::find($videoid);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

    }
}
