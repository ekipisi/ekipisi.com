<?php

namespace App\Admin\Controllers;

use App\Models\TicketStatusModel;

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Ekipisi\Admin\Controllers\ModelForm;
use Carbon\Carbon;

class TicketStatusController extends Controller
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

            $content->header('Durumlar');
            $content->description('Liste');
            $content->breadcrumb(
                ['text' => 'Durumlar']
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

            $content->header('Durumlar');
            $content->description('Düzenle');
            $content->breadcrumb(
                ['text' => 'Durumlar', 'url' => admin_url('ticketstatus')],
                ['text' => 'Durum Düzenle']
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

            $content->header('Durumlar');
            $content->description('Ekle');
            $content->breadcrumb(
                ['text' => 'Durumlar', 'url' => admin_url('ticketstatus')],
                ['text' => 'Durum Ekle']
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
        return Admin::grid(TicketStatusModel::class, function (Grid $grid) {

            $labels = [
                'danger' => 'danger', 
                'warning' => 'warning', 
                'info' => 'info',
                'primary' => 'primary',
                'success' => 'success',
                'default' => 'default',
            ];

            $grid->id('ID')->sortable();
            $grid->name('Durum')->editable('textarea')->sortable();
            $grid->color("Renk")->display(function(){
                return "<span class=\"label label-$this->color\">" . $this->color . "</span>";
            });

            $grid->created_at('Eklenme Tarihi')->display(function() {
                return Carbon::parse($this->created_at)->format("d M Y, H:i");
            });
            $grid->updated_at('Güncellenme Tarihi')->display(function() {
                return Carbon::parse($this->created_at)->format("d M Y, H:i");
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
        return Admin::form(TicketStatusModel::class, function (Form $form) {

            $labels = [
                'danger' => 'danger', 
                'warning' => 'warning', 
                'info' => 'info',
                'primary' => 'primary',
                'success' => 'success',
                'default' => 'default',
            ];

            $form->text('name', 'Durum')->rules('required')->setWidth(4);
            $form->select('color', 'Renk')->options($labels)->setWidth(3);

            $form->hidden('id');
            $form->hidden('created_at');
            $form->hidden('updated_at');
        });
    }
}
