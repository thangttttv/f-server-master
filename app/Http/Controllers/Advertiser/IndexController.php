<?php
namespace App\Http\Controllers\Advertiser;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('pages.advertiser.dashboard.index', []);
    }
}
