<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        if (! in_array($locale, ['en', 'ar'])) {
            abort(404);
        }

        session(['locale' => $locale]);

        return back();
    }
}