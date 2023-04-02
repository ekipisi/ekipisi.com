<?php

namespace App\Http\Controllers;

use App\Models\FeatureModel;
use App\Models\ProductModel;
use App\Models\ProductFeatureModel;
use App\Models\ReferenceModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function pack()
    {
        $this->seo()->setTitle(__('product.pack.title'));
        $this->seoMeta()->setUrl(route('product.ecommerce.pack'));

        $features = Cache::remember('features', 1200, function () {
            return FeatureModel::where('status', 1)->orderBy('created_at')->get();
        });

        $lite_pack = Cache::remember('lite_pack', 1200, function () {
            return ProductModel::where('id', 1)->first();
        });

        $lite_features = Cache::remember('lite_features', 1200, function () {
            return ProductFeatureModel::where('product_id', 1)->get();
        });

        $pro_pack = Cache::remember('pro_pack', 1200, function () {
            return ProductModel::where('id', 2)->first();
        });

        $pro_features = Cache::remember('pro_features', 1200, function () {
            return ProductFeatureModel::where('product_id', 2)->get();
        });

        $extended_pack = Cache::remember('extended_pack', 1200, function () {
            return ProductModel::where('id', 3)->first();
        });

        $extended_features = Cache::remember('extended_features', 1200, function () {
            return ProductFeatureModel::where('product_id', 3)->get();
        });

        $platinum_pack = Cache::remember('platinum_pack', 1200, function () {
            return ProductModel::where('id', 4)->first();
        });

        $platinum_features = Cache::remember('platinum_features', 1200, function () {
            return ProductFeatureModel::where('product_id', 4)->get();
        });

        $ecommerce_references = Cache::remember('pack_references', 60, function () {
            return ReferenceModel::where(['status' => 1, 'is_logo' => 1, 'category' => 'ecommerce', 'section' => 'pack'])->inRandomOrder()->take(5)->get();
        });

        return view('product/pack')
                ->with('features', $features)
                ->with('lite_pack', $lite_pack)
                ->with('lite_features', $lite_features)
                ->with('pro_pack', $pro_pack)
                ->with('pro_features', $pro_features)
                ->with('extended_pack', $extended_pack)
                ->with('extended_features', $extended_features)
                ->with('platinum_pack', $platinum_pack)
                ->with('platinum_features', $platinum_features)
                ->with('references', $ecommerce_references);
    }

    public function module()
    {
        $this->seo()->setTitle(__('product.module.title'));
        $this->seoMeta()->setUrl(route('product.ecommerce.module'));

        return view('product/module');
    }


}
