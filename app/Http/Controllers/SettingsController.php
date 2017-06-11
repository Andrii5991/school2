<?php

namespace App\Http\Controllers;

use App\Form;
use App\Title;
use App\Variable;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        $breadcrumb = [
            [
                'text' => 'Настройки'
            ]
        ];

        $titles = Title::all();
        $forms = Form::all();
        $variables = Variable::all()->pluck('value', 'key');
        if(isset($variables['call_back'])) $call_back = Form::where('id', $variables['call_back'])->first();
        else $call_back = null;

        return view('oleus.setting.index')
            ->with('settings', $variables)
            ->with('titles', $titles)
            ->with('forms', $forms)
            ->with('call_back', $call_back)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function update(Request $request)
    {
        $data = $request->all();
        
        if (isset($data['welcome_sort'])) {
            $w = $data['welcome_sort'];
            for($i = 0; $i < count($w); $i++) {
                Variable::updateOrCreate(
                    ['key' => $w[$i]],
                    ['value' => $i+1]
                );
            }
        }

        if (isset($data['email'])) {
            Variable::updateOrCreate(
                ['key' => 'adminEmail'],
                ['value' => $data['email']]
            );
        }

        if (isset($data['message'])) {
            Variable::updateOrCreate(
                ['key' => 'message'],
                ['value' => $data['message']]
            );
        }

        if (isset($data['call_back']) && $data['call_back'] != 'null') {
            Variable::updateOrCreate(
                ['key' => 'call_back'],
                ['value' => $data['call_back']]
            );
        }

        if (isset($data['google_analytics'])) {
            Variable::updateOrCreate(
                ['key' => 'google_analytics'],
                ['value' => $data['google_analytics']]
            );
        }

        if (isset($data['yandex_metrix'])) {
            Variable::updateOrCreate(
                ['key' => 'yandex_metrix'],
                ['value' => $data['yandex_metrix']]
            );
        }

        if (isset($data['password'])) {
            Variable::updateOrCreate(
                ['key' => 'password'],
                ['value' => $data['password']]
            );
        }

        if (isset($data['description'])) {
            Variable::updateOrCreate(
                ['key' => 'description'],
                ['value' => $data['description']]
            );
        }

        if (isset($data['key_words'])) {
            Variable::updateOrCreate(
                ['key' => 'key_words'],
                ['value' => $data['key_words']]
            );
        }

        if (isset($data['conversion'])) {
            Variable::updateOrCreate(
                ['key' => 'conversion'],
                ['value' => $data['conversion']]
            );
        }

        if (isset($data['title']) && $data['title'] != 'error') {
            Variable::updateOrCreate(
                ['key' => 'title'],
                ['value' => $data['title']]
            );
        } else if (isset($data['title']) && $data['title'] == 'error') {
            $val_title = Variable::where('key', 'title')->first();
            if(isset($val_title)) {
                $val_title->delete();
            }
        }

        Session::flash('notify', [
            'status' => 'success',
            'message' => 'Настройки обновлены'
        ]);

        return redirect()->back()->withInput();
    }
}
