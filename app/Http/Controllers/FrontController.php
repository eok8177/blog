<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BlogCategory;

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
        view()->share('norobot', $is_bot ? false : true);
        view()->share('prod', env('APP_ENV') == 'prod' ? true : false);

        if ($request->isMethod('get')) {
            $route = $request->route() ? $request->route()->getName() : '';
            $slug = $request->route() ? $request->route()->parameter('slug') : '';
            $parameters = $request->route() ? $request->route()->originalParameters() : '';
            $locale = isset($locale) ? $locale : 'ua';

            $link_ua = $this->calcLocaleLink('ua', $route, $slug, $parameters);
            $link_en = $this->calcLocaleLink('en', $route, $slug, $parameters);

            view()->share('link_ua', $link_ua);
            view()->share('link_en', $link_en);
        }
        $locale = app()->getLocale();

        // Set global var for a views

        view()->share('locale', $locale);
        view()->share('route_name', $request->route() ? $request->route()->getName() : '');
        view()->share('route_parameters', $request->route() ? $request->route()->parameters : '');
        view()->share('route_prefix', $locale == 'ua' ? 'ua.front' : 'front');

        view()->share('seo', [
            // 'title' => Setting::str('seo_title_'.$locale),
            // 'keywords' => Setting::str('seo_keywords_'.$locale),
            // 'description' => Setting::str('seo_description_'.$locale),
        ]);
    }

    // Change locale with reload current page

    public function changeLocale(Request $request)
    {
        $locale = $request->get('locale', app()->getLocale());
        $route = $request->get('route', false);
        $slug = $request->get('slug', false);
        $parameters = json_decode($request->get('parameters', false), true);

        $link = $this->calcLocaleLink($locale, $route, $slug, $parameters);

        session(['locale' => $locale]);

        return redirect($link);
    }

    private function calcLocaleLink($locale, $route, $slug, $parameters)
    {
        if ($locale == 'en' && str_starts_with($route, 'ua.')) {
            $route = preg_replace('/^ua\./', '', $route);
        }

        if ($locale == 'ua' && !str_starts_with($route, 'ua.')) {
            $route = 'ua.' . $route;
        }

        return route($route, $parameters) . '/';
    }
}
