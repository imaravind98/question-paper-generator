<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $fillable = ['entity_type'];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'entity_attribute_value', 'entity_id', 'attribute_id')
                    ->withPivot(['string_value', 'integer_value', 'float_value', 'boolean_value', 'date_value']);
    }
}

