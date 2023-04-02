<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function project()
    {
        $this->seo()->setTitle(__('service.project.title'));
        $this->seoMeta()->setUrl(route('service.project'));

        return view('service/project');
    }

    public function website()
    {
        $this->seo()->setTitle(__('service.website.title'));
        $this->seoMeta()->setUrl(route('service.website'));

        return view('service/website');
    }

    public function google()
    {
        $this->seo()->setTitle(__('service.google.title'));
        $this->seoMeta()->setUrl(route('service.google'));

        return view('service/google');
    }


}
