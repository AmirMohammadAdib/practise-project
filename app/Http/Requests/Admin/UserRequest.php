<?php

namespace App\Http\Requests\Admin;

use App\DTO\UserDTO;
use Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $routeName = $this->route()->getName();
        //hashing Password
        $this->password = Hash::make($this->password);

        if (Str::contains($routeName, ["store", "register"])) {
            return [
                "name" => "required",
                "email" => "required",
                "password" => "required",
            ];
        } elseif (Str::contains($routeName, ["update"])) {
            return [
                "name" => "required|string|min:3",
                "email" => "required|email|unique:users,email," . $this->user->id,
            ];
        }
    }

    public function toDTO(): UserDTO{
        return UserDTO::fromRequest($this);
    }
}