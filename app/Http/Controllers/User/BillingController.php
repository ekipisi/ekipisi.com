<?php

namespace App\Http\Controllers\User;

use App\Models\BillingModel;
use App\Models\UserProductModel;
use App\Models\CurrencyModel;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillingPaymentRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class BillingController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function home(Request $request)
    {
        $this->seo()->setTitle(__('user.billing.title'));

        $billings = BillingModel::where('user_id', Auth::id())
                    ->orderBy('is_paid')
                    ->orderByDesc('payment_date')
                    ->paginate(config('app.page.size'));

        return view('user/billing/home')
                ->with('billings', $billings);
    }

    public function payment(Request $request, $id)
    {
        $this->seo()->setTitle(__('user.billing.payment.title'));

        $billing = BillingModel::where(['user_id'=> Auth::id(), 'id' => $id])->first();
        
        if ($billing->status){
            return redirect(route('user.billing.home'));
        }

        $service = UserProductModel::where(['user_id'=> Auth::id(), 'id' => $billing->service_id])->first();

        $has_service = $billing->service_id? true : false;

        $invoice_no = $billing->invoice_no;
        $price = ($billing->currency['symbol_left'] ? $billing->currency['symbol_left'] : $billing->service['symbol_right']) . "" . number_format($billing->price, 2, ',', '.');
        $price_tl = (float)$billing->price / (float)$billing->currency['value'];

        $installment = (array)json_decode(config('payment.installment'), true);
        $commission = ($installment[1] * 100) - 100;
        $price_commission = number_format($price_tl * (float)$installment[1], 2, ',', '.');

        $currencies = Cache::remember('currencies', 260, function () {
            $currencies_json = file_get_contents('https://www.doviz.com/api/v2/currencies/all/latest');
            $currencies_temp = json_decode($currencies_json);
    
            $currencies = [];
            
            foreach($currencies_temp as $currency) {
                if ($currency->code=="USD" || $currency->code=="EUR" ) {
                    $currencies[] = ['code'=>$currency->code, 'price' => number_format($currency->selling, 3, ',', '.')];
                }
            }

            return $currencies;
        });

        return view('user/billing/payment')
                ->with('id', $id)
                ->with('commission', $commission)
                ->with('invoice_no', $invoice_no)
                ->with('price', $price)
                ->with('price_tl', $price_tl)
                ->with('price_commission', $price_commission)
                ->with('has_service', $has_service)
                ->with('service', $service)
                ->with('currencies', $currencies);
    }

    public function payment_do(BillingPaymentRequest $request, $id){

        return back()->withInput()->withErrors(['updated' => 'Ödeme işlemi tamamlandı.']);
    }

    public function is_paid(Request $request){

        BillingModel::find($request->id)->update([
            'is_paid' => 1,
            'is_paid_date' => date('Y-m-d H:i:s')
        ]);

        return back()->withInput()->withErrors(['updated' => 'Ödeme Bildirimi gerçekleştirildi. Teşekkürler.']);
    }

    public function invoice($id)
    {
        $invoice = BillingModel::where('user_id', Auth::id())->where('id', $id)->first();

        return view('user/billing/invoice')
                ->with('invoice', $invoice);
    }

}
