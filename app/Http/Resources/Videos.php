<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Videos extends JsonResource
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
            'title' => $this->title,
            'duration' => gmdate('H:i:s', $this->duration),
            'size' => $this->sizecount($this->size),
            'tag' => new Tags($this->chstag),
            'resource' => [
                'static_pic' => \Storage::disk('pic')->url($this->static_pic),
                'cover_pic' => \Storage::disk('video')->url($this->screensnap),
                'video' => \Storage::disk('video')->url($this->filepath)
            ]
        ];
    }


    private function sizecount($filesize)
    {
        if ($filesize >= 1073741824) {
            $filesize = round($filesize / 1073741824 * 100) / 100 . ' gb';
        } elseif ($filesize >= 1048576) {
            $filesize = round($filesize / 1048576 * 100) / 100 . ' mb';
        } elseif ($filesize >= 1024) {
            $filesize = round($filesize / 1024 * 100) / 100 . ' kb';
        } else {
            $filesize = $filesize . ' bytes';
        }
        return $filesize;
    }
}
