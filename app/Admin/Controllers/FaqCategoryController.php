<?php

namespace App\Admin\Controllers;

use App\Models\FaqCategoryModel;

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Ekipisi\Admin\Controllers\ModelForm;
use Carbon\Carbon;

class FaqCategoryController extends Controller
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
                ['text' => 'Sık Sorulan Sorular', 'url' => admin_url('faqs')],
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
                ['text' => 'Sık Sorulan Sorular', 'url' => admin_url('faqs')],
                ['text' => 'Kategoriler', 'uri' => admin_url('faqcategory')],
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
                ['text' => 'Sık Sorulan Sorular', 'url' => admin_url('faqs')],
                ['text' => 'Kategoriler', 'uri' => admin_url('faqcategory')],
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
        return Admin::grid(FaqCategoryModel::class, function (Grid $grid) {
            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $grid->id('ID')->sortable();
            $grid->status('Durum')->switch($states);

            $grid->name('Kategori')->display(function(){
                if ($this->category) {
                    return $this->category->name . "&nbsp;&nbsp;<i class=\"fa fa-angle-right\"></i>&nbsp;&nbsp;" . $this->name;
                } else {
                    return $this->name;
                }
            })->sortable();

            $grid->faqs('Soru Sayısı')->display(function(){
                return "<center>" . count($this->faqs) . "</center>";
            })->sortable();
            
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
        return Admin::form(FaqCategoryModel::class, function (Form $form) use ($id) {

            $category_list = array();
            $categories = FaqCategoryModel::where(['status'=>1, 'parent_id' => 0])->get();
            $category_list['0'] = "Ana Kategori Yok";
            foreach($categories as $category){
                $category_list[$category->id] = $category->name;
            }

            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $form->select('parent_id', 'Ana Kategori')->options($category_list)->setWidth(3);
            $form->text('name', 'Kategori')->rules('required')->setWidth(4);
            $form->textarea('description', 'Açıklama')->setWidth(8);
            
            if ($id) {
                $form->number('sort_order', 'Sıra')->rules('required');
            } else {

                $last_row = FaqCategoryModel::orderBy('sort_order', 'desc')->first();
                if ($last_row)
                    $sort_order = $last_row->sort_order + 1;
                else
                    $sort_order = 1;

                $form->number('sort_order', 'Sıra')->value($sort_order)->rules('required');
            }

            $form->text('icon', 'Ikon')->rules('required')->setWidth(4)->help('https://bulkitv2.cssninja.io/_components-icons-im.html');

            $form->switch('status', 'Durum')->states($states);

            $form->hidden('id');
            $form->hidden('created_at');
            $form->hidden('updated_at');
        });
    }
}
