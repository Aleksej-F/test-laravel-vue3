<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'smallText' => $this->smallText,
            'complite' => $this->complite ? true: false,
            'list_id' => $this->list_id,
            'sorting' => $this->sorting,
            'quantity'  => $this->quantity,
            'price'  => $this->price,
            'executor_user_id'  => $this->executor_user_id,
        ];
    }
}
