<?php

namespace App\Http\Controllers;

use Inertia\Response;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(): Response 
    {
        return Inertia::render('Dashboard');
    }
}
