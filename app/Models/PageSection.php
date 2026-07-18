<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = [
        'page_id',
        'section_id',
        'sort_order',
        'is_active',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function values()
    {
        return $this->hasMany(SectionValue::class);
    }
}
