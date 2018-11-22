<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function chstag()
    {
        return $this->hasOne('App\Models\Tag', 'id', 'tag_id');
    }

    public function addtag($tag_id)
    {
        $t = VideoTags::where('video_id', '=', $this->id)->where('tag_id', '=', $tag_id)->first();
        if (!$t) {
            $vt = new VideoTags();
            $vt->video_id = $this->id;
            $vt->tag_id = $tag_id;
            $vt->save();
        }

    }
}
