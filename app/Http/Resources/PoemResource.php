<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PoemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'poetName' => $this->poet_name,
            'content' => $this->content,
            'imageUrl' => $this->image_url,
            'userId' => $this->user_id,
            'createdAt' => $this->created_at->toISOString(),
            'updatedAt' => $this->created_at->toISOString(),
        ];
    }
}
