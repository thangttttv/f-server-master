<?php
namespace App\Http\Controllers\Advertiser;

use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    public function index()
    {
        return view('pages.advertiser.landing.index', []);
    }

    public function terms()
    {
        return view('pages.advertiser.landing.terms', []);
    }
}
