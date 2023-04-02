<?php

namespace App\Admin\Controllers;

use App\Models\AnnounceModel;
use App\Models\UserProductModel;
use App\Models\UserModel;

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Ekipisi\Admin\Controllers\ModelForm;
use Carbon\Carbon;

class AnnounceController extends Controller
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

            $content->header('Duyurular');
            $content->description('Liste');
            $content->breadcrumb(['text' => 'Duyurular']);
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

            $content->header('Duyurular');
            $content->description('Düzenle');
            $content->breadcrumb(
                ['text' => 'Duyurular', 'url' => admin_url('announces')],
                ['text' => 'Duyuru Düzenle']
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

            $content->header('Duyurular');
            $content->description('Ekle');
            $content->breadcrumb(
                ['text' => 'Duyurular', 'url' => admin_url('announces')],
                ['text' => 'Duyuru Ekle']
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
        return Admin::grid(AnnounceModel::class, function (Grid $grid) {

            $domain_list = array();
            $services = UserProductModel::where('status', 1)->get();
            $domain_list['none'] = "Tüm Alan Adları İçin";
            foreach($services as $service){
                $domain_list[$service->domain] = $service->domain;
            }

            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $grid->id('ID')->sortable();
            $grid->status('Durum')->switch($states);

            $grid->domain('Alan Adı')->editable('select', $domain_list)->sortable();
            $grid->user("Müşteri")->display(function() {
                if ($this->user_id ==0) {
                    return "<center>-</center>";
                } else {
                    return $this->user['firstname'] . " " . $this->user['lastname'];
                }
            })->sortable();

            $grid->title('Başlık')->limit('50');

            $grid->date_start('Başlangıç Tarihi')->display(function() {
                return Carbon::parse($this->date_start)->format("d M Y");
            })->sortable();

            $grid->date_end('Bitiş Tarihi')->display(function() {
                return Carbon::parse($this->date_end)->format("d M Y");
            })->sortable();

            $grid->created_at('Eklenme Tarihi')->display(function() {
                return Carbon::parse($this->created_at)->format("d M Y, H:i");
            })->sortable();

            $grid->disableExport();
            $grid->paginate(config('admin.page.size'));


            $grid->filter(function (Grid\Filter $filter) use($domain_list) {
                
                $customer_list = array();
                $users = UserModel::where('status', 1)->get();
                foreach($users as $user){
                    $customer_list[$user->id] = $user->firstname . " " . $user->lastname;
                }

                $filter->disableIdFilter();
                $filter->like('title', 'Başlık');
                
                $filter->where(function ($query) {
                    $query->where('domain', "{$this->input}");
                }, 'Alan Adı')->select($domain_list);

                $filter->where(function ($query) {
                    $query->where('user_id', "{$this->input}");
                }, 'Müşteri')->select($customer_list);

                $filter->equal('status', 'Durum')->radio([
                    ''   => 'Tümü',
                    0    => 'Pasif',
                    1    => 'Aktif',
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
        return Admin::form(AnnounceModel::class, function (Form $form) {

            Admin::script($this->script());

            $domain_list = array();
            $services = UserProductModel::where('status', 1)->get();
            $domain_list['none'] = "Tüm Alan Adları İçin";
            foreach($services as $service){
                $domain_list[$service->domain] = $service->domain;
            }

            $user_list = array();
            $users = UserModel::where('status', 1)->get();
            $user_list[0] = "Tüm Müşteriler";
            foreach($users as $user){
                $user_list[$user->id] = $user->firstname . " " . $user->lastname;
            }

            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $form->select('domain', 'Alan Adı')->options($domain_list)->rules('required')->setWidth(3);
            $form->select('user_id', 'Müşteri')->options($user_list)->rules('required')->setWidth(3);

            $form->text('title', 'Başlık')->setWidth(8);
            $form->editor('content', 'Duyuru')->setWidth(10);
            $form->url('url', 'Bağlantı')->setWidth(8);
            $form->text('icon', 'Ikon')->setWidth(4);
            $form->dateRange('date_start', 'date_end', 'Zaman Aralığı');

            $form->switch('status', 'Durum')->states($states);

            $form->hidden('id');
            $form->hidden('created_at');
            $form->hidden('updated_at');
        });
    }

    protected function script()
    {
        $domain_user_api = admin_url('api/domain_user');

        return <<<EOT

        $(".domain").change(function () {
            var domain = $(this).val();
            if (domain=="none") {
                $(".user_id").val(0).trigger('change');
            } else {

                $.get('$domain_user_api?q=' + domain, function (data) {
                    $(".user_id").val(data.user_id).trigger('change');
                });

            }
        });
EOT;
    }

}
