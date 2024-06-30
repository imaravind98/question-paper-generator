<?php

namespace App\Repositories;

use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

/**
 * Repository class for managing Subject model operations.
 */
class SubjectRepository
{
    protected $model;

    /**
     * Constructor to bind model to repository.
     *
     * @param Subject $subject
     */
    public function __construct(Subject $subject)
    {
        $this->model = $subject;
    }

    /**
     * Retrieve all Subjects.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Retrieve all Subjects with pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function list($size)
    {
        return $this->model->paginate($size)->withQueryString();
    }

    /**
     * Retrieve searched Subject with pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($query, $size)
    {
        return $this->model->search($query)->paginate($size)->withQueryString();
    }

    /**
     * Find a Subject by its ID.
     *
     * @param int $id
     * @return Subject|null
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create a new Subject.
     *
     * @param array $data
     * @return Subject
     */
    public function create(array $data)
    {
        $data['created_by'] = Auth::id();
        return $this->model->create($data);
    }

    /**
     * Update an existing Subject by its ID.
     *
     * @param int $id
     * @param array $data
     * @return Subject|null
     */
    public function update($id, array $data)
    {
        $subject = $this->model->find($id);
        $data['updated_by'] = Auth::id();
        if ($subject) {
            $subject->update($data);
            return $subject;
        }
        return null;
    }

    /**
     * Delete a Subject by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $subject = $this->model->find($id);
        if ($subject) {
            return $subject->delete();
        }
        return false;
    }
}
