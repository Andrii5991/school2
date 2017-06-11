<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = [
        'bundle',
        'form_id',
        'title',
        'sub_title',
        'body',
        'image',
        'background',
        'color',
        //'block_id',
        'location_image',
        'setting',
        'class',
        'sort',
        'status',
    ];

    public function form()
    {
        return $this->belongsTo('App\Form');
    }
    
    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActiveText($query)
    {
        return $query->active()->where('bundle', 'static_text');
    }
}
