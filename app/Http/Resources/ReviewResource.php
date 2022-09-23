<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user' => $this->user->name,
            'product' => $this->product->name,
            'body' => $this->review,
            'star' => $this->star,
            'linkToProduct' => [
                'product' => route('products.show', $this->product->id),
            ],
        ];
    }
}
