<?php

namespace App\Http\Controllers\User;

use App\Models\UserModel;
use App\Models\ZoneModel;
use App\Models\CountryModel;
use App\Models\TicketModel;
use App\Models\ProductModel;
use App\Models\UserProductModel;
use App\Models\UserSocialModel;
use App\Models\SolutionCategoryModel;
use App\Models\SolutionModel;
use App\Models\AnnounceModel;
use App\Models\MessageModel;
use App\Models\BillingModel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;

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
use Socialite;

class HomeController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index()
    {
        $this->seo()->setTitle(__('user.title'));

        $tickets = TicketModel::where('user_id', Auth::id())->orderByDesc('created_at')->take(5)->get();

        $announces = Cache::remember('announces', 1200, function () {
            $today = date('Y-m-d');
            return AnnounceModel::where(['status'=> 1])->where('date_start', '<=', $today)->where('date_end', '>=', $today)->orderByDesc('created_at')->get();
        });

        $services = [];
        // $temp_services = UserProductModel::where('user_id', Auth::id())->orderByDesc('created_at')->get();

        // foreach($temp_services as $service) {
        //     if (Carbon::parse($service->payment_date)->addDays($service->period['total_day'])->diffInDays() <=7) {
        //         array_push($services, $service);
        //     }
        // }

        $billings = [];
        $temp_billings = BillingModel::where('user_id', Auth::id())->orderByDesc('payment_date')->get();
        $total = 0;


        foreach($temp_billings as $billing) {
            if (!$billing->status) {

                if ($billing->currency['code'] == "TRY") {
                    
                    $total += $billing->price;

                } else {

                    $curr = 1 / $billing->currency['value'];

                    $total += $billing->price * $curr;

                }

                array_push($billings, [
                    'id'            => $billing->id,
                    'invoice_no'    => $billing->invoice_no,
                    'title'         => $billing->service['title'],
                    'description'   => $billing->description,
                    'currency'      => $billing->currency['symbol_left'] ? $billing->currency['symbol_left'] : $billing->currency['symbol_right'],
                    'price'         => $billing->price,
                    'payment_date'  => Carbon::parse($billing->payment_date)->format("d.m.Y"),
                    'status'        => $billing->status
                ]);
            }
        }

        $order_message = MessageModel::where(['user_id' => Auth::id(), 'type' => 4, 'read' => 0])->first();
        if ($order_message)
        {
            $has_order = 1;
        } else {
            $has_order = 0;
        }

        return view('user/home')
                ->with('tickets', $tickets)
                ->with('services', $services)
                ->with('billings', $billings)
                ->with('total', round($total, 0, PHP_ROUND_HALF_UP))
                ->with('announces', $announces)
                ->with('has_order', $has_order);
    }

    public function solutions() {
        $this->seo()->setTitle(__('user.solution.title'));

        $solutions_categories = Cache::remember('solutions_categories', 1200, function () {
            return SolutionCategoryModel::where('status', 1)->get();
        });

        return view('user/solutions')
                ->with('categories', $solutions_categories);
    }

    public function profile() {
        $this->seo()->setTitle(__('user.profile.title'));

        $user = UserModel::where('id', Auth::id())->first();

        $country = Cache::remember('country', 1200, function () {
            return CountryModel::where('status', 1)->get();
        });

        $social = UserSocialModel::where('user_id', Auth::id())->first();

        return view('user/profile')
            ->with('email', $user->email)
            ->with('firstname', $user->firstname)
            ->with('lastname', $user->lastname)
            ->with('address', $user->address)
            ->with('country_id', $user->country_id)
            ->with('city_id', $user->city_id)
            ->with('state', $user->state)
            ->with('phone', $user->phone)
            ->with('mobile', $user->mobile)
            ->with('company_type', $user->company_type)
            ->with('identity_no', $user->identity_no)
            ->with('birthday', $user->birthday)
            ->with('company_name', $user->company_name)
            ->with('tax_office', $user->tax_office)
            ->with('tax_no', $user->tax_no)
            ->with('invoice_address', $user->invoice_address)
            ->with('countries', $country)
            ->with('social', $social);
    }

    public function profile_update(ProfileRequest $request) {
        UserModel::find(Auth::id())->update([
            'address' => $request->input('address'),
            'country_id' => $request->input('country'),
            'city_id' => $request->input('city'),
            'state' => $request->input('state'),
            'phone' => $request->input('phone'),
            'mobile' => $request->input('mobile'),
            'identity_no' => $request->input('identity_no'),
            'birthday' => $request->input('birthday'),
            'company_name' => $request->input('company_name'),
            'tax_office' => $request->input('tax_office'),
            'tax_no' => $request->input('tax_no'),
            'invoice_address' => $request->input('invoice_address')
        ]);

        return redirect(route('user.profile'))->withErrors(['updated' => 'Bilgileriniz güncellendi.']);
    }

    public function password() {
        $this->seo()->setTitle(__('user.password.title'));
        
        return view('user/password');
    }

    public function password_update(PasswordRequest $request) {
        $current = $request->input('current');
        $user = UserModel::where('id', Auth::id())->first();

        if (Hash::check($request->input('current'), $user->password)) {

            UserModel::find(Auth::id())->update([
                'password' => bcrypt($request->input('password'))
            ]);

            return redirect(route('user.password'))->withErrors(['updated' => 'Şifreniz güncellendi.']);
        } else {
            return redirect(route('user.password'))->withErrors(['error' => 'Güncel şifrenizi hatalı girdiniz.']);
        }
    }
    
    public function social_cancel($provider) {
        UserSocialModel::where('user_id', Auth::id())->update([
            $provider . '_id' => ""
        ]);
        return redirect(route('user.profile'))->withErrors(['updated' => 'Bilgileriniz güncellendi.']);
    } 

}
