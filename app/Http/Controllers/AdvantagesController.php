<?php

namespace App\Http\Controllers;

use App\Block;
use App\Files;
use Illuminate\Http\Request;
use App\Advantage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AdvantagesController extends Controller
{
    /**
     * @return $this
     */
    public function index()
    {
        $advantages = Advantage::orderBy('sort', 'asc')->get();
        $breadcrumb = [
            [
                'href' => route('advantage.index'),
                'text' => 'Преимущества'
            ]
        ];

        return view('oleus.advantage.index')
            ->with('advantages', $advantages)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @return $this
     */
    public function create()
    {
        $breadcrumb = [
            [
                'href' => route('advantage.index'),
                'text' => 'Преимущества'
            ],
            [
                'text' => 'Создать преимущество'
            ]
        ];

        return view('oleus.advantage.create')
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if($data['title'] == null){
            Session::flash('notify', [
                'status' => 'warning',
                'message' => 'Преимущество не зоздано'
            ]);
            return redirect()->back()->withInput();
        }
        
        $upload_file = $request->file('image');

        if (!is_null($upload_file)) {
            $file = new Files();
            $data['image'] = $file->set($upload_file);
        }

        Advantage::create($data);

//        if(Advantage::all()->count() == 0) {
        if(Block::where('bundle', 'advantages')->count() == 0) {
            $data['bundle'] = 'advantages';
            Block::create($data);
        }

        Session::flash('notify', [
            'status'  => 'success',
            'message' => 'Преимущество создано'
        ]);

        return redirect()->route('advantage.index');
    }

    /**
     * @param Advantage $advantage
     * @return $this
     */
    public function show(Advantage $advantage)
    {
        $breadcrumb = [
            [
                'href' => route('advantage.index'),
                'text' => 'Преимущества'
            ],
            [
                'text' => $advantage->title
            ]
        ];

        $image = Files::find($advantage->image);

        return view('oleus.advantage.show')
            ->with('advantage', $advantage)
            ->with('image', $image)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Advantage $advantage
     * @return $this
     */
    public function edit(Advantage $advantage)
    {
        $breadcrumb = [
            [
                'href' => route('advantage.index'),
                'text' => 'Преимущества'
            ],
            [
                'text' => $advantage->title
            ]
        ];

        $image = Files::find($advantage->image);

        return view('oleus.advantage.edit')
            ->with('advantage', $advantage)
            ->with('image', $image)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Request $request
     * @param Advantage $advantage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Advantage $advantage)
    {
        $data = $request->all();
        if($data['title'] == null){
            Session::flash('notify', [
                'status' => 'warning',
                'message' => 'Преимущество не обновлено'
            ]);
            return redirect()->back()->withInput();
        }
        if (!isset($data['status'])) {
            $data['status'] = 0;
        }

        $upload_file = $request->file('image');
        if (is_null($upload_file)) {
            array_forget($data, 'image');
        } else {
            $file = new Files();
            $data['image'] = $file->set($upload_file);
        }

        $advantage->update($data);

        Session::flash('notify', [
            'status'  => 'success',
            'message' => 'Преимущество обновлено'
        ]);

        return redirect()->route('advantage.index');
    }

    /**
     * @param Advantage $advantage
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Advantage $advantage)
    {
        if ($advantage->delete()) {
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
        if ($request->ajax()){
            $data = $request->all();

            foreach ($data['arr'] as $position => $id) {
                $advantage = Advantage::find($id);
                $advantage->sort = $position;
                $advantage->status = $data['checked'][$position];
                $advantage->save();
            }
        }

        return redirect()->back();
    }
}
