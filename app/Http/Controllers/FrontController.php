<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BlogCategory;
use App\Models\Page;
use App\Models\Setting;

class FrontController extends Controller
{
    public function __construct(Request $request)
    {
        // detect is Bot
        $is_bot = false;
        $bot_list = ["Chrome-Lighthouse", "Googlebot", "AdsBot-Google", "Teoma", "alexa", "froogle", "Gigabot", "inktomi", "looksmart", "URL_Spider_SQL", "Firefly", "NationalDirectory", "Ask Jeeves", "TECNOSEEK", "InfoSeek", "WebFindBot", "girafabot", "crawler", "www.galaxy.com", "Scooter", "Slurp", "msnbot", "appie", "FAST", "WebBug", "Spade", "ZyBorg", "rabaz", "Baiduspider", "Feedfetcher-Google", "TechnoratiSnoop", "Rankivabot", "Mediapartners-Google", "Sogou web spider", "WebAlta Crawler", "ELB-HealthChecker/1.0", "Googlebot-Image", "YandexBot", "SemrushBot", "bingbot", "AhrefsBot", "DotBot", "archive.org_bot", "Bytespider", "Bytedance", "Amazonbot", "Pinterestbot", "Rankabot", "Twitterbot", "Taboolabot", "Timpibot", "GeedoProductSearch", "claudebot", "ZoominfoBot", "Go-http-client/1.1", "GPTBot"];

        foreach ($bot_list as $bot) {
            if (strpos($request->server('HTTP_USER_AGENT', ''), $bot) !== false) {
                $is_bot = true;
            }
        }

        // Set global var for a views
        view()->share('norobot', $is_bot ? false : true);
        view()->share('prod', env('APP_ENV') == 'prod' ? true : false);

        view()->share('lang_link_ua', $this->calcLocaleLink('ua'));
        view()->share('lang_link_en', $this->calcLocaleLink('en'));

        view()->share('menu_pages', Page::where('show_in_menu', true)->orderBy('id', 'asc')->take(5)->get());
        view()->share('menu_categories', BlogCategory::where('show_in_menu', true)->orderBy('id', 'asc')->take(5)->get());

        view()->share('seo_title', Setting::str('seo_title'));
        view()->share('seo_keywords', Setting::str('seo_keywords'));
        view()->share('seo_description', Setting::str('seo_description'));
    }

    private function calcLocaleLink($locale)
    {
        $route = request()->route() ? request()->route()->getName() : '';
        $parameters = request()->route() ? request()->route()->originalParameters() : '';

        if (str_starts_with($route, 'en.')) {
            $route = preg_replace('/^en\./', '', $route);
        }
        if (str_starts_with($route, 'ua.')) {
            $route = preg_replace('/^ua\./', '', $route);
        }

        return locale_route($route, $parameters, $locale);
    }
}
