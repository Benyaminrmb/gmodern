<?php

namespace App\Http\Resources;

use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

//use Illuminate\Http\Resources\Json\ResourceCollection;

//use Illuminate\Http\Resources\Json\ResourceCollection;
//use Illuminate\Http\Resources\Json\ResourceResponse;

class PostResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $result = [

            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'image' => [
                'medium'=>$this->img,
                'large'=>$this->biggerImg
            ],
            'url'=>$this->url,
            'status'=>$this->status,
            'position'=>$this->position,
            'visit'=>$this->visit,
            'created_at'=>[
                'gregorian'=>$this->created_at,
                'shamsi'=>Verta::instance($this->created_at)->format('%B %d، %Y'),
            ],
            'updated_at'=>[
                'gregorian'=>$this->updated_at,
                'shamsi'=>Verta::instance($this->updated_at)->format('%B %d، %Y'),
            ],

            'categories'=>CategoryResource::collection( $this->categories ),
            'source'=>SourceUrlResource::make( $this->source_url ),
            'likes'=>[
                'likes'=>$this->likes()->whereValueIs(1)->count(),
                'dislikes'=>$this->likes()->whereValueIs(0)->count(),
            ],
        ];
        if($this->html){
            $result['html']=$this->html;
        }
        return $result;
    }

    public function toResponse($request): \Illuminate\Http\JsonResponse
    {
        return JsonResource::toResponse($request);
    }
}
