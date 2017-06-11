<?php

namespace App\Http\Controllers;

use App\Block;
use App\Files;
use App\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class BlocksController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        $blocks = Block::orderBy('sort', 'asc')->get();
        $breadcrumb = [
            [
                'href' => route('block.index'),
                'text' => 'Блоки'
            ]
        ];

        return view('oleus.block.index')
            ->with('blocks', $blocks)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @return string
     */
    public function indexText()
    {
        $texts = Block::where('bundle', 'static_text')->get();
        $breadcrumb = [
            [
                'href' => route('text.index'),
                'text' => 'Статические тексти'
            ]
        ];

        return view('oleus.static_text.index')
            ->with('texts', $texts)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @return $this
     */
    public function create()
    {
        $breadcrumb = [
            [
                'href' => route('block.index'),
                'text' => 'Блоки'
            ],
            [
                'text' => 'Создать блок'
            ]
        ];

        return view('oleus.block.create')
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @return $this
     */
    public function createText()
    {
        $breadcrumb = [
            [
                'href' => route('text.index'),
                'text' => 'Статические тексти'
            ],
            [
                'text' => 'Создать статический текст'
            ]
        ];

        $forms = Form::all();

        return view('oleus.static_text.create')
            ->with('breadcrumb', $breadcrumb)
            ->with('forms', $forms);
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
                'message' => 'Блок не создан'
            ]);
            return redirect()->back()->withInput();
        } else {
            $upload_file = $request->file('image');
            if (!is_null($upload_file)) {
                $file = new Files();
                $data['image'] = $file->set($upload_file);
            }
            $upload_file = $request->file('background');
            if (!is_null($upload_file)) {
                $file = new Files();
                $data['background'] = $file->set($upload_file);
            }
            Block::create($data);

            Session::flash('notify', [
                'status' => 'success',
                'message' => 'Блок создан'
            ]);

            return redirect()->route('block.index');
        }
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function storeText(Request $request)
    {
        $data = $request->all();

        if ($data['title'] == null) {
            Session::flash('notify', [
                'status' => 'warning',
                'message' => 'Статический текст не создан'
            ]);
            return redirect()->back()->withInput();
        } else {
            $upload_file = $request->file('image');
            if (!is_null($upload_file)) {
                $file = new Files();
                $data['image'] = $file->set($upload_file);
            }

            $upload_file = $request->file('background');
            if (!is_null($upload_file)) {
                $file = new Files();
                $data['background'] = $file->set($upload_file);
            }
            $data['bundle'] = 'static_text';
            $text = Block::create($data);

            if(!is_null($data['form'])) {
                $form = Form::where('id', $data['form'])->first();
                $form->text()->save($text);
            }

            Session::flash('notify', [
                'status' => 'success',
                'message' => 'Статический текст создан'
            ]);

            return redirect()->route('text.index');
        }
    }

    /**
     * @param Block $block
     * @return mixed
     */
    public function show(Block $block)
    {
        $bundle = null;
        foreach (config('config.bundle') as $key => $val) {
            if($block->bundle == $key) $bundle = $val;
        }

        $location = null;
        foreach (config('config.location_image') as $path => $val) {
            if($block->location_image == $path) $location = $val;
        }

        $breadcrumb = [
            [
                'href' => route('block.index'),
                'text' => 'Блоки',
            ],
            [
                'text' => $block->title,
            ]
        ];
        $image = Files::find($block->image);
        $background = Files::find($block->background);

        return view('oleus.block.show')
            ->with('location', $location)
            ->with('bundle', $bundle)
            ->with('block', $block)
            ->with('image', $image)
            ->with('background', $background)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Block $block
     * @return mixed
     */
    public function edit(Block $block)
    {
        $breadcrumb = [
            [
                'href' => route('block.index'),
                'text' => 'Блоки'
            ],
            [
                'text' => $block->title
            ]
        ];

        $image = Files::find($block->image);
        $background = Files::find($block->background);

        return view('oleus.block.edit')
            ->with('block', $block)
            ->with('background', $background)
            ->with('image', $image)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Block $text
     * @return mixed
     */
    public function editText(Block $text)
    {
        $breadcrumb = [
            [
                'href' => route('text.index'),
                'text' => 'Статический текст'
            ],
            [
                'text' => $text->title
            ]
        ];

        $image = Files::find($text->image);
        $background = Files::find($text->background);
        $forms = Form::all();

        return view('oleus.static_text.edit')
            ->with('background', $background)
            ->with('text', $text)
            ->with('forms', $forms)
            ->with('image', $image)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Request $request
     * @param Block   $block
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Block $block)
    {
        $data = $request->all();

        if ($data['title'] == null) {
            Session::flash('notify', [
                'status' => 'warning',
                'message' => 'Блок не обновлен'
            ]);
            return redirect()->back()->withInput();
        }

        $upload_file = $request->file('image');

        if (is_null($upload_file)) {
            array_forget($data, 'image');
        } else {
            $file = new Files();
            $data['image'] = $file->set($upload_file);
        }

        $upload_file = $request->file('background');

        if (is_null($upload_file)) {
            array_forget($data, 'background');
        } else {
            $file = new Files();
            $data['background'] = $file->set($upload_file);
        }

        if (!isset($data['status'])) {
            $data['status'] = 0;
        }

        $block->update($data);

        Session::flash('notify', [
            'status' => 'success',
            'message' => 'Блок обновлен'
        ]);

        return redirect()->route('block.index');
    }

    /**
     * @param Request $request
     * @param Block   $text
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateText(Request $request, Block $text)
    {
        $data = $request->all();

        if ($data['title'] == null) {
            Session::flash('notify', [
                'status' => 'warning',
                'message' => 'Блок не обновлен'
            ]);
            return redirect()->back()->withInput();
        }

        $upload_file = $request->file('image');

        if (is_null($upload_file)) {
            array_forget($data, 'image');
        } else {
            $file = new Files();
            $data['image'] = $file->set($upload_file);
        }

        $upload_file = $request->file('background');

        if (is_null($upload_file)) {
            array_forget($data, 'background');
        } else {
            $file = new Files();
            $data['background'] = $file->set($upload_file);
        }

        if (!isset($data['status'])) {
            $data['status'] = 0;
        }
        $text->update($data);

        if(!is_null($data['form'])) {
            $form = Form::where('id', $data['form'])->first();
            $form->text()->save($text);
        }

        Session::flash('notify', [
            'status' => 'success',
            'message' => 'Статический текст обновлен'
        ]);

        return redirect()->route('text.index');
    }

    /**
     * @param Block $block
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Block $block)
    {
        if ($block->delete()) {
            Session::flash('notify', [
                'status' => 'success',
                'message' => 'Блок удален'
            ]);
        } else {
            Session::flash('notify', [
                'status' => 'danger',
                'message' => 'Не удалось удалить блок'
            ]);
        }

        return back();
    }

    /**
     * @param Block $text
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyText(Block $text)
    {
        if ($text->delete()) {
            Session::flash('notify', [
                'status' => 'success',
                'message' => 'Статический текст удален'
            ]);
        } else {
            Session::flash('notify', [
                'status' => 'danger',
                'message' => 'Не удалось удалить статический текст'
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
                $block = Block::find($id);
                $block->sort = $position;
                $block->status = $data['checked'][$position];
                $block->save();
            }
        }

        return redirect()->back();
    }
}
