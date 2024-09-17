<?php

namespace App\DTOs\User;

use App\Helpers\StringHelper;
use Illuminate\Http\Request;

class StoreUserDto
{
    public function __construct(
        public string  $name,
        public string  $email,
        public ?string $phone,
        public string  $birthday,
    )
    {
    }

    public static function makeFromRequest(Request $request): StoreUserDto
    {
        return new self(
            name: $request->input('name'),
            email: $request->input('email'),
            phone: $request->input('phone'),
            birthday: $request->input('birthday'),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => StringHelper::removeSpecialCharacters($this->phone),
            'birthday' => $this->birthday
        ];
    }
}
