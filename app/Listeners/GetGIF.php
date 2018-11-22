<?php

namespace App\Listeners;

use App\Events\VideoDownloaded;
use App\Models\Video;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use Illuminate\Support\Facades\Storage;

class GetGIF
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
        console('生成GIF缩略图!');
        $video = Video::find($event->id);
        $fp = pathinfo($video->filepath);
        $gifpath = Storage::disk('video')->path($fp['dirname'] . "/screenshot.gif");
        $filepath = Storage::disk('video')->path($video->filepath);
        $ffmpeg = FFMpeg::create(array(
            'ffmpeg.binaries' => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe',
            'timeout' => 60 * 60 * 5,
            'ffmpeg.threads' => 12,
        ));
        $videofile = $ffmpeg->open($filepath);
        $time = round($video->duration);
        $q = 0;
        if ($time > 20) {
            $q = $time / 2;
        }

        $videofile->gif(TimeCode::fromSeconds(round($q)), new Dimension(320, 240), 8)
            ->save($gifpath);
        $video->screensnap = $fp['dirname'] . "/screenshot.gif";
        $video->save();
        console('缩略图生成完毕!');
    }
}
