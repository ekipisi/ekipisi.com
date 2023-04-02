<?php

namespace App\Admin\Controllers;

use App\Models\CurrencyModel;
use App\Http\Controllers\Controller;

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Layout\Content;
use Ekipisi\Admin\Controllers\ModelForm;
use Carbon\Carbon;

class CurrencyController extends Controller
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

            $content->header('Döviz Kurları');
            $content->description('Liste');
            $content->breadcrumb(
                ['text' => 'Genel Ayarlar'],
                ['text' => 'Döviz Kurları']
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

            $content->header('Döviz Kurları');
            $content->description('Düzenle');
            $content->breadcrumb(
                ['text' => 'Genel Ayarlar'],
                ['text' => 'Döviz Kurları', 'url' => admin_url('currency')],
                ['text' => 'Döviz Kuru Düzenle']
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

            $content->header('Döviz Kurları');
            $content->description('Ekle');
            $content->breadcrumb(
                ['text' => 'Genel Ayarlar'],
                ['text' => 'Döviz Kurları', 'url' => admin_url('currency')],
                ['text' => 'Döviz Kuru Ekle']
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
        return Admin::grid(CurrencyModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $states = [
                'on' => ['value' => 1, 'text' => 'Aktif', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => 'Pasif', 'color' => 'danger'],
            ];
            $grid->status('Durum')->switch($states);
            $grid->title('Para Birimi')->editable()->sortable();
            $grid->code('Kodu')->editable()->sortable();
            $grid->value('Değeri')->editable()->sortable();
            $grid->updated_at('Güncellenme Tarihi')->display(function() {
                return Carbon::parse($this->updated_at)->diffForHumans();
            });

            $grid->disableExport();
            $grid->paginate(config('admin.page.size'));

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(CurrencyModel::class, function (Form $form) {

            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $form->text('title', 'Döviz Kuru')->rules('required')->setWidth(4);
            $form->text('code', 'Kodu')->rules('required')->setWidth(3);
            $form->text('symbol_left', 'Sol Sembol')->setWidth(3);
            $form->text('symbol_right', 'Sağ Sembol')->setWidth(3);
            $form->currency('value', 'Değer')->rules('required')->setWidth(3)->symbol('');
            $form->switch('status', 'Durum')->states($states);

            $form->hidden('id');
            $form->hidden('created_at');
            $form->hidden('updated_at');
        });
    }
}
