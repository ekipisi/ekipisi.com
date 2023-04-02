<?php

namespace App\Api\Controllers;

use App\Models\UserProductModel;
use App\Models\AnnounceModel;
use App\Models\BillingModel;

use App\Api\Transformers\ProductTransformer;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class UserProductController extends BaseController
{

    public function detail($id)
	{
        $product = UserProductModel::where(['status'=> 1, 'id' => $id])->first();
        $start_date = explode("-", $product['payment_date']);

        $today = date('Y-m-d');
		$announces = AnnounceModel::where(['status'=> 1])->where('date_start', '<=', $today)->where('date_end', '>=', $today)->orderByDesc('created_at');
		$announces = $announces->where('domain', 'none')->orWhere('domain', $product['domain'])->get();

        $temp_billings = BillingModel::where(
            [
                'user_id'=> $product['user_id'], 
                'status' => 0,
                ['price','!=','0']
            ])->orderByDesc('payment_date')->get();

        $billing = Array();
        $total = 0;

        foreach($temp_billings as $temp_billing) {

            if ($temp_billing->currency['code'] == "TRY") {
                $price = $temp_billing->price;
                $total += $temp_billing->price;
            } else {
                $curr = 1 / $temp_billing->currency['value'];
                $total += $temp_billing->price * $curr;
                $price = $temp_billing->price * $curr;
            }

            $billing[] = [
                'id'            => $temp_billing->id,
                'description'   => $temp_billing->description,
                'price'         => "₺" . number_format($price, 2, ',', '.'),
                'orjinal_price' => ($temp_billing->currency['symbol_left'] ? $temp_billing->currency['symbol_left'] : $temp_billing->service['symbol_right']) . "" . number_format($temp_billing->price, 2, ',', '.'),
                'payment_date'  => $temp_billing['payment_date']
            ];
        }

		return [
            'user_id'           => $product['user_id'],
            'service_name'      => $product['title'],
            'service_url'       => "https://www.ekipisi.com.tr/user/service/detail/" . $id,
            'license_key'       => $start_date[2] . $start_date[1] . "-" . $start_date[0] . "-" . $product['user_id'] ."-". $product['id'],
            'license_start_date'=> $start_date[2] . ".". $start_date[1] . "." . $start_date['0'],
            'license_end_date'  => $start_date[2] . ".". $start_date[1] . "." . ((int)date("Y") + 1),
            'domain'            => $product['domain'],
            'period'            => $product['period_id'],
            'status'            => $product['status'],
            'billings'          => $billing,
            'billing_total'     => "₺" . number_format($total, 2, ',', '.'),
            'announces'         => $announces,
        ];
	}
}
