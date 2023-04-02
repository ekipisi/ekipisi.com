<?php

namespace App\Admin\Controllers;

use App\Models\ReferenceModel;

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Ekipisi\Admin\Controllers\ModelForm;
use Carbon\Carbon;

class ReferenceController extends Controller
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

            $content->header('Referanslar');
            $content->description('Liste');
            $content->breadcrumb(
                ['text' => 'Referanslar']
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

            $content->header('Referanslar');
            $content->description('Düzenle');
            $content->breadcrumb(
                ['text' => 'Referanslar', 'url' => admin_url('references')],
                ['text' => 'Referans Düzenle']
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

            $content->header('Referanslar');
            $content->description('Ekle');
            $content->breadcrumb(
                ['text' => 'Referanslar', 'url' => admin_url('references')],
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
        return Admin::grid(ReferenceModel::class, function (Grid $grid) {

            $category_list = [
                'ecommerce' => 'E-Ticaret',
                'website' => 'Website',
                'project' => 'Projeler',
                'mobile_ios' => 'iOs',
                'mobile_android' => 'Android',
            ];

            $section_list = [
                'reference' => 'Referanslar',
                'home' => 'Ana Sayfa',
                'pack' => 'E-Ticaret Paketleri'
            ];

            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $grid->model()->ordered();

            $grid->id('ID')->sortable();
            $grid->status('Durum')->switch($states);
            $grid->is_logo('Logo')->status();

            $grid->category('Kategori')->editable('select', $category_list)->sortable();
            $grid->section('Bölüm')->editable('select', $section_list)->sortable();

            $grid->name('Firma Adı')->editable('textarea')->sortable();
            $grid->url('Bağlantı')->editable()->sortable();
            
            // $grid->created_at('Eklenme Tarihi')->display(function() {
            //     return Carbon::parse($this->created_at)->format("d M Y, H:i");
            // })->sortable();

            $grid->sort_order('Sıra')->orderable();

            $grid->disableExport();
            $grid->paginate(config('admin.page.size'));

            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });

            $grid->filter(function (Grid\Filter $filter) use($category_list, $section_list) {
                
                $filter->disableIdFilter();
                $filter->like('name', 'Firma Adı');

                $filter->where(function ($query) {
                    $query->where('category', "{$this->input}");
                }, 'Kategori')->select($category_list);

                $filter->where(function ($query) {
                    $query->where('section', "{$this->input}");
                }, 'Bölüm')->select($section_list);

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
        return Admin::form(ReferenceModel::class, function (Form $form) use($id) {
            
            $category_list = [
                'ecommerce' => 'E-Ticaret',
                'website' => 'Website',
                'project' => 'Projeler',
                'mobile_ios' => 'iOs',
                'mobile_android' => 'Android',
            ];

            $section_list = [
                'reference' => 'Referanslar',
                'home' => 'Ana Sayfa',
                'pack' => 'E-Ticaret Paketleri'
            ];

            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $form->select('section', 'Bölüm')->options($section_list)->rules('required')->setWidth(3);
            $form->select('category', 'Kategori')->options($category_list)->rules('required')->setWidth(3);

            $form->text('name', 'Firma Adı')->rules('required')->setWidth(6);
            if ($id) {
                $form->url('url', 'Bağlantı')->rules('required')->setWidth(6);
            } else {
                $form->url('url', 'Bağlantı')->value('https://www.')->rules('required')->setWidth(6);
            }

            $form->file('image', 'Resim')->setWidth(4);
            $form->switch('is_logo', 'Logo')->states($states)->help("Sadece logo ise işaretle");

            if ($id) {
                $form->number('sort_order', 'Sıra')->rules('required');
                $form->switch('status', 'Durum')->states($states);
            } else {

                $last_row = ReferenceModel::orderBy('sort_order', 'desc')->first();
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
