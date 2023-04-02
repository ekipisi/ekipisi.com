<?php

namespace App\Admin\Controllers;

use App\Models\PartnershipModel;
use App\Models\UserModel;

use App\Http\Controllers\Controller;
use App\Admin\Extensions\Exporter\Partnership;
use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Layout\Content;
use Ekipisi\Admin\Controllers\ModelForm;
use Carbon\Carbon;

class PartnershipController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Gelir Ortaklığı');
            $content->description('Liste');
            $content->breadcrumb(
                ['text' => 'Gelir Ortaklığı']
            );
            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Gelir Ortaklığı');
            $content->description('Düzenle');
            $content->breadcrumb(
                ['text' => 'Gelir Ortaklığı', 'url' => admin_url('partnerships')],
                ['text' => 'Referans Düzenle']
            );
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('Gelir Ortaklığı');
            $content->description('Ekle');
            $content->breadcrumb(
                ['text' => 'Gelir Ortaklığı', 'url' => admin_url('partnerships')],
                ['text' => 'Referans Ekle']
            );
            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(PartnershipModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->status('Durum')->status()->sortable();
            $grid->called('Arama')->status()->sortable();
            $grid->paid('Ödeme')->status()->sortable();

            $grid->user()->firstname('Müşteri')->display(function(){
                return "<a href='".admin_url('users/' . $this->user['id'] . '/detail')."'>" . $this->user['firstname'] . "</a>";
            })->sortable();

            // $grid->channel('Kanal')->display(function(){
            //     if ($this->channel=="form")
            //     return "Form";
            //     else 
            //     return "Link";
            // })->sortable();

            $grid->firstname('Ad Soyad')->display(function(){
                return $this->firstname . " " . $this->lastname;
            })->sortable();

            $grid->email('E-Posta')->sortable();
            $grid->phone('Telefon')->sortable();
            $grid->company('Firma')->sortable();

            $grid->price('Ücret')->display(function(){
                if ($this->price)
                    return $this->price;
                else
                    return "-";
            })->sortable();

            $grid->created_at('Eklenme')->display(function() {
                return "<span data-toggle=\"tooltip\" data-placement=\"bottom\" data-html=\"true\" title='" . Carbon::parse($this->created_at)->format("d M Y, H:i") . "'>" . Carbon::parse($this->created_at)->diffForHumans() . "</span>" ;
            });
            // $grid->updated_at('Güncellenme')->display(function() {
            //     return "<span data-toggle=\"tooltip\" data-placement=\"bottom\" data-html=\"true\" title='" . Carbon::parse($this->updated_at)->format("d M Y, H:i") . "'>" . Carbon::parse($this->updated_at)->diffForHumans() . "</span>" ;
            // });

            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });

            $grid->actions(function ($actions) {                
                $actions->disableDelete();
            });

            $grid->paginate(config('admin.page.size'));
            $grid->exporter(new Partnership());

            $grid->filter(function (Grid\Filter $filter) {
                
                $filter->disableIdFilter();

                $filter->where(function ($query) {
                    $query->where('user_id', "{$this->input}");
                }, 'Müşteri')->select(UserModel::all()->pluck('name', 'id'));

                $filter->like('firstname', 'Ad');
                $filter->like('lastname', 'Soyad');
                $filter->like('company', 'Firma');

                $filter->equal('status', 'Durum')->radio([
                    ''   => 'Tümü',
                    0    => 'İptal Edildi',
                    1    => 'Onaylandı',
                ]);

                $filter->equal('called', 'Arama')->radio([
                    ''   => 'Tümü',
                    0    => 'Aranmadı',
                    1    => 'Arandı',
                ]);

                $filter->equal('paid', 'Ödeme')->radio([
                    ''   => 'Tümü',
                    0    => 'Ödeme Yapılmadı',
                    1    => 'Ödeme Yapıldı',
                ]);

            });

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(PartnershipModel::class, function (Form $form) {

            $channels = [
                'form' => 'Gelir Ortaklığı Formu',
                'link' => 'Paylaşım Linki'
            ];

            $states = [
                'on' => ['value' => 1, 'text' => 'Aktif', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => 'Pasif', 'color' => 'danger'],
            ];
            
            $form->select('user_id', 'Müşteri')->options(function ($user_id) {
                $user = UserModel::find($user_id);
                if ($user) {
                    return [$user->id => $user->firstname . ' ' . $user->lastname];
                }
            })->ajax(admin_url('api/user'))->rules('required')->setWidth(2);

            $form->select('channel', 'Kanal')->options($channels)->rules('required')->setWidth(2);
            $form->text('firstname', 'Ad')->placeholder('Referans Adını Girin')->rules('required')->setWidth(3);
            $form->text('lastname', 'Soyad')->placeholder('Referans Soyadını Girin')->rules('required')->setWidth(3);
            $form->email('email', 'E-posta')->rules('required')->setWidth(5);
            $form->text('phone', 'Telefon Numarası')->setWidth(5);
            $form->text('company', 'Firma Adı')->setWidth(5);
            $form->textarea('message', 'Mesaj')->setWidth(8);

            $form->divider();

            $form->switch('status', 'Durum')->states($states);
            $form->switch('called', 'Arandı mı?')->states($states);
            $form->switch('paid', 'Ödendi mi?')->states($states);
            $form->currency('price', 'Ücret')->setWidth(3)->symbol('');
            $form->datetime('paid_at', 'Ödeme Tarihi'); //->value(Carbon::now()->format("Y-m-d h:i:s"))
            $form->summernote('note', 'Not')->setWidth(8);

            $form->hidden('id');
            $form->hidden('created_at');
            $form->hidden('updated_at');
        });
    }
}
