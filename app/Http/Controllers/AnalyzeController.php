<?php

namespace App\Http\Controllers;

use App\Services\AIService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AnalyzeController extends Controller
{
    public function __construct(
        protected AIService $aiService
    ){}

    public function index(Request $request) {
        $jobDescription = $request->jobDescription;

        $portfolio = "";

        $response = $this->aiService->generate($portfolio, $jobDescription);

        $key = Str::uuid();

        Cache::put("analysis:$key", $response, now()->addMinutes(10));

        return redirect()->route('dashboard', $key);
    }
}