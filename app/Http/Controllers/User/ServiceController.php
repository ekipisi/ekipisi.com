<?php

namespace App\Http\Controllers\User;

use App\Models\ProductModel;
use App\Models\TicketModel;
use App\Models\UserProductModel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceCancelRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServiceController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function home(Request $request)
    {
        $this->seo()->setTitle(__('user.service.title'));

        $query = $request->input('query');
        
        $services = UserProductModel::where('user_id', Auth::id());

        if (!empty($query)){
            $services = $services->where('title', 'like', '%' . $query . '%');
        }

        $services = $services->orderByDesc('created_at')->paginate(config('app.page.size'));

        return view('user/service/home')
                ->with('query', $query)
                ->with('services', $services);
    }

    public function detail($id)
    {
        $this->seo()->setTitle(__('user.service.detail.title'));

        $service = UserProductModel::where(['user_id'=> Auth::id(), 'id' => $id])->first();

        return view('user/service/detail')
                ->with('service', $service);
    }

    public function cancel(ServiceCancelRequest $request)
    {
        $service_id = $request->service_id;
        $service = UserProductModel::where('id', $service_id)->first();
        $message = $request->subject . "<br />" . $request->message;

        $exist = TicketModel::where(['user_id' => Auth::id(), 'title' => $service->title . " - Hizmet İptal İsteği"])->first();

        if ($exist) {
            return redirect(route('user.service.detail', $service_id))->withErrors(['updated' => 'Daha önce iptal talebinde bulundunuz.']);
        }
        else {

            $ticket = TicketModel::create([
                'user_id' => Auth::id(),
                'status_id' => 1,
                'department_id' => 2,
                'service_id' => $service_id,
                'priority_id' => 3,
                'type_id' => 3,
                'title' => $service->title . " - Hizmet İptal İsteği",
                'message' => $service->id . " numaralı hizmetin iptal edilmesini istiyorum<br />----------------------<br />" . $message,
                'ip' => \Request::ip()
            ]);

            if (config("app.pushbullet")){
                \PushBullet::device(config('app.pushbullet.device'))->note('İptal Talebi: ' . Auth::user()->firstname . " " . Auth::user()->lastname , $request->subject);
            }

            return redirect(route('user.service.detail', $service_id))->withErrors(['updated' => 'İptal istediğiniz teknik birimimize iletildi. Destek taleplerim altından takip edebilirsiniz.']);
        }

    }

    
}
