<?php

namespace App\Domain\Contracts;


interface RepositoryInterface
{
    /**
     * Creates a new entity
     *
     * @param array $attributes Data the entity will have.
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Creates a new entity
     *
     * @return mixed
     */
    public function save();

    /**
     * Updates a entity.
     *
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes);
}