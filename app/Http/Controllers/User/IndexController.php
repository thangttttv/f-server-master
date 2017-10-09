<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('pages.user.index', [
        ]);
    }

    public function about()
    {
        return view('pages.user.about', [
        ]);
    }

    public function policy()
    {
        return view('pages.user.policy', [
        ]);
    }

    public function terms()
    {
        return view('pages.user.terms', [
        ]);
    }

    public function faq()
    {
        return view('pages.user.faq', [
        ]);
    }

    public function contact()
    {
        return view('pages.user.contact', [
        ]);
    }
}
