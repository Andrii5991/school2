<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advantage extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'sub_title',
        'image',
        'sort',
        'status',
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
