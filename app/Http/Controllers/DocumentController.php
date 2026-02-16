<?php

namespace App\Http\Controllers;

use Spatie\PdfToText\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'portfolio' => ['required', 'file', 'mimes:pdf', 'max:20480'], // 20MB
        ]);

        $path = $request->file('portfolio')->store('pdfs', 'local'); // local disk recommended
        $fullPath = Storage::disk('local')->path($path);

        $text = Pdf::getText($fullPath, config('services.pdftotext_path'));
        $text = str_replace(["\r\n", "\r", "\n"], '', $text);
        $text = preg_replace('/\s+/', ' ', $text);
        $text = trim($text);

        return response()->json([
            'extracted_text' => $text,
            'extracted_text_length' => mb_strlen($text),
        ]);
    }
}
