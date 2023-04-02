<?php

namespace App\Http\Controllers\User;

use App\Models\PartnershipModel;
use App\Http\Requests\PartnershipRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PartnershipController extends BaseController
{

    public function home(Request $request)
    {
        $this->seo()->setTitle(__('user.partnership.title'));

        $partnerships = PartnershipModel::where('user_id', Auth::id())->orderByDesc('created_at')->paginate(config('app.page.size'));

        return view('user/partnership/home')
                    ->with('partnerships', $partnerships);
    }

    public function add()
    {
        $this->seo()->setTitle(__('user.partnership.add.title'));

        return view('user/partnership/add');
    }

    public function store(PartnershipRequest $request) {

        $result = PartnershipModel::create([
            'user_id' => Auth::id(),
            'channel' => 'form',
            'status' => 0,
            'called' => 0,
            'paid' => 0,
            'note' => '',
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'message' => $request->message
        ]);

        if (config("app.pushbullet")){
            \PushBullet::device(config('app.pushbullet.device'))->note('Referans Eklendi: ' . $request->firstname . " " . $request->lastname , $request->phone);
        }
        return redirect(route('user.partnership.home'))->withErrors(['updated' => 'Referansınız kaydedilmiştir. En kısa sürede kendisiyle iletişime geçilecek. Durumunu panelden takip edebilirsiniz.']);
    }



}
