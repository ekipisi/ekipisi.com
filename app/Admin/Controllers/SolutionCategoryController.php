<?php

namespace App\Admin\Controllers;

use App\Models\SolutionCategoryModel;

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Ekipisi\Admin\Controllers\ModelForm;
use Carbon\Carbon;

class SolutionCategoryController extends Controller
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

            $content->header('Kategoriler');
            $content->description('Liste');
            $content->breadcrumb(
                ['text' => 'Çözüm Merkezi', 'url' => admin_url('solutions')],
                ['text' => 'Kategoriler']
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

            $content->header('Kategoriler');
            $content->description('Düzenle');
            $content->breadcrumb(
                ['text' => 'Çözüm Merkezi', 'url' => admin_url('solutions')],
                ['text' => 'Kategoriler', 'url' => admin_url('solutioncategory')],
                ['text' => 'Kategori Düzenle']
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

            $content->header('Kategoriler');
            $content->description('Ekle');
            $content->breadcrumb(
                ['text' => 'Çözüm Merkezi', 'url' => admin_url('solutions')],
                ['text' => 'Kategoriler', 'url' => admin_url('solutioncategory')],
                ['text' => 'Kategori Ekle']
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
        return Admin::grid(SolutionCategoryModel::class, function (Grid $grid) {
            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $grid->id('ID')->sortable();
            $grid->status('Durum')->switch($states);
            $grid->name('Kategori')->editable('textarea')->sortable();
            
            $grid->created_at('Eklenme Tarihi')->display(function() {
                return Carbon::parse($this->created_at)->format("d M Y, H:i");
            })->sortable();

            $grid->updated_at('Güncellenme Tarihi')->display(function() {
                return Carbon::parse($this->updated_at)->format("d M Y, H:i");
            })->sortable();

            $grid->model()->ordered();
            $grid->sort_order('Sıra')->orderable();

            $grid->disableExport();
            $grid->paginate(config('admin.page.size'));

            $grid->filter(function (Grid\Filter $filter) {
                
                $filter->disableIdFilter();
                $filter->like('name', 'Kategori');

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
        return Admin::form(SolutionCategoryModel::class, function (Form $form) use ($id) {

            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $form->text('name', 'Kategori')->rules('required')->setWidth(4);
            
            if ($id) {
                $form->number('sort_order', 'Sıra')->rules('required');
            } else {

                $last_row = SolutionCategoryModel::orderBy('sort_order', 'desc')->first();
                if ($last_row)
                    $sort_order = $last_row->sort_order + 1;
                else
                    $sort_order = 1;

                $form->number('sort_order', 'Sıra')->value($sort_order)->rules('required');
            }

            $form->switch('status', 'Durum')->states($states);

            $form->hidden('id');
            $form->hidden('created_at');
            $form->hidden('updated_at');
        });
    }
}
