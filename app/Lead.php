<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'form_id',
        'title_id',
        'data'
    ];

    public function form()
    {
        return $this->belongsTo('App\Form');
    }

    public function scopeLastMonth($query, $id)
    {
        $mount = Carbon::now()->addDays(-30);
        return $query->where('title_id', $id)->where('created_at', '>=', $mount)->get();
    }

    public function scopeLastWeek($query, $id)
    {
        $week = Carbon::now()->addDays(-7);
        return $query->where('title_id', $id)->where('created_at', '>=', $week)->get();
    }
    
    public function scopeLastDay($query, $id)
    {
        $week = Carbon::now()->addDays(-1);
        return $query->where('title_id', $id)->where('created_at', '>=', $week)->get();
    }
}
