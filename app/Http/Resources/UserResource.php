<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'avatar' => $this->avatar,
            'is_admin' => $this->is_admin,
            'email' => $this->email,
            'verified' => $this->hasVerifiedEmail(),
            'created_at' => $this->created_at,
        ];
    }
}
