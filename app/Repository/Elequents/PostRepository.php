<?php
namespace App\Repository\Elequents;

use App\Repository\Contracts\ElequentBaseRepository;
use App\Models\Post;

class PostRepository extends ElequentBaseRepository {
    public function __construct(Post $model){
        parent::__construct($model);
    }
}