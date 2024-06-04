<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Laravel\Scout\Searchable;

class Classes extends Model
{
    use HasFactory, HasTimestamps, Searchable;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by'
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
}
