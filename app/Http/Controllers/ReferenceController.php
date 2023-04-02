<?php

namespace App\Http\Controllers;

use App\Models\ReferenceModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ReferenceController extends Controller
{
    public function home()
    {
        $this->seo()->setTitle(__('reference.title'));
        $this->seoMeta()->setUrl(route('reference'));

        $ecommerce_references = Cache::remember('references', 1200, function () {
            return ReferenceModel::where(['status' => 1, 'is_logo' => 0, 'category' => 'ecommerce', 'section' => 'reference'])->orderBy('sort_order')->get();
        });

        $website_references = Cache::remember('websites', 1200, function () {
            return ReferenceModel::where(['status' => 1, 'is_logo' => 0, 'category' => 'website', 'section' => 'reference'])->orderBy('sort_order')->get();
        });

        $project_references = Cache::remember('projects', 1200, function () {
            return ReferenceModel::where(['status' => 1, 'is_logo' => 0, 'category' => 'project', 'section' => 'reference'])->orderBy('sort_order')->get();
        });

        return view('reference')
                ->with('ecommerce', $ecommerce_references)
                ->with('website', $website_references)
                ->with('project', $project_references);
    }
}
