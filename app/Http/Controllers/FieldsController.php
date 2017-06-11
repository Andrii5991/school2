<?php

namespace App\Http\Controllers;

use App\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FieldsController extends Controller
{
    private $types = [
        'text' => 'Текстовое',
        'number' => 'Числовое',
        'tel' => 'Телефон',
        'email' => 'Эл. адрес',
        /*'select' => 'Селект',*/
        /*'radio' => 'Радио',*/
        'checkbox' => 'Чекбокс',
    ];

    /**
     * @return mixed
     */
    public function index()
    {
        $fields = Field::all();
        $breadcrumb = [
            [
                'href' => route('field.index'),
                'text' => 'Поля'
            ]
        ];
        return view('oleus.field.index')
            ->with('fields', $fields)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @return $this
     */
    public function create()
    {
        $breadcrumb = [
            [
                'href' => route('field.index'),
                'text' => 'Поля'
            ],
            [
                'text' => 'Создание поля'
            ]
        ];

        return view('oleus.field.create')
            ->with('types', $this->types)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $field = $request->all();

        if($field['title'] == null){
            Session::flash('notify', [
                'status' => 'warning',
                'message' => 'Поле не создано'
            ]);
            return redirect()->back()->withInput();
        }

        Field::create($field);

        Session::flash('notify', [
            'status'  => 'success',
            'message' => 'Поле создано'
        ]);

        return redirect()->route('field.index');
    }

    /**
     * @param Field $field
     * @return mixed
     */
    public function show(Field $field)
    {
        $breadcrumb = [
            [
                'href' => route('field.index'),
                'text' => 'Поля'
            ],
            [
                'text' => 'Просмотр полей'
            ]
        ];

        return view('oleus.field.show')
            ->with('field', $field)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Field $field
     * @return mixed
     */
    public function edit(Field $field)
    {
        $breadcrumb = [
            [
                'href' => route('field.index'),
                'text' => 'Поля'
            ],
            [
                'text' => 'Редактирование поля'
            ]
        ];

        return view('oleus.field.edit')
            ->with('field', $field)
            ->with('types', $this->types)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Request $request
     * @param Field $field
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Field $field)
    {
        $data = $request->all();

        if($data['title'] == null){
            Session::flash('notify', [
                'status' => 'warning',
                'message' => 'Поле не создано'
            ]);
            return redirect()->back()->withInput();
        }
        if(isset($data['required'])) $data = ['required' => 1];
        else $data = ['required' => 0];
        $field->update($data);

        Session::flash('notify', [
            'status'  => 'success',
            'message' => 'Поле обновлено'
        ]);

        return redirect()->route('field.index');
    }

    /**
     * @param Field $field
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Field $field)
    {
        if ($field->delete()) {
            Session::flash('notify', [
                'status' => 'success',
                'message' => 'Поле удаленно'
            ]);
        } else {
            Session::flash('notify', [
                'status' => 'danger',
                'message' => 'Не удалось удалить поле'
            ]);
        }

        return back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sort(Request $request)
    {
        if ($request->ajax()){
            $data = $request->all();

            foreach ($data['arr'] as $position => $id) {
                $field = Field::find($id);
                $fields = $field->forms()->where('field_id', $field->id)->get();

                foreach ($fields as $item){
                    $item->pivot->sort = $position;
                    $item->pivot->save();
                }
            }
        }

        return redirect()->back();
    }
}
