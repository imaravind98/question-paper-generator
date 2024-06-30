<?php

namespace App\Repositories;

use App\Models\Chapter;
use Illuminate\Support\Facades\Auth;

/**
 * Repository class for managing Chapter model operations.
 */
class ChapterRepository
{
    protected $model;

    /**
     * Constructor to bind model to repository.
     *
     * @param Chapter $chapter
     */
    public function __construct(Chapter $chapter)
    {
        $this->model = $chapter;
    }

    /**
     * Retrieve all chapters.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Retrieve all chapters with pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function list($size)
    {
        return $this->model->orderBy('id', 'DESC')->paginate($size)->withQueryString();
    }

    /**
     * Retrieve searched chapters with pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($query, $size)
    {
        return $this->model->search($query)->orderBy('id', 'DESC')->paginate($size)->withQueryString();
    }

    /**
     * Find a chapter by its ID.
     *
     * @param int $id
     * @return Chapter|null
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create a new chapter.
     *
     * @param array $data
     * @return Chapter
     */
    public function create(array $data)
    {
        $data['created_by'] = Auth::id();
        return $this->model->create($data);
    }

    /**
     * Update an existing chapter by its ID.
     *
     * @param int $id
     * @param array $data
     * @return Chapter|null
     */
    public function update($id, array $data)
    {
        $chapter = $this->model->find($id);
        $data['updated_by'] = Auth::id();
        if ($chapter) {
            $chapter->update($data);
            return $chapter;
        }
        return null;
    }

    /**
     * Delete a chapter by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $chapter = $this->model->find($id);
        if ($chapter) {
            return $chapter->delete();
        }
        return false;
    }
}
