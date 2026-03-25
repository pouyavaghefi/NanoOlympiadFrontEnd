<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Models\TopMenu;
class StaticPageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $locale = app()->getLocale();
            $languageId = $locale === 'ar' ? 5 : 1;

            $static_pages = DB::table('static_pages')
                ->leftJoin('aboutus_translations', function ($join) use ($languageId) {
                    $join->on('static_pages.id', '=', 'aboutus_translations.aboutus_id')
                        ->where('aboutus_translations.language_id', '=', $languageId);
                })
                ->leftJoin('feature_translations', function ($join) use ($languageId) {
                    $join->on('static_pages.id', '=', 'feature_translations.feature_id')
                        ->where('feature_translations.language_id', '=', $languageId);
                })
                ->leftJoin('department_translations', function ($join) use ($languageId) {
                    $join->on('static_pages.id', '=', 'department_translations.static_page_id')
                        ->where('department_translations.language_id', '=', $languageId);
                })
                ->select(
                    'static_pages.*',
                    'aboutus_translations.translation as aboutus_translation',
                    'aboutus_translations.description as aboutus_description',
                    'feature_translations.translation as feature_translation',
                    'feature_translations.feature_description as feature_description',
                    'department_translations.translation as department_translation',
                    'department_translations.translation_description as department_description'
                )
                ->get()
                ->keyBy('name')
                ->map(function ($item) use ($locale) {
                    if ($locale === 'ar') {
                        $item->value = $item->aboutus_translation ?? $item->feature_translation ?? $item->department_translation ?? $item->value;
                        $item->description = $item->aboutus_description ?? $item->feature_description ?? $item->department_description ?? null;
                    }
                    return $item;
                })
                ->toArray();

            $topmenu_navigation = TopMenu::where('is_active', 1)
                ->orderBy('priority')
                ->get();

            $bases = DB::table('base_infos')
                ->whereIn('type', [
                    'siteName',
                    'siteDescription',
                    'siteOwner',
                    'siteUrl',
                    'subdomain1Url',
                    'subdomain2Url',
                    'siteLogo',
                    'siteFavicon',
                    'siteLangs'
                ])
                ->pluck('value', 'type');

            $footerData = DB::table('static_pages')->where('type', 'footer')->get()->pluck('value', 'name');

            $view->with([
                'bases' => $bases,
                'static_pages' => $static_pages,
                'topmenu_navigation' => $topmenu_navigation,
                'footerData' => $footerData
            ]);
        });
    }
}
