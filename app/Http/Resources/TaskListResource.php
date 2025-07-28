<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TaskResource;
class TaskListResource extends JsonResource
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
            'update_at' => date('d.m.Y H:i:s', strtotime('+3 hours', strtotime($this->updated_at))),
            'tasks' => TaskResource::collection($this->tasks),
            'usersCount' => $this->usersCount,
            'usersList' => $this->usersList,
        ];
    }
}
