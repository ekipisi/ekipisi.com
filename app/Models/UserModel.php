<?php
namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Sichikawa\LaravelSendgridDriver\SendGrid;

class UserModel extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = "users";

    protected $fillable = [
        'status', 
        'verified', 
        'firstname', 
        'lastname', 
        'email', 
        'password', 
        'avatar', 
        'address', 
        'state', 
        'city_id', 
        'country_id', 
        'phone', 
        'mobile', 
        'company_type', 
        'company_name', 
        'identity_no', 
        'tax_office', 
        'tax_no', 
        'invoice_address', 
        'message',
        'activation_token'
    ];

    protected $hidden = ['password', 'remember_token'];


    public function getNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function services()
    {
        return $this->hasMany(UserProductModel::class, 'user_id');
    }

    public function tickets()
    {
        return $this->hasMany(TicketModel::class, 'user_id');
    }

    public function notes()
    {
        return $this->hasMany(UserNoteModel::class, 'user_id');
    }

    public function zone()
    {
        return $this->hasOne(ZoneModel::class, 'id', 'city_id');
    }

    public function country()
    {
        return $this->hasOne(CountryModel::class, 'id', 'country_id');
    }

    public function activities()
    {
        return $this->hasMany(UserActivityModel::class, 'user_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function sendPasswordResetNotification($token)
    {
        $email = $this->email;
        $name = $this->firstname . " " . $this->lastname;
        $user_id = $this->id;

        $data = array(
            'name' => $name,
            'token' => $token,
            'activity_id' => 0
        );

        $activity = UserMailActivityModel::create([
            'user_id' => $user_id,
            'title' => 'Parola Sıfırlama',
            'message' => view('mail/user/password', $data),
            'read' => 0
        ]);

        $data['activity_id'] = $activity->id;

        \Mail::send('mail/user/password', $data, function ($message) use ($email, $name, $user_id, $token, $activity) {
            $message
                ->to($email, $name)
                ->from(config('support.mail'), config('app.name'))
                ->replyTo(config('support.reply'), config('app.name'))
                ->subject('Parola Sıfırlama')
                ->embedData([
                    'categories' => ['ekipisi_password_reset'],
                    'custom_args' => [
                        'user_id' => strval($user_id),
                        'name' => strval($name),
                        'email' => strval($email),
                        'token' => strval($token),
                        'activity_id' => strval($activity->id)
                    ]
                ], 'sendgrid/x-smtpapi');
        });

    }
}
