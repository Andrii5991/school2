<?php

namespace App\Http\Controllers;

use App\Lead;

class LeadsController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        $leads = Lead::orderBy('created_at', 'desc')->get();

        $breadcrumb = [
            [
                'text' => 'Лиды'
            ]
        ];

        return view('oleus.lead.index')
            ->with('leads', $leads)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Lead $lead
     * @return mixed
     */
    public function show(Lead $lead)
    {
        $breadcrumb = [
            [
                'href' => route('lead.index'),
                'text' => 'Лиды'
            ],
            [
                'text' => $lead->form->title
            ],
        ];

        return view('oleus.lead.show')
            ->with('lead', $lead)
            ->with('breadcrumb', $breadcrumb);
    }
}
