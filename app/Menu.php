<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'block',
        'class',
        'sort',
        'status',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
