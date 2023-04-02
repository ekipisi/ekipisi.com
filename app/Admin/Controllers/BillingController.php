<?php

namespace App\Admin\Controllers;

use App\Models\UserModel;
use App\Models\UserProductModel;
use App\Models\CurrencyModel;
use App\Models\BillingModel;

use Ekipisi\Admin\Form;
use Ekipisi\Admin\Grid;
use Ekipisi\Admin\Facades\Admin;
use Ekipisi\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Ekipisi\Admin\Controllers\ModelForm;
use Carbon\Carbon;

class BillingController extends Controller
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

            $content->header('Ödemeler');
            $content->description('Liste');
            $content->breadcrumb(
                ['text' => 'Ödemeler']
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

            $content->header('Ödemeler');
            $content->description('Düzenle');
            $content->breadcrumb(
                ['text' => 'Ödemeler', 'url' => admin_url('billings')],
                ['text' => 'Ödeme Düzenle']
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

            $content->header('Ödemeler');
            $content->description('Ekle');
            $content->breadcrumb(
                ['text' => 'Ödemeler', 'url' => admin_url('billings')],
                ['text' => 'Ödeme Ekle']
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
        return Admin::grid(BillingModel::class, function (Grid $grid) {
            $grid->id('ID')->sortable();

            $grid->custom('Hizmet')->display(function() {
                if ($this->service){
                    return $this->service['status'];
                }
                else {
                    return "0";
                }
            })->status();

            $grid->status('Ödeme')->status();
            $grid->is_paid('Bildirim')->status();

            $grid->invoice_no('Fatura No')->display(function() {
                return "<b>#" . $this->invoice_no . "</b>";
            })->sortable();

            $grid->user('Müşteri')->display(function() {
                return $this->user['firstname'] . " " . $this->user['lastname'];
            })->sortable();

            $grid->service('Hizmet')->display(function() {
                if ($this->service)
                    return $this->service['title'];
                else 
                    return "-";
            })->sortable();

            $grid->price('Fiyat')->display(function() {
                return ($this->currency['symbol_left'] ? $this->currency['symbol_left'] : $this->currency['symbol_right']) . " " . $this->price;
            })->sortable();

            $grid->payment_date('Ödeme Tarihi')->display(function() {
                return Carbon::parse($this->created_at)->format("d M Y");
            });


            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });

            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });

            $grid->filter(function (Grid\Filter $filter) {
                
                $filter->disableIdFilter();

                $filter->where(function ($query) {
                    $query->where('user_id', "{$this->input}");
                }, 'Müşteri')->select(UserModel::all()->pluck('name', 'id'));

                $filter->like('invoice_no', 'Fatura No#');
                $filter->like('domain', 'Alan Adı');

                $filter->equal('status', 'Durum')->radio([
                    ''   => 'Tümü',
                    0    => 'Ödenmedi',
                    1    => 'Ödendi',
                ]);

                $filter->equal('is_paid', 'Bildirim')->radio([
                    ''   => 'Tümü',
                    0    => 'Yapılmadı',
                    1    => 'Yapıldı',
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
    protected function form()
    {
        return Admin::form(BillingModel::class, function (Form $form) {

            Admin::script($this->script());

            $states = [
                'Aktif' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'Pasif' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $paid_states = [
                'on' => ['value' => 1, 'text' => 'Evet', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => 'Hayır', 'color' => 'danger'],
            ];

            $currency_list = array();
            $currencies = CurrencyModel::where('status', 1)->get();
            foreach($currencies as $currency) {
                $currency_list[$currency->id] = $currency->title;
            }

            $form->select('user_id', 'Müşteri')->options(function ($user_id) {
                $user = UserModel::find($user_id);
                if ($user) {
                    return [$user->id => $user->firstname . ' ' . $user->lastname];
                }
            })->ajax(admin_url('api/user'))->rules('required')->setWidth(3);

            $form->select('service_id', 'Hizmet')->options(function ($service_id) {
                $service = UserProductModel::find($service_id);
                if ($service) {
                    return [$service->id => $service->title];
                }
            })->rules('required')->setWidth(3);

            $form->text('invoice_no', 'Fatura No')->setWidth(3);
            $form->currency('price', 'Ödenecek Tutar')->rules('required')->setWidth(3)->symbol('');
            $form->select('currency_id', 'Para Birimi')->options($currency_list)->rules('required')->setWidth(2);

            $form->date('payment_date', 'Ödeme Tarihi')->format('YYYY-MM-DD')->value(Carbon::now()->format("Y-m-d"));

            $form->textarea('domain', 'Alan Adı')->rows(2)->setWidth(8);
            $form->textarea('description', 'Açıklama')->setWidth(8);            

            $form->switch('status', 'Durum')->states($states);
            $form->switch('is_paid', 'Ödendi mi?')->states($paid_states);

            $form->hidden('id');
            $form->hidden('created_at');
            $form->hidden('updated_at');

            $form->saved(function (Form $form) {

              if ($form->model()->is_paid) {

                if ($form->model()->service_id) {
                    UserProductModel::find($form->model()->service_id)->update([
                        'status' => 1
                    ]);
                }

                //ToDo: Hizmet tarihi güncellenecek.

                BillingModel::find($form->model()->id)->update([
                    'status' => 1,
                    'is_paid_date' => date('Y-m-d H:i:s')
                ]);
              }
                
            
            });


        });
    }

    protected function script()
    {

        $service_api = admin_url('api/userservice');
        $detail_api = admin_url('api/userservicedetail');

        return <<<EOT
        $(document).on('change', ".user_id", function () {
            var target = $(this).closest('.fields-group').find(".service_id");
            $.get("$service_api?q="+this.value, function (data) {
                target.find("option").remove();
                $(target).select2({
                    data: $.map(data['data'], function (d) {
                        d.id = d.id;
                        d.text = d.text;
                        return d;
                    })
                }).trigger('change');
            });
        });

        $(".service_id").change(function () {
            var service_id = $(this).val();
            $.get('$detail_api?q=' + service_id, function (data) {
                var product = data['data'][0];
                // $('.description').val(product.title + " " + (product.description?product.description:''));
                $('.price').val(product.price);
                $('.currency_id').val(product.currency_id).trigger('change');
            });
        });
EOT;
    }

}
