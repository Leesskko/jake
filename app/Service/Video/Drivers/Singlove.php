<?php
/**
 * Created by PhpStorm.
 * User: Ekko
 * Date: 2018/11/19
 * Time: 下午 02:53
 */

namespace App\Service\Video\Drivers;


use App\Http\Resources\Tags;
use App\Models\Tag;
use App\Models\Video;
use App\Service\Video\Base;
use QL\QueryList;

class Singlove extends Base
{

    public $type = "Singlove";
    private $baseurl = "https://www.singlove.com/";
    private $startpage = 0;
    private $endpage = 10;
    private $tagname = "自拍";
    private $tagid = 33;
    private $loginql;
    private $nowpage = 0;
    private $nowindex = 0;

    /**
     * Singlove constructor.
     * @param array $parameterDefine
     */

    public function __construct(array $parameterDefine = [])
    {
        $this->login();
        foreach ($parameterDefine as $k => $v) {
            $this->setParam($k, $v);
        }
    }

    private function GetTags()
    {
        $tagshtml = $this->getHtml($this->baseurl . 'node/tags');
        $ql = QueryList::setHtml($tagshtml)->find('.btn-default')->htmls();
        foreach ($ql as $item) {
            $tag = new Tag();
            $tag->tag = $item;
            $tag->task_type = $this->type;
            $tag->remote_id = 0;
            $tag->save();
        }
    }

    private function getTagId($tagname)
    {
        $tag = Tag::where('tag', '=', $tagname)
            ->where('task_type', '=', $this->type)->first();
        return $tag->id;
    }

    public function runTask()
    {
        //select video_id, count(video_id) as icount from video_tags group by video_id ORDER BY icount desc;
        $lasttag = Video::orderBy('tag_id', 'desc')->first();
        $videotags = Tag::where('task_type', '=', $this->type)->where('id', ">=", $lasttag->tag_id)->get();
        foreach ($videotags as $vt) {
            $this->nowpage = 1;
            while ($this->nowpage <= $this->endpage) {
                $this->console('正在抓取[' . $vt->tag . ']分类第' . $this->nowpage . '页数据。');
                $ql = QueryList::setHtml($this->getHtml($this->getlisturl($this->nowpage, $vt->remote_id)));

                $lists = $ql->find('.item')->find('.block')->htmls();

                $this->nowindex = 0;
                while ($this->nowindex < count($lists)) {
                    $this->console('正在抓取解析并解析本页第(' . ($this->nowindex) . '/24)个视频。');
                    $itemhtml = $lists[$this->nowindex];
                    $detailuri = $this->baseurl . ltrim(QueryList::setHtml($itemhtml)->find('.media-image')->find('a')->attr('href'), '/');
                    $ql2 = $this->loginql->get($detailuri);
                    $vtitle = $ql2->find('.title')->text();
                    $ishave = Video::where('title', '=', $vtitle)->where('task_type', '=', $this->type)->first();
                    if ($ishave) {
                        $ishave->addtag($vt->id);
                    } else {
                        $video = new Video();
                        $video->title = $vtitle;
                        $video->task_id = 1;
                        $video->task_type = $this->type;
                        $video->url = $this->getVideoUrl($ql2->find('iframe')->attr('src'));
                        $video->tag_id = $this->getTagId($vt->tag);
                        $video->cover_pic = $this->savepic($ql2->find("meta[property='og:image']")->attr('content'));
                        $video->static_pic = $this->savepic($ql2->find("meta[property='og:image']")->attr('content'));
                        $video->get_type = parent::FFMPEG_DOWNLOAD;
                        $video->page = $this->nowpage;
                        $video->index = $this->nowindex;
                        $video->save();
                        $video->addtag($vt->id);
                    }
                    $this->nowindex++;
                }
                $this->nowpage++;
            }
        }
    }

    private function getlisturl($page, $tag_id)
    {
        return $this->baseurl . "node/tag?tag_id={$tag_id}&page=$page&per-page=24";
    }

    private function getVideoUrl($url)
    {
        $html = $this->getHtml($url);
        $a = explode("src:\"", $html);
        $b = explode('" }', $a[1]);
        return $b[0];

    }

    private function login()
    {
        $ql = QueryList::get($this->baseurl . "user/login");

        $data = [
            '_csrf' => $ql->find("input[name='_csrf']")->val(),
            'LoginForm[username]' => 'a369039789@gmail.com',
            'LoginForm[password]' => 'a162216342A',
            'LoginForm[rememberMe]' => 1
        ];
        $ql->post($this->baseurl . "user/login", $data)->getHtml();
        $this->loginql = $ql;
    }

}
