<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tests\Feature\LandingPageControllerTest;

class LandingPageController extends Controller
{
    public function testedBy()
    {
        return LandingPageControllerTest::class;
    }

    public function show()
    {
        return view('welcome');
    }
}
