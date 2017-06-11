<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Variable extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
        'comment'
    ];

    public $incrementing = false;
    protected $primaryKey = 'key';

    /**
     * @param $key
     * @return Variable|\Illuminate\Http\RedirectResponse
     */
    public function set($key, $value)
    {
        $variable = DB::table('variables')
            ->where('key', $key)->get();
        if(isset($variable) && $variable->value == $value) {
            return redirect()->back();

        } else {
            $variable = new Variable($key, $value);
            $variable->save();
            return $variable;
        }
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $value = DB::table('variables')
            ->where('key', $key)->get()->value;
    }

    /**
     * @return bool|null
     */
    public function del()
    {
        return $this->delete();
    }

    /**
     * @param $data
     * @param $day
     */
    public static function day_save($data, $day)
    {
        Variable::updateOrCreate(
            ['key' => 'wt_' . $day . '_from'],
            ['value' => $data['wt_' . $day . '_from']]
        );
        Variable::updateOrCreate(
            ['key' => 'wt_' . $day . '_to'],
            ['value' => $data['wt_' . $day . '_to']]
        );
        Variable::updateOrCreate(
            ['key' => 'rt_' . $day . '_from'],
            ['value' => $data['rt_' . $day . '_from']]
        );
        Variable::updateOrCreate(
            ['key' => 'rt_' . $day . '_to'],
            ['value' => $data['rt_' . $day . '_to']]
        );
    }
}
