<?php

namespace App\Http\Controllers;

use App\Field;
use App\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FormsController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        $breadcrumb = [
            [
                'href' => route('form.index'),
                'text' => 'Формы'
            ]
        ];

        $forms = Form::all();

        return view('oleus.form.index')
            ->with('forms', $forms)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $breadcrumb = [
            [
                'href' => route('form.index'),
                'text' => 'Формы'
            ],
            [
                'text' => 'Создание формы'
            ],
        ];

        $fields = Field::all();

        return view('oleus.form.create')
            ->with('fields', $fields)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if ($data['title'] == null) {
            Session::flash('notify', [
                'status' => 'warning',
                'message' => 'Форма не создана'
            ]);
            return redirect()->back()->withInput();
        }

        $form = Form::create($data);

        if (isset($data['fields'])) {
            $form->fields()->attach($data['fields']);
        }

        Session::flash('notify', [
            'status' => 'success',
            'message' => 'Форма создана'
        ]);

        return redirect()->route('form.index');
    }

    /**
     * @param Form $form
     * @return mixed
     */
    public function edit(Form $form)
    {
        $breadcrumb = [
            [
                'href' => route('form.index'),
                'text' => 'Формы'
            ],
            [
                'text' => $form->title
            ],
        ];

        $fields = Field::all();
        $show_t = $form->show_template;
        $q = $form->fields()->get();
        $my_fields = array();

        for ($i = 0; $i < $q->count(); $i++) {
            array_push($my_fields, $q[$i]);
        }

        return view('oleus.form.edit')
            ->with('form', $form)
            ->with('show_t', $show_t)
            ->with('fields', $fields)
            ->with('my_fields', $my_fields)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Request $request
     * @param Form    $form
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Form $form)
    {
        $data = $request->all();

        if ($data['title'] == null) {
            Session::flash('notify', [
                'status' => 'warning',
                'message' => 'Форма не обновлена'
            ]);

            return redirect()->back()->withInput();
        }

        if (!isset($data['status'])) {
            $data['status'] = 0;
        }

        $form->update($data);

        DB::table('field_form')->where('form_id', $form->id)->delete();

        if (isset($data['fields'])) {
            $form->fields()->attach($data['fields']);
        }

        Session::flash('notify', [
            'status' => 'success',
            'message' => 'Форма обновлена'
        ]);

        return redirect()->route('form.index');
    }

    /**
     * @param Form $form
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Form $form)
    {
        if ($form->delete()) {
            Session::flash('notify', [
                'status' => 'success',
                'message' => 'Форма удаленна'
            ]);
        } else {
            Session::flash('notify', [
                'status' => 'danger',
                'message' => 'Не удалось удалить форму'
            ]);
        }

        return back();
    }

    /**
     * @param $form
     * @param $field
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del_field($form, $field)
    {
        $check = DB::table('field_form')->where('field_id', $field)
            ->where('form_id', $form)->delete();

        if ($check) {
            Session::flash('notify', [
                'status' => 'success',
                'message' => 'Поле форми удаленно'
            ]);
        } else {
            Session::flash('notify', [
                'status' => 'danger',
                'message' => 'Не удалось удалить поле форми'
            ]);
        }

        return back();
    }
}
