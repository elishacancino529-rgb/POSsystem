<?php

namespace App\Controllers;

// Pages controller handles the two simple, static pages: landing and about.
class Pages extends BaseController
{
    // Loads app/Views/landing.php
    public function landing()
    {
        return view('landing');
    }

    // Loads app/Views/about.php
    public function about()
    {
        return view('about');
    }
}