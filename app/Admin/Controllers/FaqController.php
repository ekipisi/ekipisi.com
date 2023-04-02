<?php

namespace App\Admin\Controllers;

use App\Models\FaqModel;
use App\Models\FaqCategoryModel;

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Ekipisi\Admin\Controllers\ModelForm;
use Carbon\Carbon;

class FaqController extends Controller
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

            $content->header('Sık Sorulan Sorular');
            $content->description('Liste');
            $content->breadcrumb(
                ['text' => 'Sık Sorulan Sorular']
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

            $content->header('Sık Sorulan Sorular');
            $content->description('Düzenle');
            $content->breadcrumb(
                ['text' => 'Sık Sorulan Sorular', 'url' => admin_url('faqs')],
                ['text' => 'Soru Düzenle']
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

            $content->header('Sık Sorulan Sorular');
            $content->description('Ekle');
            $content->breadcrumb(
                ['text' => 'Sık Sorulan Sorular', 'url' => admin_url('faqs')],
                ['text' => 'Soru Ekle']
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
        return Admin::grid(FaqModel::class, function (Grid $grid) {

            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $grid->id('ID')->sortable();
            $grid->status('Durum')->switch($states);
            $grid->video('Video')->status()->sortable();
            
            $grid->name('Soru')->limit(60)->sortable();

            $grid->category('Kategori')->display(function() {
                if ($this->category['parent_id'] == 0) {
                    return $this->category['name'];
                } else {
                    $parent_category = FaqCategoryModel::where('id', $this->category['parent_id'])->first();
                    return $parent_category->name . "&nbsp;&nbsp;<i class=\"fa fa-angle-right\"></i>&nbsp;&nbsp;" . $this->category['name'];
                }
            })->sortable();

            $grid->created_at('Eklenme Tarihi')->display(function() {
                return Carbon::parse($this->created_at)->format("d M Y, H:i");
            })->sortable();

            $grid->model()->ordered();
            $grid->sort_order('Sıra')->orderable();

            $grid->disableExport();
            $grid->paginate(config('admin.page.size'));

            $grid->filter(function (Grid\Filter $filter) {
                $filter->disableIdFilter();
                $filter->like('name', 'Soru');
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
        return Admin::form(FaqModel::class, function (Form $form) use ($id) {

            $category_list = array();
            $categories = FaqCategoryModel::where(['status' => 1])->orderBy('sort_order')->get();
            foreach($categories as $category){
                if ($category->parent_id == 0)
                $category_list[$category->id] = $category->name;
                else
                $category_list[$category->id] = $category->category->name . " > " .$category->name;
            }

            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $form->select('category_id', 'Kategori')->options($category_list)->setWidth(3);
            $form->text('name', 'Başlık')->rules('required')->setWidth(4);
            $form->summernote('description', 'Açıklama')->setWidth(8);
            $form->text('video', 'Youtube Video Id')->setWidth(4);

            $form->switch('status', 'Durum')->states($states);

            if ($id) {
                $form->number('sort_order', 'Sıra')->rules('required');
            } else {

                $last_row = FaqModel::orderBy('sort_order', 'desc')->first();
                if ($last_row)
                    $sort_order = $last_row->sort_order + 1;
                else
                    $sort_order = 1;

                $form->number('sort_order', 'Sıra')->value($sort_order)->rules('required');
            }

            $form->hidden('id');
            $form->hidden('created_at');
            $form->hidden('updated_at');
        });
    }
}
