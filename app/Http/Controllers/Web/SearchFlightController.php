<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class SearchFlightController extends Controller
{
    public function __invoke () {
        return view('search');
    }
}
