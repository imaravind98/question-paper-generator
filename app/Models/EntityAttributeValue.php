<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntityAttributeValue extends Model
{
    protected $fillable = [
        'entity_id',
        'attribute_id',
        'string_value',
        'integer_value',
        'float_value',
        'boolean_value',
        'date_value',
        // Add other value types as needed
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function validateValue($value, $attribute)
    {
        switch ($attribute->value_type) {
            case Attribute::VALUE_TYPE_INTEGER:
                return is_numeric($value);
            case Attribute::VALUE_TYPE_FLOAT:
                return is_float($value) || is_numeric($value);
            case Attribute::VALUE_TYPE_BOOLEAN:
                return is_bool($value) || in_array($value, [0, 1, '0', '1', true, false], true);
            case Attribute::VALUE_TYPE_DATE:
                return strtotime($value) !== false;
            // Add more validation rules for other types
            default:
                return true;
        }
    }
}
