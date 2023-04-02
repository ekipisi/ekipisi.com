<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment()
    {
        $this->seo()->setTitle(__('payment.title'));
        $this->seoMeta()->setUrl(route('payment'));

        return view('payment');
    }
}
