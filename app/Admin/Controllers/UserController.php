<?php

namespace App\Admin\Controllers;

use App\Models\UserModel;
use App\Models\UserProductModel;
use App\Models\UserNoteModel;
use App\Models\UserSocialModel;
use App\Models\BillingModel;
use App\Models\CountryModel;
use App\Models\ZoneModel;
use App\Models\TaxOfficeModel;
use App\Models\TicketModel;
use App\Models\TicketMessageModel;
use App\Models\PartnershipModel;
use App\Models\UserActivityModel;
use App\Models\UserMailActivityModel;

use App\Http\Controllers\Controller;
use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Layout\Row;
use Ekipisi\Admin\Layout\Column;
use Ekipisi\Admin\Layout\Content;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Sichikawa\LaravelSendgridDriver\SendGrid;
use Carbon\Carbon;
use Newsletter;

class UserController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('Müşteriler');
            $content->description("Liste");
            $content->breadcrumb(
                ['text' => 'Müşteriler']
            );
            $content->body($this->grid());
        });
    }

    public function detail($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            Admin::script($this->script());

            session(['user_id' => $id]);

            $user = UserModel::where('id', $id)->first();
            $social = UserSocialModel::where('user_id', $id)->first();
            $products = UserProductModel::where('user_id', $id)->orderByDesc('created_at')->get();
            $tickets = TicketModel::where('user_id', $id)->orderByDesc('created_at')->paginate(config('admin.page.size'));
            $billings = BillingModel::where('user_id', $id)->orderByDesc('created_at')->get();
            $notes = UserNoteModel::where('user_id', $id)->orderByDesc('created_at')->get();
            $partnerships = PartnershipModel::where('user_id', $id)->orderByDesc('created_at')->get();
            $login_activities = UserActivityModel::where('user_id', $id)->orderByDesc('created_at')->get();
            $mail_activities = UserMailActivityModel::where('user_id', $id)->orderByDesc('created_at')->get();

            $content->header('Müşteriler');
            $content->description('Görüntüle');
            $content->breadcrumb(
                ['text' => 'Müşteriler', 'url' => admin_url('users')],
                ['text' => 'Müşteri Detayı']
            );
            $content->row(function (Row $row) use ($user, $social, $products, $notes, $tickets, $billings, $partnerships, $login_activities, $mail_activities) {
                $row->column(12, function (Column $column) use ($user, $social, $products, $notes, $tickets, $billings, $partnerships, $login_activities, $mail_activities) {
                    $column->append(
                        view('admin.user.detail')
                            ->with('user', $user)
                            ->with('social', $social)
                            ->with('tickets', $tickets)
                            ->with('billings', $billings)
                            ->with('products', $products)
                            ->with('notes', $notes)
                            ->with('partnerships', $partnerships)
                            ->with('login_activities', $login_activities)
                            ->with('mail_activities', $mail_activities)
                    );
                });
            });
        });
    }

    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('Müşteriler');
            $content->description('Düzenle');
            $content->breadcrumb(
                ['text' => 'Müşteriler', 'url' => admin_url('users')],
                ['text' => 'Müşteri Düzenle']
            );
            $content->body($this->form($id)->edit($id));
        });
    }

    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header('Müşteriler');
            $content->description('Ekle');
            $content->breadcrumb(
                ['text' => 'Müşteriler', 'url' => admin_url('users')],
                ['text' => 'Müşteri Ekle']
            );
            $content->body($this->form());
        });
    }

    protected function grid()
    {
        return Admin::grid(UserModel::class, function (Grid $grid) {
            
            $grid->id('ID')->sortable();
            
            $states = [
                'on' => ['value' => 1, 'text' => 'Aktif', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => 'Pasif', 'color' => 'danger'],
            ];
            $grid->status('Durum')->switch($states);

            $grid->verified('Onay')->status();

            $grid->services("Hizmetler")->display(function(){
                return "<center><span class=\"label label-success\">" . count($this->services) . "</span></center>";
            });
            
            $grid->tickets("Destek")->display(function(){
                return "<center><span class=\"label label-success\">" . count($this->tickets) . "</span></center>";
            });

            $grid->notes("Notlar")->display(function(){
                return "<center><span class=\"label label-info\">" . count($this->notes) . "</span></center>";
            });

            $grid->firstname('Ad Soyad')->display(function(){
                return $this->firstname . " " . $this->lastname;
            });

            $grid->email('E-posta');

            $grid->mobile('Cep Telefonu');

            $grid->updated_at('Son Giriş')->display(function() {
                return Carbon::parse($this->updated_at)->diffForHumans();
            });
            $grid->created_at('Kayıt Tarihi')->display(function() {
                return Carbon::parse($this->created_at)->format("d M Y, H:i");
            });
            $grid->model()->orderBy('created_at', 'desc');

            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });

            $grid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->prepend('<a href="' . admin_url('users/' . $actions->row->id . '/detail') . '" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>&nbsp;');
            });

            $grid->filter(function (Grid\Filter $filter) {
                
                $filter->disableIdFilter();

                $filter->like('firstname', 'Ad');
                $filter->like('lastname', 'Soyad');
                $filter->like('email', 'E-Posta');
                $filter->like('mobile', 'Cep Telefonu');

                $filter->equal('status', 'Durum')->radio([
                    ''   => 'Tümü',
                    0    => 'Pasif',
                    1    => 'Aktif',
                ]);

                $filter->equal('verified', 'Onay')->radio([
                    ''   => 'Tümü',
                    0    => 'Onaylanmamış',
                    1    => 'Onaylanmış',
                ]);

            });


            // $grid->disableCreateButton();
            $grid->disableRowSelector();
            $grid->disableExport();
            $grid->paginate(config('admin.page.size'));

        });
    }

    protected function form($id = null)
    {
        return Admin::form(UserModel::class, function (Form $form) use ($id) {

            $activation_token = \Helpers::RandomToken(60, false);

            if (session()->has('password') && $id == null) {
                // session('password')
            } else {
                session(['password' => \Helpers::RandomPassword(8)]);
            }

            $states = [
                'on' => ['value' => 1, 'text' => 'Aktif', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => 'Pasif', 'color' => 'danger'],
            ];

            $form->text('firstname', 'Ad')->placeholder('Müşteri Adını Girin')->rules('required')->setWidth(3);
            $form->text('lastname', 'Soyad')->placeholder('Müşteri Soyadını Girin')->rules('required')->setWidth(3);
            $form->email('email', 'E-posta')->rules('required')->setWidth(5);

            if ($id) {
                //$form->password('password', 'Şifre')->setWidth(3);
            } else {
                $form->password('password', 'Şifre')->value(session('password'))->help('Parola: ' . session('password'))->rules('required')->setWidth(3);
            }

            $form->divider();
            
            $form->select('country_id', 'Ülke')->options(function ($country_id) {
                $country = CountryModel::find($country_id);
                if ($country) {
                    return [$country->id => $country->name];
                }
            })->ajax(admin_url('api/country'))
              ->load('city_id', admin_url('api/zone'))
              ->setWidth(3);

            $form->select('city_id', 'Şehir')->options(function ($city_id) {
                $zone = ZoneModel::find($city_id);
                if ($zone) {
                    return [$zone->id => $zone->name];
                }
            })->ajax(admin_url('api/zone/list'))->setWidth(3);

            $form->text('state', 'İlçe')->setWidth(3);

            $form->text('address', 'Adres')->setWidth(8);

            $form->text('phone', 'Sabit Telefon')->setWidth(3);
            $form->text('mobile', 'Cep Telefonu')->setWidth(3);
            $form->divider();

            $company_types = [
                '1' => 'Kurumsal', 
                '2' => 'Bireysel'
            ];

            $form->select('company_type', 'Kullanıcı Tipi')->options($company_types)->setWidth(3);

            $form->text('company_name', 'Firma Adı')->setWidth(6);
            $form->text('identity_no', 'T.C. Kimlik Numarası')->setWidth(3);
            
            $form->text('tax_office', 'Vergi Dairesi')->setWidth(3);
            $form->text('tax_no', 'Vergi Numarası')->setWidth(3);
            $form->text('invoice_address', 'Fatura Adresi')->setWidth(8);

            $form->switch('status', 'Durum')->states($states);
            $form->switch('verified', 'Onay')->states($states);

            $form->divider();
            
            $form->summernote('message', 'Mail Mesaj');

            $form->hidden('activation_token')->value($activation_token);
            $form->hidden('id');
            $form->hidden('created_at');
            $form->hidden('updated_at');

            $form->disableReset();

            $form->saving(function (Form $form) {
                if ($form->password && $form->model()->password != $form->password) {
                    $form->password = bcrypt($form->password);
                }
            });

            $form->saved(function (Form $form) use ($id) {
                if (!$id) {

                    $user_id = $form->model()->id;

                    $user = UserModel::where('id', $user_id)->first();

                    $name = $user->firstname . " " . $user->lastname;
                    $email = $user->email;
                    $activation_token = $user->activation_token;

                    $data = array(
                        'name' => $name,
                        'user_id' => $user_id,
                        'code' => $activation_token,
                        'password' => session('password'),
                        'email' => $email,
                        'activity_id' => 0,
                        'extra_message' => $form->message
                    );

                    $activity = UserMailActivityModel::create([
                        'user_id' => $user_id,
                        'title' => 'Hesap Onayı',
                        'message' => view('mail/admin/user/register', $data),
                        'read' => 0
                    ]);

                    $data['activity_id'] = $activity->id;

                    Newsletter::subscribeOrUpdate($email, ['firstName' => $user->firstname, 'lastName' => $user->lastname]);

                    \Mail::send('mail/admin/user/register', $data, function ($message) use ($email, $name, $user_id, $activity) {
                        $message
                            ->to($email, $name)
                            ->from(config('support.mail'), config('app.name'))
                            ->replyTo(config('support.reply'), config('app.name'))
                            ->subject('Hesap Onayı')
                            ->embedData([
                                'categories' => ['ekipisi_register'],
                                'custom_args' => [
                                    'user_id' => strval($user_id),
                                    'name' => strval($name),
                                    'email' => strval($email),
                                    'activity_id' => strval($activity->id)
                                ]
                            ], 'sendgrid/x-smtpapi');
                    });

                }
            });

        });
    }

    protected function script()
    {
        return <<<EOT

        $(document).on("pjax:complete", function() {
            tabFunction();
        });
        
        $(document).on("pjax:success", function(){
            tabFunction();
        });

        function tabFunction() {
            var url = document.location.toString();

            if (url.match('#')) {
                $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
                window.scrollTo(0, 0);
            } 
        
            $('.nav-tabs a').on('shown.bs.tab', function (e) {
                window.location.hash = e.target.hash;
                window.scrollTo(0, 0);
            });
        }

        $('.customer-delete').unbind('click').click(function() {
            var id = $(this).data('id');
            swal({
                title: "Silmek istediğinize emin misiniz?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Onayla",
                closeOnConfirm: false,
                cancelButtonText: "İptal"
              },
              function(){
                window.location = "/admin/users/" + id + "/delete";
            });
        });
EOT;
    }

    public function addnote(Request $request, $id){
        if (!empty($request->message)) {
            UserNoteModel::create([
                'user_id' => $id,
                'priority' => $request->priority,
                'note' => $request->message,
                'end_at' => $request->end_at,
                'status' => 0
            ]);
        }
        return redirect(admin_url('users/' . $id . '/detail#notes'));
    }

    public function deletenote(Request $request, $id, $note_id){
        UserNoteModel::destroy($note_id);
        return redirect(admin_url('users/' . $id . '/detail#notes'));
    }

    public function updatenote(Request $request, $id, $note_id){
        UserNoteModel::find($note_id)->update(['status' => 1]);
        return redirect(admin_url('users/' . $id . '/detail#notes'));
    }

    public function deleteuser(Request $request, $id){

        UserNoteModel::where('user_id', $id)->delete();
        UserProductModel::where('user_id', $id)->delete();
        UserSocialModel::where('user_id', $id)->delete();
        UserActivityModel::where('user_id', $id)->delete();
        UserMailActivityModel::where('user_id', $id)->delete();
        BillingModel::where('user_id', $id)->delete();

        $tickets = TicketModel::where('user_id', $id)->get();

        foreach($tickets as $ticket) {
            TicketMessageModel::where('ticket_id', $ticket->id)->delete();
        }

        TicketModel::where('user_id', $id)->delete();
        UserModel::where('id', $id)->delete();

        Cache::flush();

        return redirect(admin_url('users'));
    }

}