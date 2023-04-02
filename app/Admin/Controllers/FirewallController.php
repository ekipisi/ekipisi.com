<?php

namespace App\Admin\Controllers;

use App\Models\FirewallModel;

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Ekipisi\Admin\Controllers\ModelForm;
use Carbon\Carbon;

class FirewallController extends Controller
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

            $content->header('Güvenlik Duvarı');
            $content->description('Liste');
            $content->breadcrumb(['text' => 'Güvenlik Duvarı']);
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

            $content->header('Güvenlik Duvarı');
            $content->description('Düzenle');
            $content->breadcrumb(
                ['text' => 'Güvenlik Duvarı', 'url' => admin_url('firewall')],
                ['text' => 'Ip Düzenle']
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

            $content->header('Güvenlik Duvarı');
            $content->description('Ekle');
            $content->breadcrumb(
                ['text' => 'Güvenlik Duvarı', 'url' => admin_url('firewall')],
                ['text' => 'Ip Ekle']
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
        return Admin::grid(FirewallModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->whitelisted('Giriş Yapabilir')->status()->sortable();

            $grid->ip_address('Ip Adresi')->display(function($ip_address){
                return "<a href='https://geoiptool.com/en/?IP=" . $ip_address . "' target='_blank'>" . $ip_address . "</a>";
            })->sortable();

            $grid->created_at('Engellenme Tarihi')->display(function() {
                return Carbon::parse($this->created_at)->format("d M Y, H:i");
            })->sortable();

            $grid->updated_at('Güncellenme Tarihi')->display(function() {
                return Carbon::parse($this->updated_at)->format("d M Y, H:i");
            })->sortable();

            $grid->disableExport();
            $grid->paginate(config('admin.page.size'));

            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });

            $grid->filter(function (Grid\Filter $filter) {
                
                $filter->disableIdFilter();

                $filter->like('name', 'Ip Adresi');

                $filter->equal('whitelisted', 'Durum')->radio([
                    ''   => 'Tümü',
                    0    => 'Engellendi',
                    1    => 'Engellenmedi',
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
        return Admin::form(FirewallModel::class, function (Form $form) {

            $states = [
                'Girebilir' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Giremez' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $form->ip('ip_address', 'Ip Adresi')->placeholder('Ip Adresini Girin')->setWidth(5);
            $form->switch('whitelisted', 'Durum')->states($states);

            $form->hidden('id');
            $form->hidden('created_at');
            $form->hidden('updated_at');
        });
    }
}
