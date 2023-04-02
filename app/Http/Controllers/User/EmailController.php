<?php

namespace App\Http\Controllers\User;

use App\Models\UserMailActivityModel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;
use Sichikawa\LaravelSendgridDriver\SendGrid;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class EmailController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function home(Request $request)
    {
        $this->seo()->setTitle(__('user.email.title'));

        $emails = UserMailActivityModel::where('user_id', Auth::id())->orderByDesc('created_at')->paginate(config('app.page.size'));

        return view('user/email/home')->with('emails', $emails);
    }

    public function detail($id)
    {
        $email = Cache::remember('mail-activity-' . $id, 1200, function () use($id) {
            return UserMailActivityModel::where(['user_id' => Auth::id(), 'id' => $id])->first();
        });

        if (!$email)
           return abort(404);

        $this->seo()->setTitle($email->title);

        return view('user/email/detail')
            ->with('content', $email->message);
    }

    
}
