<?php

namespace App\Admin\Controllers;

use App\Models\LanguageModel;

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Ekipisi\Admin\Controllers\ModelForm;

class LanguageController extends Controller
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

            $content->header('Diller');
            $content->description('Liste');
            $content->breadcrumb(
                ['text' => 'Diller']
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

            $content->header('Diller');
            $content->description('Düzenle');
            $content->breadcrumb(
                ['text' => 'Diller', 'url' => admin_url('messages')],
                ['text' => 'Dil Düzenle']
            );
            $content->body($this->form($id)->edit($id));
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

            $content->header('Diller');
            $content->description('Ekle');
            $content->breadcrumb(
                ['text' => 'Diller', 'url' => admin_url('messages')],
                ['text' => 'Dil Ekle']
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
        return Admin::grid(LanguageModel::class, function (Grid $grid) {

            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $grid->model()->ordered();

            $grid->id('ID')->sortable();
            $grid->status('Durum')->switch($states);

            $grid->flag('Bayrak')->thumb()->sortable();

            $grid->name('Dil')->editable()->sortable();
            $grid->code('Kod')->editable()->sortable();

            $grid->sort_order('Sıra')->orderable();

            $grid->disableExport();
            $grid->paginate(config('admin.page.size'));

            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($id = null)
    {
        return Admin::form(LanguageModel::class, function (Form $form) use($id) {

            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $form->text('name', 'Dil')->rules('required')->setWidth(4);
            $form->text('code', 'Kod')->rules('required')->setWidth(3);
            $form->file('flag', 'Bayrak')->setWidth(3);

            if ($id) {
                $form->number('sort_order', 'Sıra')->rules('required');
                $form->switch('status', 'Durum')->states($states);
            } else {

                $last_row = LanguageModel::orderBy('sort_order', 'desc')->first();
                if ($last_row)
                    $sort_order = $last_row->sort_order + 1;
                else
                    $sort_order = 1;

                $form->number('sort_order', 'Sıra')->value($sort_order)->rules('required');
                $form->switch('status', 'Durum')->value(1)->states($states);
            }
            
            $form->hidden('id');
            $form->hidden('created_at');
            $form->hidden('updated_at');
        });
    }
}
