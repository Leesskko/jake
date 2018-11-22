<?php

namespace App\Listeners;

use App\Events\VideoDownloaded;
use App\Models\Video;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddWaterMark
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  VideoDownloaded $event
     * @return void
     */
    public function handle(VideoDownloaded $event)
    {
        console('开始为视频加水印');
        //dd(Video::find($event->id));
    }
}
