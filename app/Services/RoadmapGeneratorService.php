<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class RoadmapGeneratorService
{
    public function generate(
        array $ownedSkills,
        array $skillGap,
        string $careerTitle
    ): array {
        $prompt = $this->buildPrompt(
            $ownedSkills,
            $skillGap,
            $careerTitle
        );

        $apiKey = config('services.groq.api_key');
        $model = config('services.groq.model', 'openai/gpt-oss-20b');

        if (!$apiKey) {
            throw new Exception('API Key Groq belum diset di .env!');
        }

        $response = Http::withToken($apiKey)
            ->acceptJson()
            ->timeout(60)
            ->retry(2, 1000)
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => $model,

                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Kamu adalah career advisor yang membantu mahasiswa membuat roadmap belajar yang realistis dan terstruktur.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ],
                ],

                'temperature' => 0.4,

                'response_format' => [
                    'type' => 'json_object'
                ],
            ]);

        if ($response->failed()) {
            throw new Exception(
                'Gagal menghubungi Groq API: ' . $response->body()
            );
        }

        $content = $response->json('choices.0.message.content');

        if (!$content) {
            throw new Exception('Response dari Groq kosong.');
        }

        return $this->parseResponse($content);
    }

    private function buildPrompt(
        array $ownedSkills,
        array $skillGap,
        string $careerTitle
    ): string {
        $ownedNames = array_map(function ($skill) {
            return is_array($skill)
                ? ($skill['name'] ?? '')
                : $skill;
        }, $ownedSkills);

        $owned = implode(', ', array_filter($ownedNames))
            ?: 'Belum ada skill terdeteksi';

        $gap = implode(', ', $skillGap)
            ?: 'Tidak ada skill gap';

        return <<<PROMPT
Kamu adalah career advisor untuk mahasiswa.

Berdasarkan data berikut:

Target karier:
{$careerTitle}

Skill yang sudah dimiliki:
{$owned}

Skill yang masih kurang:
{$gap}

Buat roadmap belajar yang realistis dan terarah berdasarkan skill gap mahasiswa.

Prioritaskan:
1. Skill gap yang paling penting untuk target karier.
2. Fundamental sebelum skill lanjutan.
3. Urutan pembelajaran yang masuk akal.
4. Materi yang dapat dipelajari mahasiswa dalam waktu terbatas.

Response WAJIB berupa JSON valid dengan struktur persis seperti berikut:

{
    "summary": "ringkasan singkat 2-3 kalimat tentang kesiapan mahasiswa untuk mencapai target karier",
    "roadmap": [
        {
            "week": 1,
            "topic": "nama topik yang harus dipelajari"
        },
        {
            "week": 2,
            "topic": "nama topik yang harus dipelajari"
        }
    ]
}

Ketentuan:
- Maksimal 6 minggu.
- Week harus dimulai dari 1.
- Fokus utama pada skill gap.
- Jangan memasukkan skill yang sudah dikuasai kecuali diperlukan sebagai fundamental.
- Topic harus spesifik, bukan terlalu umum.
- Jangan memberikan markdown.
- Jangan memberikan teks di luar JSON.
- HANYA kembalikan JSON.

PROMPT;
    }

    private function parseResponse(string $content): array
    {
        $cleaned = preg_replace(
            '/```json\s*|\s*```/',
            '',
            $content
        );

        $cleaned = trim($cleaned);

        $decoded = json_decode($cleaned, true);

        if (
            json_last_error() !== JSON_ERROR_NONE ||
            !isset($decoded['roadmap']) ||
            !is_array($decoded['roadmap'])
        ) {
            throw new Exception(
                'Gagal parsing response AI menjadi JSON. Raw response: ' . $content
            );
        }

        $roadmap = array_filter(
            $decoded['roadmap'],
            function ($item) {
                return is_array($item)
                    && isset($item['week'])
                    && isset($item['topic']);
            }
        );

        return [
            'summary' => $decoded['summary'] ?? '',
            'roadmap' => array_values($roadmap),
        ];
    }
}
