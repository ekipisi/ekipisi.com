<?php

namespace App\Http\Controllers;

use App\Models\ReferenceModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{

    public function home()
    {
        $this->seo()->setTitle(config('app.name'))->hideSiteName();
        $this->seoMeta()->setUrl(route('home'));

        $references = Cache::remember('home_references', 60, function () {
            return ReferenceModel::where(['status' => 1, 'is_logo' => 1, 'section' => 'home'])->inRandomOrder()->take(6)->get();
        });

        return view('home')
                ->with('references', $references);
    }

    public function about()
    {
        $this->seo()->setTitle(__('about.title'));
        $this->seoMeta()->setUrl(route('about'));

        return view('about');
    }
    
}