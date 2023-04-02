<?php

namespace App\Http\Controllers\Auth;

use App\Models\UserModel;
use App\Models\CountryModel;
use App\Models\UserMailActivityModel;
use App\Models\MessageModel;
use App\Models\ZoneModel;

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
use Newsletter;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/user';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        $this->seo()->setTitle(__('user.register.title'));
        $this->seoMeta()->setUrl(url('register'));

       $country = Cache::remember('country', 1200, function () {
           return CountryModel::where('status', 1)->get();
        });

        return view('auth.register')->with('countries', $country);
    }

    protected function validator(array $data)
    {
        $message = array(
            'firstname.required' => 'Lütfen adınızı girin.',
            'lastname.required' => 'Lütfen soyadınızı girin.',
            'email.required' => 'Lütfen e-posta adresinizi girin.',
            'email.unique' => 'Girmiş olduğunuz e-posta adresi sistemimizde kayıtlı.',
            'mobile.required' => 'Lütfen cep telefonunuzu girin.',
            'mobile.unique' => 'Girmiş olduğunu cep telefonu sistemimizde kayıtlı.',
            'password.required' => 'Lütfen parolanızı girin.'
        );
        $result = Validator::make($data, [
            'firstname' => 'required|string|min:3|max:255',
            'lastname' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|min:10|max:255|unique:users',
            'mobile' => 'required|string|min:9|max:20|unique:users',
            'password' => 'required|string|min:4|confirmed',
            'identity_no' => [
                function($attribute, $value, $fail) use($data) {
                    $user_type = (int)$data['user_type'];
        
                    if ($user_type==2) {
                        
                        $bilgiler = array(
                            "ad"            => $data['firstname'],
                            "soyad"         => $data['lastname'],
                            "dogumyili"     => $data['birthday'],
                            "tckimlikno"    => $data['identity_no']
                        );
            
                        if (!\Helpers::TcDogrula($bilgiler)) {
                            return $fail('TC Kimlik numarası hatalı.');
                        }
                    }
                },
            ],
        ], $message);

        return $result;
    }

    protected function create(array $data)
    {
        $city = ZoneModel::where('id', $data['city'])->first();
        return UserModel::create([
            'activation_token' => $data['_token'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'address' => $data['address'],
            'state' => $data['state'],
            'city_id' => $data['city'],
            'country_id' => $data['country'],
            'phone' => $data['phone'],
            'mobile' => $data['mobile'],
            'company_type'=>$data['user_type'],
            'company_name' => (isset($data['company_name']) ? $data['company_name'] : ""),
            'identity_no' => (isset($data['identity_no']) ? $data['identity_no'] : ""),
            'birthday' => (isset($data['birthday']) ? $data['birthday'] : ""),
            'tax_office' => (isset($data['tax_office']) ? $data['tax_office'] : ""),
            'tax_no' => (isset($data['tax_no']) ? $data['tax_no'] : ""),
            'invoice_address' => $data['address'] . " " . $data['state'] . " / " . $city->name,
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        if ($this->validator($request->all())->fails()) {
            return redirect('register')
                ->withErrors($this->validator)
                ->withInput();
        }
        
        event(new Registered($user = $this->create($request->all())));

        $name = $request->input('firstname') . " " . $request->input('lastname');
        $email = $request->input('email');
        $password = $request->input('password');
        $user = UserModel::where('email', $email)->first();

        Newsletter::subscribeOrUpdate($request->input('email'), ['firstName' => $request->input('firstname'), 'lastName' => $request->input('lastname')]);

        $data = array(
            'name' => $name,
            'code' => $user->activation_token,
            'user_id' => $user->id,
            'password' => $password,
            'activity_id' => 0
        );

        $activity = UserMailActivityModel::create([
            'user_id' => $user->id,
            'title' => 'Hesap Onayı',
            'message' => view('mail/user/register', $data),
            'read' => 0
        ]);

        $data['activity_id'] = $activity->id;

        \Mail::send('mail/user/register', $data, function ($message) use ($email, $name, $user, $activity) {
            $message
                ->to($email, $name)
                ->from(config('support.mail'), config('app.name'))
                ->replyTo(config('support.reply'), config('app.name'))
                ->subject('Hesap Onayı')
                ->embedData([
                    'categories' => ['ekipisi_register'],
                    'custom_args' => [
                        'user_id' => strval($user->id),
                        'name' => strval($name),
                        'email' => strval($email),
                        'activity_id' => strval($activity->id)
                    ]
                ], 'sendgrid/x-smtpapi');
        });

        if (session()->has('domain')) {

            $message  = "<p>Alan Adı : " . session('domain') . "</p>";
            $message .= "<p>Paket : " . session('pack') . "</p>";
            $message .= "<p>Mesaj : " . session('message') . "</p>";


            MessageModel::create([
                'user_id' => $user->id,
                'type' => 4,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'subject' => "E-Ticaret Paket Siparişi",
                'email' => $user->email,
                'phone' => $user->mobile,
                'message' => $message,
                'newsletter' => 0,
                'read' => 0
            ]);

            if (config("app.pushbullet")){
                \PushBullet::device(config('app.pushbullet.device'))->note('E-Ticaret Paket Siparişi: ' . $user->firstname . " " . $user->lastname , $message);
            }

            session()->forget('domain');
            session()->forget('pack');
            session()->forget('message');
        }

        return redirect(route('login'))->withErrors(['warning_register' => 'Hesabınızı etkinleştirmek için lütfen e-posta adresinize gönderdiğimiz etkinleştirme bağlantısına tıklayın.'])->withInput();
    }

    public function confirm(Request $request)
    {
        $code = $request->get('code');
        $user = UserModel::where(['status' => 0, 'activation_token' => $code])->first();

        if ($user) {
            UserModel::find($user->id)->update([
                'status' => 1,
                'activation_token' => ""
            ]);
            return redirect(route('login'))->withErrors(['success_activation' => 'Hesabınız etkinleştirildi. Giriş yapabilirsiniz.'])->withInput()->with('email', $user->email);
        }
        return redirect(route('login'))->withErrors(['danger_activation' => 'Hesabınız daha önce etkinleştirildi.'])->withInput();
    }


}
