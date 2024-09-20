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
        return $this->belongsToMany(BlogCategory::class, 'blog_category_blog_pages', 'blog_page_id', 'blog_category_id');
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
}