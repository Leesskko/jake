<?php

namespace App\Http\Resources;

use App\Models\Video;
use Illuminate\Http\Resources\Json\JsonResource;

class Tags extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'tagName' => $this->tag,
            'videoCount' => Video::where('tag_id', '=', $this->id)->where('is_get_file_already', '=', '1')->count()
        ];
    }
}
