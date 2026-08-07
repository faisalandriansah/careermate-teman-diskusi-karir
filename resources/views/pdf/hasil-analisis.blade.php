<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Hasil Analisis CV</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #1e293b;
            margin: 0;
            padding: 30px;
        }

        .header {
            border-bottom: 3px solid #2563eb;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 20px;
            margin: 0 0 4px 0;
            color: #1e293b;
        }

        .header p {
            margin: 0;
            color: #64748b;
            font-size: 11px;
        }

        .score-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .score-box .score {
            font-size: 28px;
            font-weight: bold;
            color: #2563eb;
        }

        .score-box .career-title {
            font-size: 16px;
            font-weight: bold;
            margin: 4px 0;
        }

        .section {
            margin-bottom: 18px;
        }

        .section-title {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            color: #475569;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            margin: 2px 3px 2px 0;
        }

        .badge-skill {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        .badge-gap {
            background: #fffbeb;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        table.roadmap {
            width: 100%;
            border-collapse: collapse;
        }

        table.roadmap td {
            padding: 8px 10px;
            border: 1px solid #e2e8f0;
            font-size: 11px;
            vertical-align: top;
        }

        table.roadmap td.week {
            width: 60px;
            font-weight: bold;
            background: #f8fafc;
            text-align: center;
        }

        .summary-box {
            background: #f8fafc;
            border-left: 3px solid #2563eb;
            padding: 12px 15px;
            font-size: 11px;
            line-height: 1.6;
            color: #334155;
        }

        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #e2e8f0;
            font-size: 9px;
            color: #94a3b8;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Laporan Hasil Analisis CV</h1>
        <p>CareerMate AI &middot; Diperbarui: {{ $analysis->updated_at->translatedFormat('d F Y') }}</p>
    </div>

    <div class="score-box">
        <div class="score">{{ $analysis->match_score }}%</div>
        <div class="career-title">{{ $analysis->career->title ?? 'Belum ada rekomendasi' }}</div>
        <p style="margin:0; font-size:11px; color:#64748b;">Peran paling cocok berdasarkan analisis AI</p>
    </div>

    <div class="section">
        <div class="section-title">Skill Terdeteksi</div>
        @php
            $skills = collect($analysis->skills_json ?? [])->map(fn($s) => is_array($s) ? $s['name'] : $s);
        @endphp
        @forelse ($skills as $skill)
            <span class="badge badge-skill">{{ $skill }}</span>
        @empty
            <p style="font-size:11px; color:#94a3b8;">Belum ada skill terdeteksi.</p>
        @endforelse
    </div>

    <div class="section">
        <div class="section-title">Skill Gap</div>
        @forelse ($analysis->skill_gap_json ?? [] as $gap)
            <span class="badge badge-gap">{{ $gap }}</span>
        @empty
            <p style="font-size:11px; color:#94a3b8;">Tidak ada skill gap.</p>
        @endforelse
    </div>

    <div class="section">
        <div class="section-title">Roadmap Pengembangan</div>
        <table class="roadmap">
            @forelse ($analysis->roadmap_json ?? [] as $step)
                <tr>
                    <td class="week">Minggu {{ $step['week'] ?? '-' }}</td>
                    <td>{{ $step['topic'] ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td>Belum ada roadmap.</td>
                </tr>
            @endforelse
        </table>
    </div>

    @if ($analysis->ai_summary)
        <div class="section">
            <div class="section-title">Ringkasan AI</div>
            <div class="summary-box">
                {{ $analysis->ai_summary }}
            </div>
        </div>
    @endif

    <div class="footer">
        Dokumen ini dihasilkan secara otomatis oleh sistem CareerMate AI.
    </div>
</body>

</html>
