<?php

namespace App\Repositories;

use App\Models\Classes;
use Illuminate\Support\Facades\Auth;

/**
 * Repository class for managing classes model operations.
 */
class ClassRepository
{
    protected $model;

    /**
     * Constructor to bind model to repository.
     *
     * @param classes $classes
     */
    public function __construct(Classes $classes)
    {
        $this->model = $classes;
    }

    /**
     * Retrieve all classess.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Retrieve all classess with pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function list($size)
    {
        return $this->model->paginate($size)->withQueryString();
    }

    /**
     * Retrieve searched classes with pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($query, $size)
    {
        return $this->model->search($query)->paginate($size)->withQueryString();
    }

    /**
     * Find a classes by its ID.
     *
     * @param int $id
     * @return classes|null
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create a new classes.
     *
     * @param array $data
     * @return classes
     */
    public function create(array $data)
    {
        $data['created_by'] = Auth::id();
        return $this->model->create($data);
    }

    /**
     * Update an existing classes by its ID.
     *
     * @param int $id
     * @param array $data
     * @return classes|null
     */
    public function update($id, array $data)
    {
        $classes = $this->model->find($id);
        $data['updated_by'] = Auth::id();
        if ($classes) {
            $classes->update($data);
            return $classes;
        }
        return null;
    }

    /**
     * Delete a classes by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $classes = $this->model->find($id);
        if ($classes) {
            return $classes->delete();
        }
        return false;
    }
}
