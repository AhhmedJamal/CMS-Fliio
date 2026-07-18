<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'is_active',
    ];
    public function pageSections()
    {
        return $this->hasMany(PageSection::class);
    }
}
