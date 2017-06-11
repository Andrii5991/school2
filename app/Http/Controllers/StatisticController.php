<?php

namespace App\Http\Controllers;

use App\Title;

class StatisticController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        $breadcrumb = [
            [
                'text' => 'Cтатистика'
            ]
        ];

        $titles = Title::all();

        return view('oleus.statistic.index')
            ->with('titles', $titles)
            ->with('breadcrumb', $breadcrumb);
    }
}
