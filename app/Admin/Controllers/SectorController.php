<?php

namespace App\Admin\Controllers;

use App\Models\SectorModel;

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Ekipisi\Admin\Controllers\ModelForm;

use Carbon\Carbon;

class SectorController extends Controller
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

            $content->header('Sektörler');
            $content->description('Liste');
            $content->breadcrumb(
                ['text' => 'Sektörler']
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

            $content->header('Sektörler');
            $content->description('Düzenle');
            $content->breadcrumb(
                ['text' => 'Sektörler', 'url' => admin_url('sectors')],
                ['text' => 'Sektör Düzenle']
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

            $content->header('Sektörler');
            $content->description('Ekle');
            $content->breadcrumb(
                ['text' => 'Sektörler', 'url' => admin_url('sectors')],
                ['text' => 'Sektör Ekle']
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
        return Admin::grid(SectorModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->name('Sektör Adı')->editable()->sortable();

            $grid->created_at('Eklenme Tarihi')->display(function() {
                return Carbon::parse($this->created_at)->format("d M Y, H:i");
            })->sortable();

            $grid->disableExport();
            $grid->paginate(config('admin.page.size'));

            $grid->filter(function (Grid\Filter $filter) {
                
                $filter->disableIdFilter();
                $filter->like('name', 'Sektör Adı');

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
        return Admin::form(SectorModel::class, function (Form $form) {


            $form->text('name', 'Firma Adı')->rules('required')->setWidth(6);

            $form->hidden('id');
            $form->hidden('created_at');
            $form->hidden('updated_at');

        });
    }
}
