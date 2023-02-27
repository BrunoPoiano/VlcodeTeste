<?php

namespace App\Http\Resources\User;

use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        $quantity = Todo::where([
                'user_id' => $this->id,
            ])->count();

        $completed = Todo::where([
                'user_id' => $this->id,
                'status' => 2,
            ])->count();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y'),
            'todo_quantity' => $quantity,
            'todo_completed' => $completed,
        ];
    }
}
