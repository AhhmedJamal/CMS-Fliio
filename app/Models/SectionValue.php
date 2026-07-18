<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionValue extends Model
{
    protected $fillable = [
        'page_section_id',
        'section_field_id',
        'field_value',
    ];

    public function pageSection()
    {
        return $this->belongsTo(PageSection::class);
    }

    public function sectionField()
    {
        return $this->belongsTo(SectionField::class);
    }
}
