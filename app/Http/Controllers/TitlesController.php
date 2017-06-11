<?php

namespace App\Http\Controllers;

use App\Files;
use App\Form;
use App\Variable;
use App\Withits;
use Illuminate\Http\Request;
use App\Title;
use App\Block;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class TitlesController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        $title = Title::orderBy('sort', 'asc')->get();
        $breadcrumb = [
            [
                'text' => 'Заголовок'
            ]
        ];

        return view('oleus.titles.index')
            ->with('titles', $title)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Title $title
     * @return mixed
     */
    public function create(Title $title)
    {
        $templates = Storage::disk('public')->files('templates');

        $breadcrumb = [
            [
                'href' => route('title.index'),
                'text' => 'Заголовок'
            ],
            [
                'text' => 'Новый заголовок'
            ],
        ];

//        $form_ids = Title::all()->pluck('form');
//        whereNotIn('id', $form_ids)->pluck('title', 'id');

        $forms = Form::all();

        return view('oleus.titles.create')
            ->with('titles', $title)
            ->with('forms', $forms)
            ->with('templates', $templates)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if(isset($data['status']) && $data['status']) {
            $allActivTitle = Title::where('status', true)->get();
            if(count($allActivTitle) >= 3) {
                return redirect()->back()->withInput()->with('checkActive', true);
            }
        }
        if ($data['title'] == null || isset($data['logotype']) == null || $data['utm'] == null) {
            if ($data['title'] == null) {
                Session::flash('t', []);
            }

            if (isset($data['logotype']) == null) {
                Session::flash('k', []);
            }

            if ($data['utm'] == null) {
                Session::flash('u', []);
            }

            return redirect()->back()->withInput();
        } else {
            $data['phone'] = implode($data['phone'], ",");

            $upload_file = $request->file('image');

            if (!is_null($upload_file)) {
                $file = new Files();
                $data['image'] = $file->set($upload_file);
            }

            $file = new Files();
            $data['logotype'] = $file->set($upload_file);

            $upload_file = $request->file('logotype');
            $file = new Files();
            $data['logotype'] = $file->set($upload_file);

            $data['views'] = 0;
            $data['lead'] = 0;

            Title::create($data);

            if (Block::where('bundle', 'title')->count() == 0) {
                $data['bundle'] = 'title';
                Block::create($data);
            }

            Session::flash('notify', [
                'status' => 'success',
                'message' => 'Заголовок создан'
            ]);

            return redirect()->route('title.index');
        }
    }

    /**
     * @param Title $title
     * @return mixed
     */
    public function show(Title $title)
    {
        $breadcrumb = [
            [
                'href' => route('title.index'),
                'text' => 'Заголовок'
            ],
            [
                'text' => $title->title
            ]
        ];

        $image = Files::find($title->image);
        $logo = Files::find($title->logotype);
        $template_image = null;
        $phones = explode(",", $title->phone);

        foreach (config('template.templates') as $template) {
            if ($template['blade'] == $title->templates) {
                $template_image = $template['image'];
            }
        }

        return view('oleus.titles.show')
            ->with('title', $title)
            ->with('image', $image)
            ->with('logo', $logo)
            ->with('template_image', $template_image)
            ->with('phones', $phones)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Title $title
     * @return mixed
     */
    public function edit(Title $title)
    {
        $templates = config('template.templates');

        $breadcrumb = [
            [
                'href' => route('title.index'),
                'text' => 'Заголовок'
            ],
            [
                'text' => $title->title
            ]
        ];

        if (!is_null($title->form)) {
            $form = Form::where('id', $title->form)->first();
        } else {
            $form = null;
        }

        $image = Files::find($title->image);
        $logo = Files::find($title->logotype);
        $forms = Form::all();
        $phones = explode(",", $title->phone);

        return view('oleus.titles.edit')
            ->with('title', $title)
            ->with('image', $image)
            ->with('logo', $logo)
            ->with('forms', $forms)
            ->with('form', $form)
            ->with('phones', $phones)
            ->with('breadcrumb', $breadcrumb)
            ->with('templates', $templates);
    }

    /**
     * @param Request $request
     * @param Title   $title
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Title $title)
    {
        $data = $request->all();

        
        if(isset($data['status']) && $data['status']) {
            $allActivTitle = Title::where('status', true)->get();
            if(count($allActivTitle) >= 3) {
                return redirect()->back()->withInput()->with('checkActive', true);
            }
        }
        
        if ($data['title'] == null || $data['utm'] == null) {
            if ($data['title'] == null) {
                Session::flash('t', []);
            }

            if ($data['utm'] == null) {
                Session::flash('u', []);
            }

            return redirect()->back()->withInput();
        }

        $contacts = Variable::all()->pluck('value', 'key');

        if (isset($contacts['title']) && $contacts['title'] == $title->title) {
            Variable::updateOrCreate(
                ['key' => 'title'],
                ['value' => $data['title']]
            );
        }
        $data['phone'] = implode($data['phone'], ",");

        $upload_file = $request->file('image');

        if (is_null($upload_file)) {
            array_forget($data, 'image');
        } else {
            $file = new Files();
            $data['image'] = $file->set($upload_file);
        }

        $upload_file = $request->file('logotype');

        if (is_null($upload_file)) {
            array_forget($data, 'logotype');
        } else {
            $file = new Files();
            $data['logotype'] = $file->set($upload_file);
        }

        if (!isset($data['status'])) {
            $data['status'] = 0;
        }

        if ($title->title != $data['title']) {
            $all_withits = Withits::where('title', $title->title)->get();

            foreach ($all_withits as $item) {
                $item->update(['title' => $data['title']]);
            }
        }
        $title->update($data);

        Session::flash('notify', [
            'status' => 'success',
            'message' => 'Заголовок обновлен'
        ]);

        return redirect()->route('title.index');
    }

    /**
     * @param Title $title
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Title $title)
    {
        if ($title->delete()) {
            $all_withits = Withits::where('title', $title->title)->get();

            foreach ($all_withits as $item) {
                $item->delete();
            }

            Session::flash('notify', [
                'status' => 'success',
                'message' => 'Заголовок удален'
            ]);
        } else {
            Session::flash('notify', [
                'status' => 'danger',
                'message' => 'Не удалось удалить заголовок'
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
                $title = Title::find($id);
                $title->sort = $position;
                $title->status = $data['checked'][$position];
                $title->save();
            }
        }

        return redirect()->back();
    }
}
