<?php
/**
 * Created by PhpStorm.
 * User: Ekko
 * Date: 2018/11/19
 * Time: 上午 11:05
 */

namespace App\Service\Video;

use App\Events\VideoDownloaded;
use App\Models\Video;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use JakubOnderka\PhpConsoleColor\ConsoleColor;

class Base implements Movie
{

    private $parameterDefine;

    const NORMAL_DOWNLOAD = 1;
    const FFMPEG_DOWNLOAD = 2;

    protected function setParam($k, $v)
    {
        $this->$k = $v;
    }

    protected function savepic($url)
    {
        $urlinfo = parse_url($url);
        $pathinfo = pathinfo($urlinfo['path']);
        $ext = $pathinfo['extension'];
        $data = $this->getHtml($url);

        $filename = "{$this->type}/" . date('Ymd') . "/" . md5($data) . "." . $ext;
        Storage::disk('pic')->put($filename, $data);
        return $filename;
    }


    protected function console($text, $color = 201)
    {
        $consolecolor = new ConsoleColor();
        echo $consolecolor->apply("color_$color", $text) . "\r\n";
    }

    protected function getHtml($url, $formdata = [], $header = [])
    {
        $client = new Client();
        $method = $formdata == [] ? 'GET' : 'POST';
        $options = [
            'verify' => false
        ];
        if ($formdata != []) {
            $options['form_params'] = $formdata;
        }
        if ($header != []) {
            $options['headers'] = $header;
        }
        $res = $client->request($method, $url, $options);
        return $res->getBody()->getContents();
    }

    /**
     * Base constructor.
     */
    public function __construct()
    {

    }

    public function cleanUpDirs()
    {
        dd(Storage::disk('video')->directories());
    }

    public function GetVideoInfo()
    {
        // TODO: Implement GetVideoInfo() method.
    }

    public function GetVideoList($taskId)
    {
        // TODO: Implement GetVideoList() method.
    }

    public function DownloadVideo($id)
    {
        console('开始下载!');
        $video = Video::find($id);
        switch ($video->get_type) {
            case 1:
                break;
            case 2:
                $videopath = $this->GetM3u8($video->url);
                $fakepath = $this->type . "/" . $videopath . "/video.mp4";
                $video->filepath = $fakepath;
                $video->is_get_file_already = time();
                $video->mark = $videopath;
                $video->save();
                event(new VideoDownloaded($video->id));
                break;
        }
    }

    public function ListMap()
    {
        // TODO: Implement ListMap() method.
    }

    public function GetM3u8($url)
    {   //$dt = '20181120040707';

        $dt = date('Ymd') . "/" . date('YmdHis');
        $path = Storage::disk('video')->path($this->type . "/" . $dt);
        $filepath = $path . "/video.mp4";
        File::makeDirectory($path, $mode = 0777, true, true);
        shell_exec("ffmpeg -i $url -strict -2 " . $filepath);
        return $dt;
    }
}
