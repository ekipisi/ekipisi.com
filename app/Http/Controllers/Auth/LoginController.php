<?php

namespace App\Http\Controllers\Auth;

use App\Models\UserModel;
use App\Models\UserSocialModel;
use App\Models\UserMailActivityModel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Sichikawa\LaravelSendgridDriver\SendGrid;
use Newsletter;
use Socialite;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/user';

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $this->seo()->setTitle(__('user.login.title'));
        $this->seoMeta()->setUrl(url('login'));

        return view('auth.login');
    }

    public function login(\Illuminate\Http\Request $request)
    {
        $this->validateLogin($request);
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->guard()->validate($this->credentials($request))) {
            $user = $this->guard()->getLastAttempted();
            if ($user->status && $this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            } else {
                $this->incrementLoginAttempts($request);
                return redirect()
                    ->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors(['danger_activation' => 'Giriş yapabilmek için. E-posta adresinize gönderdiğimiz etkinleştirme bağlantısına tıklamalısınız.']);
            }
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);

        if ($authUser->status) {
            Auth::login($authUser, true);
            return redirect($this->redirectTo);
        } else {
            return redirect(route('login'))->withErrors(['warning_register' => 'Hesabınızı etkinleştirmek için lütfen e-posta adresinize gönderdiğimiz etkinleştirme bağlantısına tıklayın.'])->withInput();
        }
    }

    public function findOrCreateUser($user, $provider)
    {
        $firstname = "";
        $lastname = "";
        $avatar = "";
        $verified = 0;

        if ($provider == "facebook") {
            $userFirstLastName = $this->getFirstLastNames($user->getName());
            $firstname = $userFirstLastName['first_name'];
            $lastname = $userFirstLastName['last_name'];
            $avatar = $user->avatar_original;
            // $verified = $user->user['verified'];

        } else if ($provider == "google") {
            $firstname = $user->user['name']['givenName'];
            $lastname = $user->user['name']['familyName'];
            $avatar = $user->avatar_original;
            $verified = $user->user['verified'];
        } else {
            $firstname = $user->user['firstName'];
            $lastname = $user->user['lastName'];
            $avatar = $user->avatar_original;
        }

        if (Auth::check()) {
            $user_registered = UserModel::where('id', Auth::id())->first();
        } else {
            $user_registered = UserModel::where('email', $user->email)->first();
        }
        $user_social = UserSocialModel::where($provider . '_id', $user->id)->first();
        
        if ($user_registered && $user_social)
        {
            return $user_registered;
        } 
        else if ($user_registered && !$user_social)
        {
            $social_result = UserSocialModel::where('user_id', $user_registered->id)->update([$provider . '_id' => $user->id]);
            if ($social_result == 0) {
                UserSocialModel::create(['user_id' => $user_registered->id, $provider . '_id' => $user->id]);
            }
            return $user_registered;
        }
        else
        {
            $user_detail = UserSocialModel::where($provider . '_id', $user->id)->first();

            if ($user_detail) {

                return UserModel::where('id', $user_detail->user_id)->first();

            } else {

                $password = \Helpers::RandomPassword(8);
                $activation_token = \Helpers::RandomToken(60, false);
                $name = $firstname . " " .$lastname;

                $created_user = UserModel::create([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $user->email,
                    'avatar' => $avatar,
                    'password' => bcrypt($password),
                    'verified' => $verified,
                    'activation_token' => $activation_token
                ]);
                
                UserSocialModel::create(['user_id' => $created_user->id, $provider . '_id' => $user->id]);
    
                $email = $user->email;
                $user_id = $created_user->id;

                $data = array(
                    'name' => $name,
                    'code' => $activation_token,
                    'user_id' => $user_id,
                    'password' => $password,
                    'activity_id' => 0
                );

                $activity = UserMailActivityModel::create([
                    'user_id' => $user_id,
                    'title' => 'Hesap Onayı',
                    'message' => view('mail/user/social', $data),
                    'read' => 0
                ]);

                $data['activity_id'] = $activity->id;

                Newsletter::subscribeOrUpdate($email, ['firstName' => $firstname, 'lastName' => $lastname]);

                \Mail::send('mail/user/social', $data, function ($message) use ($email, $name, $user_id, $activity) {
                    $message
                        ->to($email, $name)
                        ->from(config('support.mail'), config('app.name'))
                        ->replyTo(config('support.reply'), config('app.name'))
                        ->subject('Hesap Onayı')
                        ->embedData([
                            'categories' => ['ekipisi_social_register'],
                            'custom_args' => [
                                'user_id' => strval($user_id),
                                'name' => strval($name),
                                'email' => strval($email),
                                'activity_id' => strval($activity->id)
                            ]
                        ], 'sendgrid/x-smtpapi');
                });

                return $created_user;
            }
        }
    }

    protected function getFirstLastNames($fullName)
    {
        $parts = array_values(array_filter(explode(" ", $fullName)));

        $size = count($parts);

        if (empty($parts)) {
            $result['first_name'] = NULL;
            $result['last_name'] = NULL;
        }

        if (!empty($parts) && $size == 1) {
            $result['first_name'] = $parts[0];
            $result['last_name'] = NULL;
        }

        if (!empty($parts) && $size >= 2) {
            $result['first_name'] = $parts[0];
            $result['last_name'] = $parts[1];
        }

        return $result;
    }

}
