<?php
namespace App\DTO;
use App\DTO\Contracts\BaseDTO;

class PostDTO extends BaseDTO {
    public function __construct(public string $title, public string $body, public int $user_id){}
    public static function fromRequest(object $request): static {
        return new static(
            title: $request->title,
            body: $request->body,
            user_id: $request->user_id,
        );
    }
}