<?php

namespace App\Http\Resources\Admin\api\v1\user;

use App\Http\Resources\Admin\api\v1\role\RoleCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $routeName = Route::currentRouteName();
        if ($routeName === 'user.destroy' || $routeName === "user.force_delete" ||  $routeName === "user.return_reject") {
            return [];
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'roles' => new RoleCollection($this->whenLoaded('roles')),
            'created_at' => $this->created_at->format('Y-m-d')
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        $routeName = Route::currentRouteName();
        return [
            'message' => match ($routeName) {
                'users.store' => 'User create successfully',
                'users.show' => 'User details retrieved successfully',
                'users.update' => 'User updated successfully',
                'users.destroy' => 'User reject successfully',
                'users.force_delete' => 'User force deletion successfully',
                'users.return_reject' => 'User return rejected successfully',
                default => 'Unknown route',
            },
            'status' => in_array($routeName, ['user.store', 'user.show', 'user.update', 'user.destroy', 'user.force_delete', 'user.return_reject']),
        ];
    }
}
