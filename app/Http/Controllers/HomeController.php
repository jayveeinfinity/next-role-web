<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function __construct()
    {
        Inertia::setRootView('layouts/app');
    }

    public function index() {
        return Inertia::render('Home/Index');
    }

    public function dashboard(string $key) {
        $response = Cache::get("analysis:$key");

        if (!$response) {
            abort(404, 'Analysis result not found or expired.');
        }

        return Inertia::render('Dashboard/Index', [
            'response' => $response
        ]);
    }
}
