<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'title',
        'sub_title',
        'button',
        'email',
        'short_code',
        'show_template',
        'show_title',
        'status',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function text()
    {
        return $this->hasOne('App\Block');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lead()
    {
        return $this->hasOne('App\Lead');
    }
    

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fields()
    {
        return $this->belongsToMany('App\Field');
    }
}
