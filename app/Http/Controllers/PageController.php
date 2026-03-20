<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;

class PageController extends Controller
{
    public function landing()
    {
        return view('welcome');
    }

    public function studycase()
    {
        $venues = Venue::paginate(10);
        return view('studycase', compact('venues'));
    }
}

