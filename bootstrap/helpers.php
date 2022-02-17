<?php

function parseLocaleLan(){
  $locale = request()->segment(1);
  $locales = config('app.available_locales');
  $default = config('app.fallback_locale');

  if ($locale !== $default && in_array($locale, $locales)) {
      app()->setLocale($locale);
      return $locale;
  }
}
