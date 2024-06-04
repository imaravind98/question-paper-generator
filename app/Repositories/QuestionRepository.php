<?php

namespace App\Repositories;

use App\Models\Question;

class QuestionRepository
{
    protected $model;

    /**
     * Constructor to bind model to repository.
     *
     * @param Questions $questions
     */
    public function __construct(Question $questions)
    {
        $this->model = $questions;
    }

    /**
     * Retrieve all questions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Retrieve all questions with pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function list($size)
    {
        return $this->model->paginate($size)->withQueryString();
    }

    /**
     * Retrieve searched questions with pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($query, $size)
    {
        return $this->model->search($query)->paginate($size)->withQueryString();
    }

    /**
     * Find a question by its ID.
     *
     * @param int $id
     * @return Questions|null
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create a new question.
     *
     * @param array $data
     * @return Questions
     */
    public function create(array $data)
    {
        $data['created_by'] = 1; // Assuming a default created_by value
        return $this->model->create($data);
    }

    /**
     * Update an existing question by its ID.
     *
     * @param int $id
     * @param array $data
     * @return Questions|null
     */
    public function update($id, array $data)
    {
        $question = $this->model->find($id);
        if ($question) {
            $question->update($data);
            return $question;
        }
        return null;
    }

    /**
     * Delete a question by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}