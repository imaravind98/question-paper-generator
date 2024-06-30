<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Question extends Model
{
    use HasFactory, HasTimestamps, Searchable;

    protected $fillable = [
        'question',
        'type',
        'option',
        'mark',
        'class_id',
        'subject_id',
        'chapter_id',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'option' => 'array',
        'class_id' => 'integer',
        'subject_id' => 'integer',
        'chapter_id' => 'integer',
    ];

    protected $with = [
        'chapter',
        'creator',
        'modifier'
    ];

    /**
     * Convert the Questions model instance to an array that can be indexed by a search engine.
     *
     * @return array The array representation of the Questions model for search indexing.
     */
    public function toSearchableArray(): array
    {
        return [
            "id" => $this->id,
            "question" => $this->question,
            "type" => $this->type
        ];
    }

    public function setOptionAttribute ($value)
    {
        $this->attributes['option'] = json_encode($value);
    }

    /**
     * Get the class that owns the question.
     */
    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    /**
     * Get the subject that owns the question.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get the chapter that owns the question.
     */
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function creator () : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function modifier () : BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}