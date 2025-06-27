<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DairyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id'=>(string)$this->user_id,
            'relationships'=>[
                'Email'=>(string)$this->email,
            ],
            'attributes'=>[
                'Date'=>(string)$this->date,
                'Thought'=>(string)$this->thoughts
            ],
        ];
    }
}
