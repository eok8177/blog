<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insertOrIgnore([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => Hash::make('12365478'),
        ]);

        DB::table('settings')->insertOrIgnore([
            [
                'key' => 'seo_title_en',
                'title_en' => 'SEO Site Name (EN)',
                'title_ua' => 'SEO Назва сайту (EN)',
                'value' => 'My Blog',
            ],
            [
                'key' => 'seo_title_ua',
                'title_en' => 'SEO Site Name (UA)',
                'title_ua' => 'SEO Назва сайту (UA)',
                'value' => 'Мій Блог',
            ],
            [
                'key' => 'seo_keywords_en',
                'title_en' => 'SEO Keywords (EN)',
                'title_ua' => 'SEO Keywords (EN)',
                'value' => 'SEO Keywords (EN)',
            ],
            [
                'key' => 'seo_keywords_ua',
                'title_en' => 'SEO Keywords (UA)',
                'title_ua' => 'SEO Keywords (UA)',
                'value' => 'SEO Keywords (UA)',
            ],
            [
                'key' => 'seo_description_en',
                'title_en' => 'SEO Description (EN)',
                'title_ua' => 'SEO Description (EN)',
                'value' => 'SEO Description (EN)',
            ],
            [
                'key' => 'seo_description_ua',
                'title_en' => 'SEO Description (UA)',
                'title_ua' => 'SEO Description (UA)',
                'value' => 'SEO Description (UA)',
            ],
        ]);
    }
}
