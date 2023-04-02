<?php

namespace App\Admin\Controllers;

use App\Models\FeatureModel;

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Ekipisi\Admin\Controllers\ModelForm;
use Carbon\Carbon;

class FeatureController extends Controller
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

            $content->header('Ürün Özellikleri');
            $content->description('Liste');

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

            $content->header('Ürün Özellikleri');
            $content->description('Düzenle');

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

            $content->header('Ürün Özellikleri');
            $content->description('Ekle');

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
        return Admin::grid(FeatureModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $states = [
                'on' => ['value' => 1, 'text' => 'Aktif', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => 'Pasif', 'color' => 'danger'],
            ];
            $grid->status('Durum')->switch($states)->sortable();
            $grid->name('Özellik')->editable('textarea')->sortable();

            $grid->updated_at('Eklenme Tarihi')->display(function() {
                return Carbon::parse($this->created_at)->diffForHumans();
            })->sortable();

            $grid->model()->ordered();
            $grid->sort_order('Sıra')->orderable();

            $grid->disableExport();
            $grid->paginate(config('admin.page.size'));

            $grid->filter(function (Grid\Filter $filter) {
                
                $filter->disableIdFilter();
                $filter->like('name', 'Özellik');

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
        return Admin::form(FeatureModel::class, function (Form $form) use($id) {

            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $form->text('name', 'Kategori')->rules('required')->setWidth(4);

            if ($id) {
                $form->number('sort_order', 'Sıra')->rules('required');
            } else {
                $last_row = FeatureModel::orderBy('sort_order', 'desc')->first();
                if ($last_row)
                    $sort_order = $last_row->sort_order + 1;
                else
                    $sort_order = 1;
                $form->number('sort_order', 'Sıra')->value($sort_order)->rules('required');
            }

            if ($id) {
                $form->switch('status', 'Durum')->states($states);
            } else {
                $form->switch('status', 'Durum')->value(1)->states($states);
            }

            $form->hidden('id');
            $form->hidden('created_at');
            $form->hidden('updated_at');

            $form->saved(function (Form $form)  {
                return redirect(admin_url('features/create'));
            });


        });
    }
}
