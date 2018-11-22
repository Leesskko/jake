<?php

namespace App\Listeners;

use App\Events\VideoDownloaded;
use App\Models\Video;
use FFMpeg\FFMpeg;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class GetInfo
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
        console('获取视频信息数据!');
        $video = Video::find($event->id);
        $filepath = Storage::disk('video')->path($video->filepath);
        $ffmpeg = FFMpeg::create(array(
            'ffmpeg.binaries' => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe',
            'timeout' => 60 * 60 * 5,
            'ffmpeg.threads' => 12,
        ));
        $videofile = $ffmpeg->open($filepath);
        $format = $videofile->getFormat();
        $pinfo = pathinfo($format->get('filename'));
        $marks = array_reverse(explode('/', $pinfo['dirname']));
        $video->duration = $format->get('duration');
        $video->size = $format->get('size');
        $video->file_md5 = md5(Storage::disk('video')->get($video->filepath));
        $video->save();
        console('获取视频信息数据完成!');
    }
}
