<?php

namespace App\Http\Controllers\User;

use App\Models\FaqModel;
use App\Models\FaqCategoryModel;
use App\Models\FaqHelpfulModel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FaqController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function home(Request $request)
    {
        $this->seo()->setTitle(__('user.faq.title'));

        $faq_categories = Cache::remember('faq_categories', 1200, function () {
            return FaqCategoryModel::where(['status' => 1, 'parent_id' => 0])->get();
        });

        return view('user/faq/home')
                ->with('categories', $faq_categories);
    }

    public function category(Request $request, $id)
    {
        $page = $request->get('page');

        $faq_category = Cache::remember('faq_category-' . $id, 1200, function () use($id) {
            return FaqCategoryModel::where(['status'=> 1, 'id' => $id])->first();
        });

        $this->seo()->setTitle($faq_category->name);

        $faqs = Cache::remember('faqs-' . $id . '-' . $page, 1200, function () use($id, $page) {
            return FaqModel::where(['status' => 1, 'category_id' => $id])
                        ->orderByDesc('sort_order')
                        ->paginate(config('app.page.size'));
        });

        return view('user/faq/category')
                ->with('category', $faq_category)
                ->with('faqs', $faqs);
    }

    public function detail($id)
    {
        $faq = Cache::remember('faq-' . $id, 1200, function () use($id) {
            return FaqModel::where(['status' => 1, 'id' => $id])->first();
        });

        $this->seo()->setTitle($faq->name);

        $helpful = FaqHelpfulModel::where(['faq_id' => $id, 'user_id' => Auth::id()])->first();

        return view('user/faq/detail')
                ->with('faq', $faq)
                ->with('helpful', $helpful);
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $page = $request->get('page');

        $faqs = Cache::remember('faqs-' . $query . '-' . $page, 1200, function () use($query, $page) {
            return FaqModel::where(['status' => 1, ['name', 'like', '%' . $query . '%']])
                        ->orderByDesc('sort_order')
                        ->paginate(config('app.page.size'));
        });

        return view('user/faq/search')
                ->with('query', $query)
                ->with('faqs', $faqs);
    }

    public function helpful($id, $helpful) {
        $data = FaqHelpfulModel::where(['faq_id' => $id, 'user_id' => Auth::id()])->first();
        if ($data) {
            FaqHelpfulModel::find($data->id)->update([
                'rate' => $helpful
            ]);
        } else {
            FaqHelpfulModel::create([
                'faq_id' => $id,
                'user_id' => Auth::id(),
                'rate' => $helpful,
            ]);
        }

    }
    
}
