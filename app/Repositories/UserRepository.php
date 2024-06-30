<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Repository User for managing User model operations.
 */
class UserRepository
{
    protected $model;

    /**
     * Constructor to bind model to repository.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Retrieve all Users.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Retrieve all Users with pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function list($size)
    {
        return $this->model->paginate($size)->withQueryString();
    }

    /**
     * Retrieve searched User with pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($query, $size)
    {
        return $this->model->search($query)->paginate($size)->withQueryString();
    }

    /**
     * Find a User by its ID.
     *
     * @param int $id
     * @return User|null
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create a new User.
     *
     * @param array $data
     * @return User
     */
    public function create(array $data)
    {
        $data['created_by'] = Auth::id();
        return $this->model->create($data);
    }

    /**
     * Update an existing User by its ID.
     *
     * @param int $id
     * @param array $data
     * @return User|null
     */
    public function update($id, array $data)
    {
        $user = $this->model->find($id);
        $data['updated_by'] = Auth::id();
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    /**
     * Delete a User by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $user = $this->model->find($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }
}
