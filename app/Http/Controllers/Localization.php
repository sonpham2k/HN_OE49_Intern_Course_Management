<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Localization extends Controller
{
    public function changeLanguage(Request $request)
    {
        $lang = $request->language;
        $language = config('app.locale');
        if ($lang == 'en') {
            $language = 'en';
        } else {
            $language = 'vi';
        }
        Session::put('language', $lang);

        return redirect()->back();
    }
}
