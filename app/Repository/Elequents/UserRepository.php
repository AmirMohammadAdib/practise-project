<?php
namespace App\Repository\Elequents;
use App\Models\User;
use App\Repository\Contracts\ElequentBaseRepository;
class UserRepository extends ElequentBaseRepository {
    public function __construct(User $model){
        parent::__construct($model);
    }
}