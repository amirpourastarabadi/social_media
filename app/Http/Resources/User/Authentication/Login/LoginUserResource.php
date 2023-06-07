<?php

namespace App\Http\Resources\User\Authentication\Login;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'key' => $this->uuid,
            'email' => $this->email,
            'name' => $this->name,
            'auth_token' => $this->auth_token
        ];
    }
}
