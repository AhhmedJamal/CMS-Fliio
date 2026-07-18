<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionField extends Model
{
    protected $fillable = [
        'section_id',
        'key',
        'label',
        'type',
        'placeholder',
        'is_required',
        'sort_order',
        'options',
        'default_value',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function sectionValue()
    {
        return $this->hasOne(SectionValue::class);
    }
}
