<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Chapter extends Model
{
    use HasFactory, HasTimestamps, Searchable;

    protected $fillable = [
        'name',
        'subject_id',
        'created_by',
        'updated_by'
    ];

    protected $with = [
        'subject',
        'creator',
        'modifier'
    ];

    /**
     * Convert the Chapter model instance to an array that can be indexed by a search engine.
     *
     * @return array The array representation of the Chapter model for search indexing.
     */
    public function toSearchableArray(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name
        ];
    }

    public function subject ()
    {
        return $this->belongsTo(Subject::class);
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
