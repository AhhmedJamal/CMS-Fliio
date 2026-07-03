<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        if (! in_array($locale, ['en', 'ar'])) {
            abort(404);
        }

        session(['locale' => $locale]);
        // dd(session('locale'));

        return back();
    }
}