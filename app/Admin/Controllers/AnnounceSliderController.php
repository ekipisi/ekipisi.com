<?php

namespace App\Admin\Controllers;

use App\Models\AnnounceSliderModel;

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Ekipisi\Admin\Controllers\ModelForm;
use Carbon\Carbon;

class AnnounceSliderController extends Controller
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

            $content->header('E-Ticaret Slider');
            $content->description('E-Ticaret Yönetici Paneli Sliderları');
            $content->breadcrumb(['text' => 'E-Ticaret Sliders']);

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

            $content->header('E-Ticaret Slider');
            $content->description('Düzenle');
            $content->breadcrumb(
                ['text' => 'E-Ticaret Slider', 'url' => admin_url('announce_sliders')],
                ['text' => 'Slider Düzenle']
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

            $content->header('E-Ticaret Slider');
            $content->description('Ekle');
            $content->breadcrumb(
                ['text' => 'E-Ticaret Slider', 'url' => admin_url('announce_sliders')],
                ['text' => 'Slider Ekle']
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
        return Admin::grid(AnnounceSliderModel::class, function (Grid $grid) {

            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $grid->id('ID')->sortable();
            $grid->status('Durum')->switch($states);

            $grid->name('Başlık');

            $grid->created_at('Eklenme Tarihi')->display(function() {
                return Carbon::parse($this->created_at)->format("d M Y, H:i");
            })->sortable();

            $grid->updated_at('Güncellenme Tarihi')->display(function() {
                return Carbon::parse($this->updated_at)->format("d M Y, H:i");
            })->sortable();


            $grid->disableExport();
            $grid->paginate(config('admin.page.size'));

            $grid->filter(function (Grid\Filter $filter) {
                
                $filter->disableIdFilter();
                $filter->like('name', 'Başlık');
                
                $filter->equal('status', 'Durum')->radio([
                    ''   => 'Tümü',
                    0    => 'Pasif',
                    1    => 'Aktif',
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
        return Admin::form(AnnounceSliderModel::class, function (Form $form) {

            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $form->text('name', 'Başlık')->setWidth(8);
            $form->text('url', 'Bağlantı')->setWidth(8);
            $form->editor('description', 'Açıklama')->setWidth(10);
            $form->file('slider', 'Slider')->setWidth(4)->help("Boyut 760x506 pixel");
            
            $form->switch('status', 'Durum')->states($states);

            $form->hidden('id');
            $form->hidden('created_at');
            $form->hidden('updated_at');
        });
    }
}
