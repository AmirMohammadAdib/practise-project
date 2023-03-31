<?php
namespace App\DTO;

use App\DTO\Contracts\BaseDTO;

class UserDTO extends BaseDTO {
    public function __construct(public string $name, public string $email, public string $password){}
    public static function fromRequest(object $request): static {
        return new static (
            name: $request->name,
            email: $request->email,
            password: $request->password,
        );
    }
}