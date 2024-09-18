<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Models\BlogCategory;
use App\Models\BlogPage;
use Illuminate\Http\Request;

class HomeController extends FrontController
{
    public function index(Request $request, $town = false)
    {
        $lang = app()->getLocale();
        if (!$town) {
            session()->forget('town_seo');
        }
        $seo_text = '';//Setting::val('home_seo_txt_'.$lang);

        $seo = [
            // 'title' => Setting::str('seo_title_'.$lang),
            // 'keywords' => Setting::str('seo_keywords_'.$lang),
            // 'description' => Setting::str('seo_description_'.$lang),
        ];

        return view('front.home',[
            'pages' => BlogPage::where('show',true)->orderBy('id', 'desc')->take(5)->get(),
            'seo_text' => $seo_text,
            'seo' => $seo,
        ]);
    }

    public function post($slug)
    {
        $post = BlogPage::where('slug', $slug)->firstOrFail();
        return view('front.post',[
            'post' => $post
        ]);
    }
}
