<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['data' => $this->collection];
//        return [
//            'id' => $this->id,
//            'name' => $this->name,
//            'pic' => $this->pic,
//            'read_count' => $this->read_count,
//            'created_at' => $this->created_at,
//
//        ];
    }
}
