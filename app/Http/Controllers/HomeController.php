<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $last5 = Video::where('is_get_file_already', '>', 0)->orderBy('is_get_file_already', 'desc')->limit(22)->get()->toArray();
        $popular3 = Video::where('is_get_file_already', '>', 0)->orderBy('hits', 'desc')->orderBy('updated_at', 'asc')->limit(3)->get();
        return view('web.index')->with([
            'last5' => $last5,
            'popular3' => $popular3
        ]);
    }

    public function tags()
    {
        $tags = Tag::all();
        $res = [];
        foreach ($tags as $t) {
            $num = 0;
            foreach ($t->videos as $tv) {
                if ($tv->is_get_file_already > 0) {
                    $num++;
                }
            }
            $res[] = [
                'id' => $t->id,
                'title' => $t->tag,
                'videonum' => $num
            ];
        }
        return view('web.tag')->with(['tags' => $res]);
    }

    public function videos($type)
    {
        if ($type == 'new') {
            $tagname = '最新';
            $res = Video::where('is_get_file_already', '>', 0)->orderBy('is_get_file_already', 'desc')->orderBy('updated_at', 'desc')->paginate(15);
        }

        if ($type == 'hot') {
            $tagname = '最热';
            $res = Video::where('is_get_file_already', '>', 0)->orderBy('hits', 'desc')->orderBy('updated_at', 'asc')->paginate(15);
        }

        if ($type == 'tag') {
            $res = collect();
            $tagid = \request('tag_id', 1);
            $tag = Tag::find($tagid);
            $tagname = '标签:' . $tag->tag;
            foreach ($tag->videos as $tg) {
                if ($tg->is_get_file_already >= 1) {
                    $res->push($tg);
                }
            }
        }

        return view('web.v')->with(['data' => $res, 'title' => $tagname]);
    }

    public function videoshow($id)
    {
        $video = Video::find($id);
        if (!session('watched' . $id)) {

            $video->hits++;
            $video->save();
            Session::push('watched' . $id, 1);
        }

        return view('web.video')->with(['video' => $video]);
    }
}
