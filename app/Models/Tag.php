<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function videos()
    {
        return $this->belongsToMany('App\Models\Video', 'video_tags', 'tag_id', 'video_id');
    }
}
