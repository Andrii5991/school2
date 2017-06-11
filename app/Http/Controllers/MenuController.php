<?php

namespace App\Http\Controllers;

use App\Block;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    /**
     * @return $this
     */
    public function index()
    {
        $menu = Menu::orderBy('sort', 'asc')->get();

        $breadcrumb = [
            [
                'text' => 'Меню'
            ]
        ];

        return view('oleus.menu.index')
            ->with('menu', $menu)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Menu $menu
     * @return mixed
     */
    public function create(Menu $menu)
    {
        $breadcrumb = [
            [
                'href' => route('menu.index'),
                'text' => 'Меню'
            ],
            [
                'text' => 'Новое меню'
            ],
        ];

        return view('oleus.menu.create')
            ->with('menu', $menu)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $menu = $request->all();

        if ($menu['block'] == 'error' || $menu['title'] == null || $menu['class'] == null) {
            if ($menu['block'] == 'error') {
                Session::flash('b', []);
            }

            if ($menu['title'] == null) {
                Session::flash('t', []);
            }

            if ($menu['class'] == null) {
                Session::flash('m', []);
            }

            return redirect()->back()->withInput();
        }

        $menu['class'] = preg_replace('/\s+/', '', $menu['class']);

        Menu::create($menu);
        if($menu['block'] >= 0) {
            $text = Block::where('id', $menu['block'])->first();
            $text->update(['class' => $menu['class']]);
        }

        Session::flash('notify', [
            'status' => 'success',
            'message' => 'Меню создано'
        ]);

        return redirect()->route('menu.index');
    }

    /**
     * @param Menu $menu
     * @return mixed
     */
    public function show(Menu $menu)
    {
        $breadcrumb = [
            [
                'href' => route('menu.index'),
                'text' => 'Меню'
            ],
            [
                'text' => $menu->title
            ],
        ];

        return view('oleus.menu.show')
            ->with('menu', $menu)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Menu $menu
     * @return mixed
     */
    public function edit(Menu $menu)
    {
        $breadcrumb = [
            [
                'href' => route('menu.index'),
                'text' => 'Меню'
            ],
            [
                'text' => $menu->title
            ],
        ];
        $block = null;
        if($menu->block >= 0) {
            $block = Block::where('id', $menu->block)->first();
        }

        return view('oleus.menu.edit')
            ->with('menu', $menu)
            ->with('block', $block)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Request $request
     * @param Menu $menu
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Menu $menu)
    {
        $data = $request->all();

        if ($data['title'] == null || $data['class'] == null) {
            if ($data['title'] == null) {
                Session::flash('t', []);
            }

            if ($data['class'] == null) {
                Session::flash('m', []);
            }

            return redirect()->back()->withInput();
        }

        if ($data['block'] == null) {
            Session::flash('notify', [
                'status' => 'warning',
                'message' => 'Меню не обновлено'
            ]);

            return redirect()->back()->withInput();
        }

        $data['class'] = preg_replace('/\s+/', '', $data['class']);
        $menu->update($data);

        if (($request->input('status')) == null) {
            $menu->update(['status' => 0]);
        }
        if($menu['block'] >= 0) {
            $text = Block::where('id', $data['block'])->first();
            $text->update(['class' => $menu['class']]);
        }
        
        Session::flash('notify', [
            'status' => 'success',
            'message' => 'Меню обновлено'
        ]);

        return redirect()->route('menu.index');
    }

    /**
     * @param Menu $menu
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Menu $menu)
    {
        if ($menu->delete()) {
            Session::flash('notify', [
                'status' => 'success',
                'message' => 'Преимущество удаленно'
            ]);
        } else {
            Session::flash('notify', [
                'status' => 'danger',
                'message' => 'Не удалось удалить преимущество'
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
        if ($request->ajax()) {
            $data = $request->all();

            foreach ($data['arr'] as $position => $id) {
                $menu = Menu::find($id);
                $menu->sort = $position;
                $menu->save();
            }
        }

        return redirect()->back();
    }
}
