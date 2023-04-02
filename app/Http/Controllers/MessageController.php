<?php

namespace App\Http\Controllers;

use App\Models\MessageModel;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\DemoRequest;
use App\Http\Requests\CallRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function contact()
    {
        $this->seo()->setTitle(__('contact.title'));
        $this->seoMeta()->setUrl(route('contact'));

        return view('contact');
    }

    public function contact_save(ContactRequest $request)
    {
        $result = MessageModel::create([
            'user_id' => Auth::id(),
            'type' => 1,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'subject' => $request->subject,
            'email' => $request->email,
            'message' => $request->message,
            'newsletter' => 0,
            'read' => 0
        ]);

        if (config("app.pushbullet")){
            \PushBullet::device(config('app.pushbullet.device'))->note($request->subject . ': ' . $request->firstname . " " . $request->lastname , $request->message);
        }

        return redirect(route('contact'))->withErrors(['updated' => 'Mesajınız tarafımıza ulaşmıştır. En kısa sürede geri dönüş yapacağız.']);
    }

    public function demo_save(DemoRequest $request)
    {
        $result = MessageModel::create([
            'user_id' => Auth::id(),
            'type' => 2,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'subject' => "Demo Talebi",
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'newsletter' => $request->newsletter,
            'read' => 0
        ]);

        //ToDo:Demo Bilgileri oluşturulacak

        if (config("app.pushbullet")){
            \PushBullet::device(config('app.pushbullet.device'))->note('Demo Talebi: ' . $request->firstname . " " . $request->lastname , $request->message);
        }

        return redirect(route('product.ecommerce.pack'))->withErrors(['updated' => 'Demo talebiniz alınmış. Bilgileriniz en kısa sürede e-posta adresinize iletilecektir.']);
    }

    public function call_save(CallRequest $request)
    {
        $result = MessageModel::create([
            'user_id' => Auth::id(),
            'type' => 3,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'subject' => $request->subject,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => "",
            'newsletter' => 0,
            'read' => 0
        ]);

        if (config("app.pushbullet")){
            \PushBullet::device(config('app.pushbullet.device'))->note('Biz Sizi Arayalım: ' . $request->firstname . " " . $request->lastname , $request->phone);
        }

        return redirect(route('product.ecommerce.pack'))->withErrors(['updated' => 'Arama talebiniz alındı. Danışmanlarımız en kısa sürede sizi arayacaklar.']);
    }

    public function pack_order(Request $request)
    {
        $domain = $request->domain;
        $pack = $request->pack;
        $message = $request->message;

        session(['domain' => $domain, 'pack' => $pack, 'message' => $message]);
        
        return redirect(route('register'))->withErrors(['updated' => 'Sipariş işlemini tamamlamak için kayıt olmanız gerekmektedir.']);
    }


}