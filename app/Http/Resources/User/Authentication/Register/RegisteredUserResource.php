<?php

namespace App\Http\Resources\User\Authentication\Register;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisteredUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'key'         => $this->uuid,
            'name'        => $this->name,
            'auth_token'  => $this->auth_token,
            'is_verified' => $this->is_verified,
        ];
    }
}
