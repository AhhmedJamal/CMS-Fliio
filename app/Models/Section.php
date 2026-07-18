<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
        protected $fillable = [
        'slug',
        'name',
        'preview_image',
        'is_active',
    ];


    public function fields()
    {
        return $this->hasMany(SectionField::class);
    }


    public function pageSections()
    {
        return $this->hasMany(PageSection::class);
    }

    public function sectionValues()
    {
        return $this->hasMany(SectionValue::class);
    }
}
