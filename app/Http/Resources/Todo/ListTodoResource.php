<?php

namespace App\Http\Resources\Todo;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ListTodoResource extends JsonResource
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
            'name' => $this->name,
            'status' => $this->status,
            'date' => Carbon::parse($this->date)->format('d/m/Y'),
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y'),
        ];
    }
}
