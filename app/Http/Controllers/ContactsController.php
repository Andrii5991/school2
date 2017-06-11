<?php

namespace App\Http\Controllers;

use App\Block;
use App\Title;
use App\Variable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ContactsController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        $contacts = Variable::all()->pluck('value', 'key');

        $breadcrumb = [
            [
                'href' => route('contact.index'),
                'text' => 'Контакты'
            ]
        ];

        return view('oleus.contact.index')
            ->with('contacts', $contacts)
            ->with('breadcrumb', $breadcrumb);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $days = ['mon', 'tue', 'wen', 'thu', 'fri', 'sat', 'sun',];
        $data = $request->all();
        Variable::day_save($data, 'all');
        Variable::day_save($data, '5');
        foreach ($days as $day) {
            Variable::day_save($data, $day);
        }


        if (isset($data['map_show'])) {
            Variable::updateOrCreate(
                ['key' => 'map_show'],
                ['value' => $data['map_show']]
            );
        } else {
            Variable::updateOrCreate(
                ['key' => 'map_show'],
                ['value' => 0]
            );
        }

        if (isset($data['color'])) {
            Variable::updateOrCreate(
                ['key' => 'color'],
                ['value' => $data['color']]
            );
        }

        if (isset($data['name'])) {
            Variable::updateOrCreate(
                ['key' => 'name'],
                ['value' => $data['name']]
            );
        }

        if (isset($data['latitude'])) {
            Variable::updateOrCreate(
                ['key' => 'latitude'],
                ['value' => $data['latitude']]
            );
        }

        if (isset($data['longitude'])) {
            Variable::updateOrCreate(
                ['key' => 'longitude'],
                ['value' => $data['longitude']]
            );
        }

        if (isset($data['map_position'])) {
            Variable::updateOrCreate(
                ['key' => 'map_position'],
                ['value' => $data['map_position']]
            );
        }

        for ($i = 1; $i <= 3; $i++) {
            if (isset($data["phone$i"])) {
                Variable::updateOrCreate(['key' => "phone$i"], ['value' => $data["phone$i"]]);
            } else {
                Variable::where('key', "phone$i")->delete();
            }
        }

        if (isset($data['contact_email'])) {
            Variable::updateOrCreate(
                ['key' => 'contact_email'],
                ['value' => $data['contact_email']]
            );
        }

        if (isset($data['address'])) {
            Variable::updateOrCreate(
                ['key' => 'address'],
                ['value' => $data['address']]
            );
        }

        if (isset($data['status'])) {
            Variable::updateOrCreate(
                ['key' => 'status'],
                ['value' => $data['status']]
            );
        }

        Session::flash('notify', [
            'status' => 'success',
            'message' => '"Контакты" изменены',
        ]);

        return redirect()->route('contact.index');
    }
}
