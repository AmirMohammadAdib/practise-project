<?php
namespace App\Repository\Contracts;
use App\DTO\Contracts\BaseDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseRepository {
    public function all(): Collection;
    public function store(BaseDTO $dto);
    public function update(Model $model, BaseDto $dto);
    public function show(Model $model): Model;
    public function destroy(Model $model); 
}