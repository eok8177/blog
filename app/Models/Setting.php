<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = ['id'];

    public static function val($key)
    {
        return self::select('value')->where('key', $key)->firstOrNew()->value;
    }

    public static function str($key)
    {
        $field = app()->getLocale() == 'en' ? $key.'_en' : $key.'_ua';
        $val = self::select('value')->where('key', $field)->firstOrNew()->value;
        if ($val) {
            $val = trim(preg_replace('/\s+/', ' ', $val));
            $val = strip_tags($val);
        }
        return $val;
    }

    public function getTitleAttribute()
    {
        $field = app()->getLocale() == 'en' ? 'title_en' : 'title_ua';
        return $this->$field;
    }
}
