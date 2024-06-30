<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Subject extends Model
{
    use HasFactory, HasTimestamps, Searchable;

    protected $fillable = [
        'name',
        'class_id',
        'created_by',
        'updated_by'
    ];

    protected $with = [
        'classes',
        'creator',
        'modifier'
    ];

    /**
     * Convert the Class model instance to an array that can be indexed by a search engine.
     *
     * @return array The array representation of the Class model for search indexing.
     */
    public function toSearchableArray(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name
        ];
    }

    public function classes ()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
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
