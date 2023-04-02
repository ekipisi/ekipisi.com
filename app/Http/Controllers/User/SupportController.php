<?php

namespace App\Http\Controllers\User;

use App\Models\TicketModel;
use App\Models\TicketMessageModel;
use App\Models\DepartmentModel;
use App\Models\UserProductModel;
use App\Models\UserModel;
use App\Models\UserMailActivityModel;
use App\Models\TicketPriorityModel;
use App\Models\TicketTypeModel;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Http\Requests\TicketReplyRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SupportController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function home(Request $request)
    {
        $this->seo()->setTitle(__('user.support.title'));

        $query = $request->input('query');

        $tickets = TicketModel::where('user_id', Auth::id());

        if (!empty($query)){
            $tickets = $tickets->where('title', 'like', '%' . $query . '%');
        }

        $tickets = $tickets->orderByDesc('created_at')->paginate(config('app.page.size'));

        return view('user/support/home')
                ->with('query', $query)
                ->with('tickets', $tickets);
    }

    public function add(Request $request){

        $this->seo()->setTitle(__('user.support.add.title'));

        $departments = DepartmentModel::where('status', 1)->orderBy('sort_order')->get();
        $services = UserProductModel::where('user_id', Auth::id())->get();
        $priorities = TicketPriorityModel::all();

        $data = [];
        if ($request->get('subject')){

            $subject = $request->get('subject');

            if ($subject == "katre-xml") {
                $data = [
                    'title' => "Katre XML Entegrasyonu",
                    'department_id' => 4,
                    'priority_id' => 2
                ];
            }

            if ($subject == "kolay-baglanti") {
                $data = [
                    'title' => "Kolay Bağlantı Modülü",
                    'department_id' => 5,
                    'priority_id' => 2
                ];
            }
        }

        return view('user/support/add')
                ->with('departments', $departments)
                ->with('services', $services)
                ->with('priorities', $priorities)
                ->with('data', $data);
    }

    public function ticket_add(TicketRequest $request) {

        $department = $request->department;
        $priority = $request->priority;
        $service = $request->service;
        $title = $request->title;
        $message = $request->message;
        $multiple_path = array();

        if ($request->hasFile('fielduploader')) {
            for ($i = 0; $i < count($request->file('fielduploader')); $i++) {
                array_push($multiple_path, $request->file('fielduploader')[$i]->store(Auth::id(), 'warden'));
            }
        }

        $ticket = TicketModel::create([
            'user_id' => Auth::id(),
            'status_id' => 1,
            'department_id' => $department,
            'service_id' => $service,
            'priority_id' => $priority,
            'type_id' => 0,
            'title' => $title,
            'message' => $message,
            'notes' => '',
            'file' => $multiple_path,
            'ip' => \Request::ip()
        ]);

        $user = UserModel::where('id', Auth::id())->first();

        $ticket_id = $ticket->id;
        $name = $user->firstname . " " . $user->lastname;
        $email = $user->email;

        $data = array(
            'id' => $ticket_id,
            'title' => $title,
            'status' => $ticket->status['name'],
            'description' => $message,
            'name' => $name,
            'email' => $email,
            'activity_id' => 0
        );

        $activity = UserMailActivityModel::create([
            'user_id' => Auth::id(),
            'title' => '[Ticket ID: ' . $ticket_id . '] ' . $title,
            'message' => view('mail/support/create', $data),
            'read' => 0
        ]);

        $data['activity_id'] = $activity->id;

        \Mail::send('mail/support/create', $data, function ($message) use ($name, $email, $user, $activity, $ticket_id, $title) {
            $message
                ->to($email, $name)
                ->from(config('support.mail'), config('app.name'))
                ->replyTo(config('support.reply'), config('app.name'))
                ->subject('[Ticket ID: ' . $ticket_id . '] ' . $title)
                ->embedData([
                    'categories' => ['ekipisi_support_create'],
                    'custom_args' => [
                        'user_id' => strval($user->id),
                        'name' => strval($name),
                        'email' => strval($email),
                        'ticket_id' => strval($ticket_id),
                        'activity_id' => strval($activity->id)
                    ]
                ], 'sendgrid/x-smtpapi');
        });

        if (config("app.pushbullet")){
            \PushBullet::device(config('app.pushbullet.device'))->note('Destek Talebi: ' . Auth::user()->firstname . " " . Auth::user()->lastname , $message);
        }

        return redirect(route('user.support.detail', $ticket->id))->withErrors(['updated' => 'Destek talebiniz kaydedildi.']);
    }

    public function detail($id){

        $this->seo()->setTitle(__('user.support.detail.title'));

        $ticket = TicketModel::where(['user_id' => Auth::id(), 'id' => $id])->first();
        $supporter = TicketMessageModel::where(['ticket_id'=> $id, ['assign_id', '!=', 0]])->distinct()->get(['assign_id']);

        return view('user/support/detail')
                ->with('ticket', $ticket)
                ->with('supporter', $supporter);
    }

    public function reply_add(TicketReplyRequest $request, $id) {

        $msg = $request->message;

        $multiple_path = array();

        if ($request->hasFile('fielduploader')) {
            for ($i = 0; $i < count($request->file('fielduploader')); $i++) {
                array_push($multiple_path, $request->file('fielduploader')[$i]->store(Auth::id(), 'warden'));
            }
        }

        TicketMessageModel::create([
            'ticket_id' => $id,
            'assign_id' => 0,
            'user_id' => Auth::id(),
            'message' => $msg,
            'file' => $multiple_path,
            'ip' => \Request::ip()
        ]);

        TicketModel::find($id)->update([
            'status_id' => config('support.customer.status')
        ]);

        $ticket = TicketModel::where('id', $id)->first();
        $user = UserModel::where('id', Auth::id())->first();

        $name = $user->firstname . " " . $user->lastname;
        $email = $user->email;
        $title = $ticket->title;
        $department = $ticket->department['name'];
        $status = $ticket->status['name'];

        $data = array(
            'id' => $id,
            'title' => $title,
            'description' => $msg,
            'name' => $name,
            'email' => $email,
            'department' => $department,
            'status' => $status,
            'activity_id' => 0
        );

        $activity = UserMailActivityModel::create([
            'user_id' => Auth::id(),
            'title' => '[Ticket ID: ' . $id . '] ' . $title,
            'message' => view('mail/support/reply', $data),
            'read' => 0
        ]);

        $data['activity_id'] = $activity->id;

        \Mail::send('mail/support/reply', $data, function ($message) use ($name, $email, $user, $activity, $ticket, $id, $title) {
            $message
                ->to($email, $name)
                ->from(config('support.mail'), config('app.name'))
                ->replyTo(config('support.reply'), config('app.name'))
                ->subject('[Ticket ID: ' . $id . '] ' . $title)
                ->embedData([
                    'categories' => ['ekipisi_register'],
                    'custom_args' => [
                        'user_id' => strval($user->id),
                        'name' => strval($name),
                        'email' => strval($email),
                        'ticket_id' => strval($ticket->id),
                        'activity_id' => strval($activity->id)
                    ]
                ], 'sendgrid/x-smtpapi');
        });

        if (config("app.pushbullet")){
            \PushBullet::device(config('app.pushbullet.device'))->note('Müşteri Cevap Yazdı: ' . Auth::user()->firstname . " " . Auth::user()->lastname , $msg);
        }

        return redirect(route('user.support.detail', $id))->withErrors(['updated' => 'Mesajınız kaydedildi.']);
    }


}
