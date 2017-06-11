<?php

namespace App\Http\Controllers;

use App\Block;
use App\Files;
use App\Review;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    private $urls = [
        'WWW',
        'Facebook',
        'VK.com',
        'Одноклассники',
        'Linkedin',
        'Google+',
        'Instagramm',
        'Twitter',
        'LiveJournal',
        'Другое',
    ];

    /**
     * @return mixed
     */
    public function index()
    {
        $reviews = Review::orderBy('sort', 'asc')->get();

        $breadcrumb = [
            [
                'text' => 'Отзывы'
            ]
        ];

        return view('oleus.review.index')
            ->with('reviews', $reviews)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $breadcrumb = [
            [
                'href' => route('review.index'),
                'text' => 'Oтзывы'
            ],
            [
                'text' => 'Новый отзыв'
            ],
        ];

        return view('oleus.review.create')
            ->with('urls', $this->urls)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if ($data['name'] == null || $data['body'] == null) {
            if ($data['name'] == null) {
                Session::flash('t', []);
            }

            if ($data['body'] == null) {
                Session::flash('b', []);
            }

            return redirect()->back()->withInput();
        }

        if (isset($data['sel_url'])) {
            $sel_url = $data['sel_url'];
            $url = $data['url'];

            for ($q = 0; $q < count($sel_url); $q++) {
                if (!is_null($url[$q])) {
                    $all_url[] = preg_replace('/\s+/', '', $sel_url[$q]);
                    $all_url[] = preg_replace('/\s+/', '', $url[$q]);
                }
            }
            $data['url'] = json_encode(array_combine($sel_url, $url));
        }

        $upload_file = $request->file('image');

        if (!is_null($upload_file)) {
            $file = new Files();
            $data['image'] = $file->set($upload_file);
        }

        Review::create($data);

        if (Block::where('bundle', 'review')->count() == 0) {
            $data['bundle'] = 'review';
            Block::create($data);
        }

        Session::flash('notify', [
            'status' => 'success',
            'message' => 'Отзыв создан'
        ]);

        return redirect()->route('review.index');
    }

    /**
     * @param Review $review
     * @return mixed
     */
    public function edit(Review $review)
    {
        $breadcrumb = [
            [
                'href' => route('review.index'),
                'text' => 'Отзывы'
            ],
            [
                'text' => $review->name,
            ],
        ];

        $review_urls = null;
        if(isset($review->url)) {
            $review->url = json_decode($review->url, true);
        }
        $image = Files::find($review->image);

        return view('oleus.review.edit')
            ->with('review', $review)
            ->with('image', $image)
            ->with('review_urls', $review_urls)
            ->with('urls', $this->urls)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Request $request
     * @param Review  $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Review $review)
    {
        $data = $request->all();

        if ($data['name'] == null || $data['body'] == null) {
            if ($data['name'] == null) {
                Session::flash('t', []);
            }

            if ($data['body'] == null) {
                Session::flash('b', []);
            }

            return redirect()->back()->withInput();
        }

        if (isset($data['sel_url'])) {
            $sel_url = $data['sel_url'];
            $url = $data['url'];

            for ($q = 0; $q < count($sel_url); $q++) {
                if (!is_null($url[$q])) {
                    $all_url[] = preg_replace('/\s+/', '', $sel_url[$q]);
                    $all_url[] = preg_replace('/\s+/', '', $url[$q]);
                }
            }
            $data['url'] = json_encode(array_combine($sel_url, $url));
        }

        $upload_file = $request->file('image');

        if (is_null($upload_file)) {
            array_forget($data, 'image');
        } else {
            $file = new Files();
            $data['image'] = $file->set($upload_file);
        }

        if (!isset($data['status'])) {
            $data['status'] = 0;
        }

        $review->update($data);

        if (($request->input('status')) == null) {
            $review->update(['status' => 0]);
        }

        Session::flash('notify', [
            'status' => 'success',
            'message' => 'Отзыв обновлен'
        ]);

        return redirect()->route('review.index');
    }

    /**
     * @param Review $review
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Review $review)
    {
        if ($review->delete()) {
            Session::flash('notify', [
                'status' => 'success',
                'message' => 'Отзыв удален'
            ]);
        } else {
            Session::flash('notify', [
                'status' => 'danger',
                'message' => 'Не удалось удалить отзыв'
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
                $review = Review::find($id);
                $review->sort = $position;
                $review->status = $data['checked'][$position];
                $review->save();
            }
        }
        return redirect()->back();
    }
}
