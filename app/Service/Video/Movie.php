<?php
/**
 * Created by PhpStorm.
 * User: Ekko
 * Date: 2018/11/19
 * Time: 上午 11:02
 */

namespace App\Service\Video;


interface Movie
{
    public function GetVideoList($taskId);

    public function ListMap();

    public function DownloadVideo($id);

    public function GetVideoInfo();
}
