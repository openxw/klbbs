<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PagesController extends Controller
{
    //
    public function root()
    {
        # code...
        $user = Auth::user();
        return view('pages.root', compact('user'));
    }

}
