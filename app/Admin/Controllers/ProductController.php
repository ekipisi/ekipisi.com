<?php

namespace App\Admin\Controllers;

use App\Models\ProductModel;
use App\Models\CurrencyModel;
use App\Models\PeriodModel;
use App\Models\FeatureModel;
use App\Http\Controllers\Controller;

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Layout\Content;
use Ekipisi\Admin\Controllers\ModelForm;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class ProductController extends Controller
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

            $content->header('Ürünler');
            $content->description('Liste');
            $content->breadcrumb(
                ['text' => 'Ürünler']
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

            $content->header('Ürünler');
            $content->description('Düzenle');
            $content->breadcrumb(
                ['text' => 'Ürünler', 'url' => admin_url('products')],
                ['text' => 'Ürün Düzenle']
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

            $content->header('Ürünler');
            $content->description('Ekle');
            $content->breadcrumb(
                ['text' => 'Ürünler', 'url' => admin_url('products')],
                ['text' => 'Ürün Ekle']
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
        return Admin::grid(ProductModel::class, function (Grid $grid) {

            $currencies = Cache::remember('currencies_select', 1200, function () {
                $list=array();
                $currencies = CurrencyModel::where('status', 1)->select(['id', 'title as text'])->get();
                foreach($currencies as $currency) {
                    $list[$currency->id] = $currency->text;
                }
                return $list;
            });

            $period_list = array();
            $periods = PeriodModel::where('status', 1)->get();
            foreach($periods as $period){
                $period_list[$period->id] = $period->name;
            }

            $states = [
                'on' => ['value' => 1, 'text' => 'Aktif', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => 'Pasif', 'color' => 'danger'],
            ];

            $categories = [
                'eticaret' => 'E-Ticaret',
                'danismanlik' => 'Danışmanlık',
                'hosting-ssd' => 'Sunucu', 
                'hosting-shared' => 'Hosting',
                'domain' => 'Alan Adı'
            ];

            $grid->id('ID')->sortable();
            $grid->status('Durum')->switch($states);
            $grid->category('Kategori')->editable('select', $categories)->sortable();
            $grid->title('Ürün')->editable('textarea')->sortable();

            $grid->currency_id('Para Birimi')->editable('select', $currencies)->sortable();

            $grid->price('Fiyat')->editable()->sortable();
            $grid->price_renewal('Yenileme Ücreti')->editable()->sortable();

            $grid->period('Periyot')->editable('select', $period_list)->sortable();

            $grid->updated_at('Güncellenme Tarihi')->display(function() {
                return Carbon::parse($this->updated_at)->diffForHumans();
            });

            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });

            $grid->filter(function (Grid\Filter $filter) use($period_list, $currencies, $categories) {
                
                $filter->disableIdFilter();
                $filter->like('title', 'Ürün Adı');
                
                $filter->where(function ($query) {
                    $query->where('category', "{$this->input}");
                }, 'Kategori')->select($categories);

                $filter->where(function ($query) {
                    $query->where('user_id', "{$this->input}");
                }, 'Periyot')->select($period_list);

                $filter->where(function ($query) {
                    $query->where('user_id', "{$this->input}");
                }, 'Para Birimi')->select($currencies);

                $filter->equal('status', 'Durum')->radio([
                    ''   => 'Tümü',
                    0    => 'Pasif',
                    1    => 'Aktif',
                ]);
            });

            $grid->disableRowSelector();
            $grid->disableExport();
            $grid->paginate(config('admin.page.size'));
        
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($id = null)
    {
        return Admin::form(ProductModel::class, function (Form $form) use($id) {

            $period_list = array();
            $periods = PeriodModel::where('status', 1)->get();
            foreach($periods as $period){
                $period_list[$period->id] = $period->name;
            }

            $currency_list = array();
            $currencies = CurrencyModel::where('status', 1)->get();
            foreach($currencies as $currency) {
                $currency_list[$currency->id] = $currency->title;
            }

            $feature_list = array();
            $features = FeatureModel::where('status', 1)->get();
            foreach($features as $feature){
                $feature_list[$feature->id] = $feature->name;
            }

            $categories = [
                'eticaret' => 'E-Ticaret',
                'danismanlik' => 'Danışmanlık',
                'hosting-ssd' => 'Sunucu', 
                'hosting-shared' => 'Hosting',
                'domain' => 'Alan Adı'
            ];

            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];
            
            $form->select('category', 'Kategori')->options($categories)->rules('required')->setWidth(2);

            $form->text('title', 'Ürün Adı')->rules('required')->setWidth(4);
            $form->textarea('description', 'Açıklama')->setWidth(8);

            $form->currency('price', 'Tek Sefer Fiyatı')->rules('required')->setWidth(3)->symbol('');
            $form->currency('price_renewal', 'Yenileme Ücreti')->setWidth(3)->symbol('');

            $form->select('currency_id', 'Para Birimi')->options($currency_list)->rules('required')->setWidth(2);
            $form->select('period', 'Periyot')->options($period_list)->rules('required')->setWidth(3);

            $form->switch('status', 'Durum')->states($states);


            $form->hasMany('features', 'Özellikler', function (Form\NestedForm $form) use($feature_list) {
                $form->select('feature_id', 'Özellik')->options($feature_list)->rules('required')->setWidth(2);
                $form->html('<b>Etiketler:</b> <span>close</span>, <span>check</span>, <span>info</span>, <span>phone-ticket</span>, <span>phone</span>, <span>ticket</span>');
                $form->text('content', 'İçerik');
            });


            $form->hidden('id');
            $form->hidden('created_at');
            $form->hidden('updated_at');

            $form->saved(function (Form $form) use($id) {

                Cache::flush();

            });



        });
    }
}
