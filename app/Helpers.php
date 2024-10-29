<?php

function locale_route($method, $items = null, $locale = false)
{
  if(!$locale) $locale = app()->getLocale();
  return route($locale. '.' . $method, $items) . '/';
}

function str_cut($str, $length = 150, $end = '...')
{
  return \Illuminate\Support\Str::limit($str, $length, $end);
}