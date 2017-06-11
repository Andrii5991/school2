<?php

namespace App\Http\Controllers;

use App\Block;
use App\Advantage;
use App\Form;
use App\Lead;
use App\Mail\CallBack;
use App\Mail\MailAdminEmail;
use App\Menu;
use App\Title;
use App\Variable;
use App\Review;
use App\Withits;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $types = [
            'Текстовое' => 'text',
            'Числовое' => 'number',
            'Телефон' => 'phone',
            'Эл. адрес' => 'email',
            'Селект' => 'select',
            'Радио' => 'radio',
            'Чекбокс' => 'checkbox',
        ];

        $menu = Menu::active()
            ->orderBy('sort', 'asc')
            ->get();
        $phones = [];
        $titleObj = null;
        $form = null;
        $fields = [];
        $title_phones = [];
        $advantages = Advantage::active()
            ->orderBy('sort', 'asc')
            ->get();
        $texts = Block::where('bundle', 'static_text')->orWhere('bundle', 'blocks')
            ->orderBy('sort', 'asc')
            ->get();
        $reviews = Review::active()
            ->orderBy('sort', 'asc')
            ->get();
        foreach ($reviews as $review) {
            $review->url = json_decode($review->url, true);
        }
        for ($i = 1; $i < 4; $i++) {
            $phone = Variable::where('key', "phone$i")->get();

            if (isset($phone[0]) && $phone[0] != null) {
                array_push($phones, $phone[0]->value);
            }
        }
        $contacts = Variable::all()->pluck('value', 'key');

        $call_back_fields = [];
        if(!isset($contacts['call_back'])) $call_back = null;
        else {
            $call_back = Form::where('id', $contacts['call_back'])->first();
            if (isset($call_back) && $call_back->status) {
                if ($call_back->fields->count() != 0) {
                    foreach ($call_back->fields as $field) {
                        $call_back_fields[] = [
                            'type' => $types[$field->type],
                            'name' => $field->mask,
                            'placeholder' => $field->title,
                            'required' => $field->required,
                        ];
                    }
                } else {
                    Session::flash('fields_bot', ['status' => 'warning', 'message' => 'Форма не имеет полей!']);
                }
            }
        }

        if(isset($request->utm_content)){
            $titleObj = Title::active()->where('utm', $request->utm_content)->first();
            if (!isset($titleObj)) {
                $titleObj = null;
            } else {
                $titleObjPhones = explode(",", $titleObj->phone);
                foreach ($titleObjPhones as $phone){
                    if(!empty($phone)) $title_phones[] = $phone;
                }
                $this->allTitleData($titleObj, $types);
            }
        } else {
            $titles = Title::active()->get();
            if ($titles->count() == 0) {
                $titles = null;

                Session::flash('title', ['status' => 'warning', 'message' => 'Опубликованых заголовков нет!']);
            }

            if (!isset($contacts['title'])) {
                Session::flash('contact',
                    ['status' => 'warning', 'message' => 'Опубликованый заголовок в настройках не выбран!']);
            }


            if (is_null($titles) || !isset($contacts['title'])) {
                Session::flash('form', ['status' => 'warning', 'message' => 'У заголовка не выбрана форма!']);
            } else {
                foreach ($titles as $title) {
                    if ($title->title == $contacts['title']) {
                        $titleObj = $title;
                    }
                }
                if (isset($titleObj)) {
                    $titleObjPhones = explode(",", $titleObj->phone);
                    foreach ($titleObjPhones as $phone){
                        if(!empty($phone)) $title_phones[] = $phone;
                    }
                    $this->allTitleData($titleObj, $types);
                }
            }
        }

        $ip = $_SERVER["REMOTE_ADDR"];
        if (isset($ip)) {
            if (!isset($titleObj)) {
                $lastUser = Withits::where('check', 1)->orderBy('id', 'desc')->first();
                $thisUser = Withits::where('user_ip', $ip)->where('check', 1)->first();
                $nextTitle = 0;
                if (isset($thisUser)) {
                    $titleObj = Title::where('id', $thisUser->title)->active()->first();
                    if (!isset($titleObj)) {
                        if (isset($lastUser) && $lastUser->id != $thisUser->id) {
                            $nextTitle = $lastUser->numeric + 1;
                            if ($nextTitle >= 3) {
                                $nextTitle = 0;
                            }
                        }
                        $title_mun = Title::active()->get();
                        if (count($title_mun) > 0) {
                            if (isset($title_mun[$nextTitle])) {
                                $titleObj = $title_mun[$nextTitle];
                            } else {
                                $nextTitle = 0;
                                $titleObj = $title_mun[0];
                            }
                        } else {
                            $titleObj = null;
                        }
                    }
                } else {
                    if (isset($lastUser)) {
                        $nextTitle = $lastUser->numeric + 1;
                        if ($nextTitle >= 3) {
                            $nextTitle = 0;
                        }
                    }
                    $title_mun = Title::active()->get();
                    if (count($title_mun) > 0) {
                        if (isset($title_mun[$nextTitle])) {
                            $titleObj = $title_mun[$nextTitle];
                        } else {
                            $nextTitle = 0;
                            $titleObj = $title_mun[0];
                        }
                    } else {
                        $titleObj = null;
                    }
                    if (isset($titleObj)) {
                        Withits::create([
                            'user_ip' => $ip, 'title' => $titleObj->id,
                            'check' => 1, 'numeric' => $nextTitle
                        ]);
                        $titleObj->update([
                            'views' => $titleObj['views'] += 1,
                            'conversion' => (($titleObj['lead'] * 100) / $titleObj['views'] += 1)
                        ]);
                    }
                }
                if (isset($titleObj)) {
                    $titleObjPhones = explode(",", $titleObj->phone);
                    foreach ($titleObjPhones as $phone){
                        if(!empty($phone)) $title_phones[] = $phone;
                    }
                    $this->allTitleData($titleObj, $types);
                }
            } else {
                $guest = Withits::where('user_ip', $ip)
                    ->where('title', $titleObj->id)
                    ->where('check', 0)
                    ->get();

                if (count($guest) == 0) {
                    Withits::create(['user_ip' => $ip, 'title' => $titleObj->id]);

                    $titleObj->update([
                        'views' => $titleObj['views'] += 1,
                        'conversion' => (($titleObj['lead'] * 100) / $titleObj['views'] += 1)
                    ]);
                }
            }
        }

        $days_name = [
            'mon' => 'Пон',
            'tue' => 'Вто',
            'wen' => 'Сре',
            'thu' => 'Чет',
            'fri' => 'Пят',
            'sat' => 'Суб',
            'sun' => 'Нед'
        ];
        $alldays = null;
        $days7 = null;
        $days5 = null;
        if (isset($contacts['wt_all_from']) && isset($contacts['wt_all_to'])) {
            $days7[] = $contacts['wt_all_from'];
            $days7[] = $contacts['wt_all_to'];
            $days7[] = $contacts['rt_all_from'];
            $days7[] = $contacts['rt_all_to'];
        }
        if (isset($contacts['wt_5_from']) && isset($contacts['wt_5_to'])) {
            $days5[] = $contacts['wt_5_from'];
            $days5[] = $contacts['wt_5_to'];
            $days5[] = $contacts['rt_5_from'];
            $days5[] = $contacts['rt_5_to'];
        }
        foreach ($days_name as $day => $mas) {
            if (isset($contacts['wt_' . $day . '_from'])) {
                $alldays[] = $day;
                $alldays[] = $contacts['wt_' . $day . '_from'];
                $alldays[] = $contacts['wt_' . $day . '_to'];
                $alldays[] = $contacts['rt_' . $day . '_from'];
                $alldays[] = $contacts['rt_' . $day . '_to'];
            } else {
                for ($i = 0; $i < 5; $i++) {
                    $alldays[] = null;
                }
            }
        }
        $view_day7 = $days7;
        $view_day5 = $days5;
        $view_allday = null;
        $coutDaysWhereShowAllDays = 3;
        $totalCoutDays = 0;
        for ($i = 0; $i < count($alldays); $i += 5) {
            if ($alldays[$i+1] != null) $totalCoutDays++;
        }
        if($totalCoutDays > $coutDaysWhereShowAllDays) { $view_day7 = null; $view_day5 = null;}

        return view('welcome')
            ->with('menu', $menu)
            ->with('phones', $phones)
            ->with('advantages', $advantages)
            ->with('reviews', $reviews)
            ->with('contacts', $contacts)
            ->with('texts', $texts)
            ->with('form', $form)
            ->with('fields', $fields)
            ->with('titleObj', $titleObj)
            ->with('title_phones', $title_phones)
            ->with('days7', $days7)
            ->with('days5', $days5)
            ->with('alldays', $alldays)
            ->with('days_name', $days_name)
            ->with('view_day7', $view_day7)
            ->with('view_day5', $view_day5)
            ->with('view_allday', $view_allday)
            ->with('types', $types)
            ->with('call_back', $call_back)
            ->with('call_back_fields', $call_back_fields);
    }

    public function allTitleData($titleObj, $types)
    {
        if (isset($titleObj->form)) {
            $form = Form::where('id', $titleObj->form)->first();
            if (isset($form) && $form->status) {
                if ($form->fields->count() != 0) {
                    foreach ($form->fields as $field) {
                        $fields[] = [
                            'type' => $types[$field->type],
                            'name' => $field->mask,
                            'placeholder' => $field->title,
                            'required' => $field->required,
                        ];
                    }
                } else {
                    Session::flash('fields_bot', ['status' => 'warning', 'message' => 'Форма не имеет полей!']);
                }
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendEmail(Request $request)
    {
        $data = $request->all();
        $emailAdmin = Variable::where('key', 'adminEmail')->first();
        $email = new MailAdminEmail($data);
        $modalMessage = '';
        if($data['check'] == 'title') $modalMessage = 'Ваша заявка отправленна!';
        else $modalMessage = 'Ожидайте звонка!';
        if (isset($emailAdmin)) {
            Mail::to($emailAdmin['value'])->send($email);
            Session::flash('check_message',
                ['message' => $modalMessage,
                    'status' => 'success']);
            if($data['check'] == 'title') {
                $form = Form::where('id', $data['formId'])->first();
                $item = ['data' => json_encode($data, true),];
                if (isset($data['titleId'])) {
                    $title = Title::where('id', $data['titleId'])->first();
                    if (isset($title)) {
                        $title->update(['lead' => ($title->lead + 1),]);
                    }
                    $item = ['title_id' => $data['titleId'], 'data' => json_encode($data, true),];
                }
                $lead = Lead::create($item);
                $form->lead()->save($lead);
            }
        }
        return redirect()->route('home');
    }

    public function callBack(Request $request)
    {
        $data = $request->all();
        $emailAdmin = Variable::where('key', 'adminEmail')->first();
        $email = new CallBack($data);
        if (isset($emailAdmin)) {
            Mail::to($emailAdmin['value'])->send($email);
            Session::flash('call_back',
                ['message' => 'Ожидайте звонка!',
                    'status' => 'success']);
        }
        return redirect()->route('home');
    }
}
