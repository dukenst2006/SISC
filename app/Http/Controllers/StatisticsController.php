<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index() {
        return redirect(route('dashboard'))->with('info', 'Statistics are not available at the moment.');
    }
}
