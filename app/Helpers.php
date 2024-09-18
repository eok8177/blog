<?php

function locale_route($method, $items = null)
{
  if (app()->getLocale() == 'ua') {
    return route('ua.' . $method, $items) . '/';
  }
  return route($method, $items) . '/';
}
