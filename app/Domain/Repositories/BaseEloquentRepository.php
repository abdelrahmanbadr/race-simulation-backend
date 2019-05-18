<?php


namespace App\Domain\Repositories;

use App\Domain\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
class BaseEloquentRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $entity;

    /**
     * BaseEloquentRepository constructor.
     * @param Model $entityModel
     */
    public function __construct(Model $entityModel)
    {
        $this->entity = $entityModel;
    }


    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->entity->create($attributes);
    }

    /**
     * @return Model
     */
    public function save(): Model
    {
         $this->entity->save();
         return $this->entity;
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes)
    {
        $row = $this->entity->find($id);
        $row->update($attributes);
        return $row;
    }



}