<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class AIService
{
    public function generate(string $portfolio, string $jobDescrition)
    {
        $prompt = $this->buildPrompt($portfolio, $jobDescrition);

        $response = Http::post(
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-lite:generateContent?key=' . env('GOOGLE_AI_API_KEY'),
            [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]
        );

        $json = $response->json();

        // 🔐 Always log raw response for debugging
        Log::info('Gemini raw response', $json ?? []);

        $text = $json['candidates'][0]['content']['parts'][0]['text'] ?? '';

        // Remove Markdown code fences if they exist
        $text = preg_replace('/^```json\s*|\s*```$/', '', trim($text));

        // Decode JSON safely
        $aiOutput = json_decode($text, true);

        if (!$aiOutput) {
            return response()->json([
                'error' => 'AI returned invalid JSON',
                'raw' => $text
            ], 500);
        }

        // Return structured JSON directly
        return $aiOutput;
    }

    private function buildPrompt(string $portfolio, string $jobDescrition)
    {
        return <<<PROMPT
            You are NextRole, an AI career guidance assistant.

            Your role is to objectively analyze a candidate's resume against a job description
            and provide constructive, unbiased, and professional insights.

            You must not make hiring decisions.
            You must avoid personal, sensitive, or protected attributes.
            Your response must be factual, supportive, and focused on job-related qualifications only.

            Analyze the candidate's resume against the job description below.

            Your task:
            1. Identify how well the candidate matches the job requirements.
            2. Determine the candidate's fit level using these categories ONLY:
            - "Needs Improvement"
            - "Good Match"
            - "Strong Match"
            3. Provide a overall score from 0 to 100.
            4. Provide a experience, education, skill density from 0 to 100.
            5. List match skills and tools related
            6. List gaps skills and tools related
            7. List clear strengths based on matched skills and experience.
            8. List gaps or missing requirements.
            9. Provide actionable next steps the candidate can take to improve their fit.

            Rules:
            - Be objective and professional.
            - Do not invent skills or experience.
            - Base all conclusions strictly on the provided information.
            - Make sure if gap skills are connected to match skills, remove it from the list.
            - Do NOT include personal attributes such as age, gender, nationality, or ethnicity.
            - Do NOT include disclaimers or extra commentary.
            - Return STRICT JSON ONLY. No markdown, no explanations.

            Candidate Resume:
            """
            {{$portfolio}}
            """

            Job Description:
            """
            {{$jobDescrition}}
            """

            Return the response in the following JSON structure exactly:

            {
                "overall_score": number,
                "detailed_scores": {
                    "experience": number,
                    "education": number,
                    "skill density": number
                }
                "fit_level": "Needs Improvement | Good Match | Strong Match",
                "match_skills": string[],
                "gap_skills": string[],
                "strengths": string[],
                "gaps": string[],
                "next_steps": string
            }
            PROMPT;
    }
}
