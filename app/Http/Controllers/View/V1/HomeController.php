<?php

namespace App\Http\Controllers\View\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function viewHome()
    {
//        Http::get("/api/v1/products");
        return view("home");
    }
}
