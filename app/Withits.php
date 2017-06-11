<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Withits extends Model
{
    protected $fillable = [
        'user_ip',
        'title',
        'check',
        'numeric',
    ];

    public function scopeLastMonth($query, $id)
    {
        $mount = Carbon::now()->addDays(-30);
        return $query->where('title', $id)->where('created_at', '>=', $mount)->get();
    }

    public function scopeLastWeek($query, $id)
    {
        $week = Carbon::now()->addDays(-7);
        return $query->where('title', $id)->where('created_at', '>=', $week)->get();
    }

    public function scopeLastDay($query, $id)
    {
        $week = Carbon::now()->addDays(-1);
        return $query->where('title', $id)->where('created_at', '>=', $week)->get();
    }
}
