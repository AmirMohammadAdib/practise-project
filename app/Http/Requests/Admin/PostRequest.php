<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\DTO\PostDTO;
class PostRequest extends FormRequest
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
        return [
            "title" => "required|min:3",
            "body" => "required|min:50|max:850",
            "user_id" => "required|integer",
        ];
    }

    public function toDTO(): PostDTO{
        return PostDTO::fromRequest($this);
    }
}
