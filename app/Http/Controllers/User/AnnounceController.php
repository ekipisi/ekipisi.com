<?php

namespace App\Http\Controllers\User;

use App\Models\AnnounceModel;

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

class AnnounceController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function home() {

        $this->seo()->setTitle(__('user.announce.title'));

        $today = date('Y-m-d');
            $announces = AnnounceModel::where(['status'=> 1])
                        ->where('date_start', '<=', $today)
                        ->where('date_end', '>=', $today)
                        ->orderByDesc('created_at');
            $announces = $announces->where('user_id', 0)->orWhere('user_id', Auth::id())->paginate(config('app.page.size'));

        return view('user/announce/home')
                ->with('announces', $announces);
    }

    public function detail($id, $domain)
    {
        $this->seo()->setTitle(__('user.announce.detail.title'));

        $announce = Cache::remember('announce-' . $id . '-' . $domain, 1200, function () use($id, $domain) {
            return AnnounceModel::where(['status' => 1, 'id' => $id, 'domain'=> $domain])->first();
        });

        if (!$announce)
           return abort(404);

        $title = $announce->title;
        $description = str_replace('%%url%%',$announce->url ,$announce->content);
        $description = str_replace('%%date_start%%', Carbon::parse($announce->date_start)->format("d.M.Y") ,$description);
        $description = str_replace('%%date_end%%',Carbon::parse($announce->date_end)->format("d.M.Y") ,$description);
        $description = str_replace('%%online_support%%', "javascript:OpenOnlineSupport();" ,$description);

        return view('user/announce/detail')
        ->with('title', $title)
        ->with('description', $description);
    }

    
}
