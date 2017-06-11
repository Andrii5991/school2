<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
        'title',
        'type',
        'settings',
        'mask',
        'required',
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function form()
    {
        return $this->belongsToMany('App\Form');
    }

    /**
     * @return $this
     */
    public function forms()
    {
        return $this->belongsToMany('App\Form')
            ->withPivot('sort');
    }
}

