<?php
namespace App\Repository\Contracts;

use App\DTO\Contracts\BaseDTO;
use App\Repository\Contracts\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
abstract class ElequentBaseRepository implements BaseRepository {
    private Model $model;
    public function __construct(Model $model){
        $this->model = $model;
    }

    public function all(): Collection {
        return $this->model->all();
    }
    public function store(BaseDTO $dto) {
        return $this->model->create($dto->toArray());
    }
    public function update(Model $model, BaseDto $dto) {
        return $model->update($dto->toArray());
    }
    public function find($id): Model{
        return $this->model->findOrFail($id);
    }
    public function show(Model $model): Model {
        return $model;
    }
    public function destroy(Model $model) {
        return $model->delete();
    }
}