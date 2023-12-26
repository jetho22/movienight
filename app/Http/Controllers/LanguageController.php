<?php

namespace App\Http\Controllers;

class LanguageController
{
    public function switchLang($lang)
    {
        if (in_array($lang, ['en', 'da'])) { // Add other languages as needed
            Session::put('locale', $lang);
        }

        return back();
    }
}
