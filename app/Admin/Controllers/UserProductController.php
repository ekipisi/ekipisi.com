<?php

namespace App\Admin\Controllers;

use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CurrencyModel;
use App\Models\UserProductModel;
use App\Models\PaymentTypeModel;
use App\Models\PeriodModel;
use App\Http\Controllers\Controller;

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Layout\Content;
use Ekipisi\Admin\Controllers\ModelForm;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserProductController extends Controller
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

            $content->header('Hizmetler');
            $content->description('Liste');
            $content->breadcrumb(
                ['text' => 'Müşteriler', 'url' => admin_url('users')],
                ['text' => 'Hizmetler']
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

            $content->header('Müşteri Ürünleri');
            $content->description('Düzenle');
            $content->breadcrumb(
                ['text' => 'Müşteriler', 'url' => admin_url('users')],
                ['text' => 'Hizmetler', 'url' => admin_url('services')],
                ['text' => 'Hizmet Düzenle']
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

            $content->header('Hizmetler');
            $content->description('Ekle');
            $content->breadcrumb(
                ['text' => 'Müşteriler', 'url' => admin_url('users')],
                ['text' => 'Hizmetler', 'url' => admin_url('services')],
                ['text' => 'Hizmet Ekle']
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
        return Admin::grid(UserProductModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $states = [
                'on' => ['value' => 1, 'text' => 'Aktif', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => 'Pasif', 'color' => 'danger'],
            ];
            $grid->status('Durum')->switch($states);

            $grid->user('Müşteri')->display(function() {
                return $this->user['firstname'] . " " . $this->user['lastname'];
            })->sortable();
            $grid->title('Ürün')->sortable();
            $grid->price('Fiyat')->editable()->sortable();
            $grid->price_renewal('Yenileme')->editable()->sortable();
            $grid->currency()->title('Para Birimi')->sortable();

            $grid->paymenttype()->name('Ödeme Türü')->sortable();
            $grid->period()->name('Periyot')->sortable();


            $grid->payment_date('Başlangıç Tarihi')->display(function() {
                return Carbon::parse($this->created_at)->format("d M Y");
            });

            // $grid->created_at('Eklenme Tarihi')->display(function() {
            //     return Carbon::parse($this->created_at)->format("d M Y, H:i");
            // });

            $grid->disableExport();
            $grid->paginate(config('admin.page.size'));


            $grid->filter(function (Grid\Filter $filter) {
                
                $filter->disableIdFilter();

                $filter->like('title', 'Başlık');

                $filter->where(function ($query) {
                    $query->where('user_id', "{$this->input}");
                }, 'Müşteri')->select(UserModel::all()->pluck('name', 'id'));

                $filter->where(function ($query) {
                    $query->where('product_id', "{$this->input}");
                }, 'Ürün')->select(ProductModel::all()->pluck('title', 'id'));

            });


        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($id=null)
    {
        return Admin::form(UserProductModel::class, function (Form $form) use($id) {

            Admin::script($this->script());

            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $product_list = array();
            $products = ProductModel::where('status', 1)->get();
            foreach($products as $product){
                $product_list[$product->id] = $product->title;
            }

            $payment_list = array();
            $payments = PaymentTypeModel::where('status', 1)->get();
            foreach($payments as $payment){
                $payment_list[$payment->id] = $payment->name;
            }

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

            if (session()->has('user_id') && $id == null) {
                $form->hidden('user_id', 'Kullanıcı')->value(session('user_id'))->setWidth(2); 
            } else {
                $form->select('user_id', 'Müşteri')->options(function ($user_id) {
                    $user = UserModel::find($user_id);
                    if ($user) {
                        return [$user->id => $user->firstname . ' ' . $user->lastname];
                    }
                })->ajax(admin_url('api/user'))->rules('required')->setWidth(3);
            }

            $form->select('product_id', 'Ürün')->options($product_list)->rules('required')->setWidth(3);

            $form->text('title', 'Başlık')->setWidth(3);
            $form->summernote('description', 'Açıklama')->setWidth(8);
            $form->textarea('domain', 'Alan Adı')->setWidth(8);

            $form->currency('price', 'Tek Sefer Fiyatı')->rules('required')->setWidth(3)->symbol('');
            $form->currency('price_renewal', 'Yenileme Ücreti')->setWidth(3)->symbol('');            
     
            $form->select('currency_id', 'Para Birimi')->options($currency_list)->rules('required')->setWidth(2);

            $form->date('payment_date', 'Ödeme Tarihi')->format('YYYY-MM-DD')->value(Carbon::now()->format("Y-m-d"));
            $form->select('payment_type', 'Ödeme Tipi')->options($payment_list)->rules('required')->setWidth(3);
            $form->select('period_id', 'Periyot')->options($period_list)->rules('required')->setWidth(3);

            $form->text('cpanel_uid', 'Cpanel Uid')->setWidth(2);
            $form->switch('status', 'Durum')->states($states);

            $form->hidden('id');
            $form->hidden('created_at');
            $form->hidden('updated_at');

            $form->saved(function (Form $form) use ($id) {
                
                $success = new MessageBag([
                    'title' => 'Bilgi',
                    'message' => 'Hizmet güncellendi.',
                ]);

                return redirect(admin_url('users/' . $form->model()->user_id . '/detail#services'))->with(compact('success'));
            });

        });
    }

    protected function script()
    {
        return <<<EOT
        $(".product_id").change(function () {
            var product_id = $(this).val();
            $.getJSON('/api/product/' + product_id, function (data) {
                var product = data.data;
                $('.title').val(product['title']);
                $('.description').val(product['description']);
                $('.price').val(product['price']);
                $('.price_renewal').val(product['price_renewal']);
                $('.currency_id').val(product['currency_id']).trigger('change');
                $('.period_id').val(product['period']).trigger('change');
            });
        });
EOT;
    }

}
