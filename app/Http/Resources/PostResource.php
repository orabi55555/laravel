<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   $user=$this->user;
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'created_at'=>$this->created_at,
            'user'=> new UserResource($user),
        ];
    }
}
