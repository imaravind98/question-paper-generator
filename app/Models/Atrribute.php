<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    const VALUE_TYPE_STRING = 'string';
    const VALUE_TYPE_INTEGER = 'integer';
    const VALUE_TYPE_FLOAT = 'float';
    const VALUE_TYPE_BOOLEAN = 'boolean';
    const VALUE_TYPE_DATE = 'date';
    // Add more types as needed

    protected $fillable = ['code', 'label', 'type', 'value_type'];

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}   