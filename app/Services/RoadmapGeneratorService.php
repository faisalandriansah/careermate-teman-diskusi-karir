<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class RoadmapGeneratorService
{
    public function generate(array $ownedSkills, array $skillGap, string $careerTitle): array
    {
        $prompt = $this->buildPrompt($ownedSkills, $skillGap, $careerTitle);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.groq.api_key'),
            'Content-Type' => 'application/json',
        ])->post('https://api.groq.com/openai/v1/chat/completions', [
            'model' => 'llama-3.3-70b-versatile',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.4,
        ]);

        if ($response->failed()) {
            throw new Exception('Gagal menghubungi AI: ' . $response->body());
        }

        $content = $response->json('choices.0.message.content');

        return $this->parseResponse($content);
    }

    private function buildPrompt(array $ownedSkills, array $skillGap, string $careerTitle): string
    {
        $owned = implode(', ', $ownedSkills) ?: 'Belum ada skill terdeteksi';
        $gap = implode(', ', $skillGap) ?: 'Tidak ada skill gap';

        return <<<PROMPT
Kamu adalah career advisor untuk mahasiswa. Berdasarkan data berikut:

Target karier: {$careerTitle}
Skill yang sudah dimiliki: {$owned}
Skill yang masih kurang: {$gap}

Buatkan response HANYA dalam format JSON valid (tanpa markdown, tanpa penjelasan tambahan) dengan struktur persis seperti ini:

{
  "summary": "ringkasan singkat 2-3 kalimat tentang kesiapan mahasiswa ini untuk karier tersebut",
  "roadmap": [
    {"week": 1, "topic": "nama topik yang harus dipelajari"},
    {"week": 2, "topic": "nama topik yang harus dipelajari"}
  ]
}

Buat roadmap maksimal 6 minggu, fokus ke skill_gap yang paling penting duluan. Jawab HANYA JSON-nya saja.
PROMPT;
    }

    private function parseResponse(string $content): array
    {
        // Bersihkan kalau AI kasih markdown code block
        $cleaned = preg_replace('/```json|```/', '', $content);
        $cleaned = trim($cleaned);

        $decoded = json_decode($cleaned, true);

        if (json_last_error() !== JSON_ERROR_NONE || !isset($decoded['roadmap'])) {
            throw new Exception('Gagal parsing response AI menjadi JSON. Raw response: ' . $content);
        }

        return [
            'summary' => $decoded['summary'] ?? '',
            'roadmap' => $decoded['roadmap'] ?? [],
        ];
    }
}
