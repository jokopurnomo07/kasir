<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index', [
            'licenses' => "Ahmad Muzayyin",
            'data' => Setting::all(),
            'user' => Auth::user(),
        ]);
    }
}
