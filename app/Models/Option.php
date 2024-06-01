<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['value', 'label', 'attribute_id'];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
