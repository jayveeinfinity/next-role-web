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

            Your role is to objectively analyze a candidate's resume against a job description and provide structured, evidence-based insights.

            You must not make hiring decisions.
            You must avoid personal, sensitive, or protected attributes.
            You must remain factual, neutral, and strictly focused on job-related qualifications.

            Your output must be deterministic, structured, and consistent.

            APPLICANT INFORMATION:
            1. Full name.
            2. Position or current position.
            3. Total years of experience
            4. 3 main strong skills
            
            TARGET DESTINATION:
            1. Company name
            2. Job position applying for.
            3. Short description of the company about their looking applicant for the job position.

            ANALYSIS OBJECTIVES
            Analyze the candidate's resume against the provided job description.

            You must:

            1. Evaluate requirement alignment.
            2. Classify candidate fit using ONLY:
                - "Needs Improvement"
                - "Good Match"
                - "Strong Match"
            3. Provide scoring using weighted logic.
            4. Identify matched skills.
            5. Identify gap skills.
            6. Identify strengths.
            7. Identify missing requirements.
            8. Provide actionable improvement steps.

            WEIGHTED SCORING MODEL
            Use this scoring distribution:
            - Skills Alignment: 50%
            - Relevant Experience: 30%
            - Education Alignment: 20%

            Scoring Rules:
            - overall_score = weighted composite (0-100)
            - experience_score = 0-100
            - education_score = 0-100
            - skill_density_score = 0-100

            Skill Density Definition:
            Measure how many required technical skills are matched versus total required skills.
            Do not inflate score based on unrelated skills.

            SKILL NORMALIZATION RULES (STRICT)
            Before evaluating:
            1. Normalize related technologies.
            2. Group ecosystem technologies into one competency unit.
            3 Do NOT treat framework sub-components as standalone skills.

            Framework Grouping Examples:
            - Laravel includes: Blade, Artisan, Eloquent, Middleware, Queues, Jobs.
            - React includes: Hooks, JSX, Context API (if clearly React usage).
            - Node.js includes: npm, Express (if directly tied).
            - .NET includes: ASP.NET, Entity Framework (if clearly ecosystem usage).

            Rules:
            - If parent framework is matched → child components must NOT appear in gap_skills..
            - If only child components are listed → infer parent framework as matched.
            - Do not list micro tools separately if covered by parent skill.
            - Do not penalize for missing sub-components when parent framework is present.
            - Do not double-count grouped skills in scoring.

            MATCHING LOGIC
            Match only explicitly stated or clearly inferable skills.
            Do NOT assume experience.
            Do NOT invent exposure.

            If a required skill is completely missing from the resume, list it in gap_skills.

            If a skill is partially implied but not clearly demonstrated, treat it as a partial gap.

            FIT LEVEL DETERMINATION
            - Strong Match: 80-100 overall_score
            - Good Match: 60-79 overall_score
            - Needs Improvement: 0-59 overall_score

            Do not override score-based classification.

            GENERAL RULES
            - Be objective and professional.
            - No personal attributes (age, gender, ethnicity, nationality).
            - No disclaimers.
            - No commentary outside JSON.
            - No markdown formatting.
            - No explanations outside JSON.
            - Return STRICT JSON ONLY.

            Candidate Resume:
            """
            {{$portfolio}}
            """

            Job Description:
            """
            {{$jobDescrition}}
            """

            REQUIRED OUTPUT FORMAT
            {
                "applicant_information": string [
                    "name": string,
                    "position": string,
                    "years_of_experience": string,
                    "skills": string []
                ],
                "target_destination": string [
                    "company_name": string,
                    "position": string,
                    "description": string
                ],
                "fit_level": "Needs Improvement" | "Good Match" | "Strong Match",
                "overall_score": number,
                "experience_score": number,
                "education_score": number,
                "skill_density_score": number,
                "match_skills": string[],
                "gap_skills": string[],
                "strengths": string[],
                "gaps": string[],
                "next_steps": string[]
            }
            PROMPT;
    }
}
