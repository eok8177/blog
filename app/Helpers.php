<?php

function locale_route($method, $items = null)
{
  if (app()->getLocale() == 'ua') {
    return route('ua.' . $method, $items) . '/';
  }
  return route($method, $items) . '/';
}

function str_cut($str, $length = 150, $end = '...')
{
  return \Illuminate\Support\Str::limit($str, $length, $end);
}