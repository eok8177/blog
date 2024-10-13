<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Models\BlogPage;
use App\Models\Page;
use App\Models\Setting;

class HomeController extends FrontController
{
    public function index()
    {
        return view('front.home',[
            'pages' => BlogPage::where('show',true)->orderBy('id', 'desc')->take(5)->get()
        ]);
    }

    public function post($slug)
    {
        $post = BlogPage::where('slug', $slug)->where('show',1)->firstOrFail();
        $this->seo($post);
        return view('front.post',[
            'post' => $post
        ]);
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->where('show',1)->firstOrFail();
        $this->seo($page);
        return view('front.page',[
            'page' => $page
        ]);
    }

    private function seo($page)
    {
        view()->share('seo_title', $page->seo_title ? $page->seo_title : Setting::str('seo_title'));
        view()->share('seo_keywords', $page->seo_keywords ? $page->seo_keywords : Setting::str('seo_keywords'));
        view()->share('seo_description', $page->seo_description ? $page->seo_description : Setting::str('seo_description'));
    }
}
