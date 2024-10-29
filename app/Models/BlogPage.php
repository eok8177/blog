<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogPage extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title_ua'
            ]
        ];
    }

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class);
    }

    public function getTitleAttribute()
    {
        $field = app()->getLocale() == 'en' ? 'title_en' : 'title_ua';
        return $this->$field;
    }

    public function getPreviewAttribute()
    {
        $field = app()->getLocale() == 'en' ? 'preview_en' : 'preview_ua';
        return $this->$field;
    }

    public function getDescriptionAttribute()
    {
        $field = app()->getLocale() == 'en' ? 'description_en' : 'description_ua';
        return $this->$field;
    }


    public function getSeoTitleAttribute()
    {
        $field = app()->getLocale() == 'en' ? 'seo_title_en' : 'seo_title_ua';
        return $this->$field;
    }

    public function getSeoKeywordsAttribute()
    {
        $field = app()->getLocale() == 'en' ? 'seo_keywords_en' : 'seo_keywords_ua';
        return $this->$field;
    }

    public function getSeoDescriptionAttribute()
    {
        $field = app()->getLocale() == 'en' ? 'seo_description_en' : 'seo_description_ua';
        return $this->$field;
    }

}
