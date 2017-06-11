<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'sub_title',
        'logotype',
        'image',
        'utm',
        'form',
        'phone',
        'video',
        'default',
        'text',
        'templates',
        'views',
        'lead',
        'conversion',
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
