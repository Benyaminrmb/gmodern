<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'likes' => $this->likes()->whereValueIs(1)->count(),
            'dislikes' => $this->likes()->whereValueIs(0)->count(),
        ];
    }
}
