<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\Tags;
use App\Http\Resources\Videos;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function video()
    {
        return Videos::collection(Video::where('is_get_file_already', '=', '1')->orderBy('id', 'desc')->paginate(\request('pagesize', '15')));
    }

    public function videobytag($tag)
    {
        $tagm = Tag::where('tag', '=', $tag)->first();
        if ($tagm) {
            return Videos::collection(Video::where('is_get_file_already', '=', '1')->where('tag_id', '=', $tagm->id)->orderBy('id', 'desc')->paginate(\request('pagesize', '15')));
        } else {
            return response()->json(['ret' => 400, 'msg' => '标签不存在', 'data' => []], 400);
        }
    }

    public function tags()
    {
        return Tags::collection(Tag::all());
    }
}
