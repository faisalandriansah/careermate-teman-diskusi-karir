<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Laporan Hasil Analisis CV</title>
    <style>
        @page {
            size: A4;
            margin: 14mm 15mm 16mm 15mm;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', 'DejaVu Sans', sans-serif;
            font-size: 10pt;
            color: #1f2937;
            line-height: 1.55;
        }

        strong {
            font-weight: 700;
        }

        /* ============ HEADER (letterhead brand band) ============ */
        .header-wrap {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .header-wrap td {
            vertical-align: top;
            padding: 0;
        }

        .header-band-cell {
            width: 74%;
        }

        .header-band {
            background: #2b3a8f;
            border-bottom-right-radius: 40px;
            padding: 18px 22px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-logo-cell {
            width: 46px;
            vertical-align: middle;
        }

        .logo-icon-box {
            width: 40px;
            height: 40px;
            background: #ffffff;
            border-radius: 6px;
            text-align: center;
            line-height: 40px;
        }

        .logo-icon-box img {
            height: 26px;
            width: auto;
            vertical-align: middle;
        }

        .logo-fallback {
            font-weight: 700;
            color: #2b3a8f;
            font-size: 13pt;
        }

        .header-text-cell {
            vertical-align: middle;
            padding-left: 14px;
        }

        .header-title {
            font-size: 15pt;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.2;
            letter-spacing: -0.2px;
        }

        .header-subtitle {
            font-size: 8pt;
            color: #c3c9ec;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-top: 4px;
        }

        .header-meta-cell {
            width: 26%;
            text-align: right;
            vertical-align: top;
            padding: 6px 2px 0 14px;
            font-size: 8.5pt;
            color: #4b5563;
            line-height: 1.8;
            white-space: nowrap;
        }

        .header-meta-label {
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #6b7280;
            font-weight: 600;
            font-size: 7.5pt;
        }

        .header-meta-value {
            font-size: 10pt;
            font-weight: 600;
            color: #2b3a8f;
            white-space: nowrap;
        }

        /* ============ SCORE CARD ============ */
        .score-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 5px solid #2b3a8f;
            border-radius: 8px;
            padding: 16px 20px;
            margin-bottom: 20px;
            page-break-inside: avoid;
        }

        .score-table {
            width: 100%;
            border-collapse: collapse;
        }

        .score-value-cell {
            width: 150px;
            vertical-align: middle;
        }

        .score-number {
            font-size: 32pt;
            font-weight: 700;
            color: #2b3a8f;
            line-height: 1;
        }

        .score-label {
            font-size: 7.5pt;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
            color: #4b5563;
            margin-top: 6px;
        }

        .score-details-cell {
            padding-left: 26px;
            vertical-align: middle;
        }

        .career-title {
            font-size: 13pt;
            font-weight: 700;
            color: #111827;
            margin-bottom: 2px;
        }

        .career-desc {
            font-size: 9pt;
            color: #4b5563;
            margin-bottom: 14px;
        }

        .progress-track {
            background: #e5e7eb;
            height: 7px;
            width: 100%;
            border-radius: 4px;
        }

        .progress-fill {
            background: #2b3a8f;
            height: 7px;
            border-radius: 4px;
        }

        .progress-caption {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        .progress-caption td {
            font-size: 7.5pt;
            color: #6b7280;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .progress-caption .caption-end {
            text-align: right;
        }

        /* ============ SECTION HEADERS ============ */
        .section {
            margin-bottom: 18px;
            page-break-inside: avoid;
        }

        .section-head {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        .section-head td {
            padding: 0;
            vertical-align: bottom;
        }

        .section-title {
            font-size: 10pt;
            font-weight: 700;
            color: #2b3a8f;
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
            padding-right: 12px;
        }

        .section-rule {
            border-bottom: 1.5px solid #cbd5e1;
            width: 100%;
        }

        /* ============ SKILL CHIPS ============ */
        .chip-box {
            line-height: 2.4;
        }

        .chip {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 9pt;
            font-weight: 500;
            margin-right: 6px;
            margin-bottom: 5px;
        }

        .chip-skill {
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            color: #374151;
        }

        .chip-gap {
            background: #eef2ff;
            border: 1px solid #c7d2fe;
            color: #2b3a8f;
        }

        .empty-text {
            font-size: 9pt;
            color: #6b7280;
            font-style: italic;
            margin: 0;
        }

        /* ============ ROADMAP TABLE ============ */
        .roadmap-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            overflow: hidden;
        }

        .roadmap-table th {
            background: #2b3a8f;
            color: #ffffff;
            font-size: 8.5pt;
            font-weight: 600;
            letter-spacing: 0.5px;
            padding: 9px 14px;
            text-align: left;
        }

        .roadmap-table td {
            padding: 9px 14px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 9.5pt;
            color: #1f2937;
            vertical-align: middle;
        }

        .roadmap-table tbody tr:nth-child(even) td {
            background: #f8fafc;
        }

        .roadmap-table tbody tr:last-child td {
            border-bottom: none;
        }

        .week-label {
            font-weight: 600;
            color: #2b3a8f;
            white-space: nowrap;
        }

        .roadmap-empty {
            text-align: center;
            padding: 18px;
        }

        /* ============ AI SUMMARY ============ */
        .summary-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 4px solid #2b3a8f;
            border-radius: 6px;
            padding: 14px 18px;
            font-size: 9.5pt;
            line-height: 1.7;
            color: #374151;
        }

        /* ============ SIGNATURE (letterhead touch) ============ */
        .signature-block {
            margin-top: 26px;
            page-break-inside: avoid;
        }

        .signature-name {
            font-size: 10.5pt;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #111827;
        }

        .signature-role {
            font-size: 8.5pt;
            color: #6b7280;
        }

        /* ============ FOOTER (letterhead bar) ============ */
        .footer-note {
            margin-top: 18px;
            padding-top: 10px;
            border-top: 1px solid #d1d5db;
            font-size: 8pt;
            color: #6b7280;
            text-align: center;
        }

        .footer-note strong {
            color: #374151;
            font-weight: 600;
        }
    </style>
</head>

<body>
    @php
        $logoPath = public_path('images/careermate-logo.png');
        $logoData = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : null;
        $updatedAt = $analysis->updated_at?->locale('id')->translatedFormat('d F Y');
        $score = (int) round($analysis->match_score ?? 0);
        $skills = collect($analysis->skills_json ?? [])->map(fn($s) => is_array($s) ? $s['name'] : $s);
    @endphp

    <!-- Header -->
    <table class="header-wrap">
        <tr>
            <td class="header-band-cell">
                <div class="header-band">
                    <table class="header-table">
                        <tr>
                            <td class="header-logo-cell">
                                <div class="logo-icon-box">
                                    @if ($logoData)
                                        <img src="data:image/png;base64,{{ $logoData }}" alt="CareerMate AI">
                                    @else
                                        <span class="logo-fallback">CM</span>
                                    @endif
                                </div>
                            </td>
                            <td class="header-text-cell">
                                <div class="header-title">Laporan Hasil Analisis CV</div>
                                <div class="header-subtitle">CareerMate AI &middot; Career Matching Report</div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
            <td class="header-meta-cell">
                <div class="header-meta-label">Diperbarui</div>
                <div class="header-meta-value">{{ $updatedAt ?? '—' }}</div>
            </td>
        </tr>
    </table>

    <!-- Score -->
    <div class="score-card">
        <table class="score-table">
            <tr>
                <td class="score-value-cell">
                    <div class="score-number">{{ $score }}%</div>
                    <div class="score-label">Match Score</div>
                </td>
                <td class="score-details-cell">
                    <div class="career-title">{{ $analysis->career->title ?? 'Belum ada rekomendasi' }}</div>
                    <p class="career-desc">Peran kerja yang paling direkomendasikan berdasarkan pemetaan
                        kualifikasi dan pengalaman pada CV Anda.</p>
                    <div class="progress-track">
                        <div class="progress-fill" style="width: {{ $score }}%;"></div>
                    </div>
                    <table class="progress-caption">
                        <tr>
                            <td>Skor Kecocokan</td>
                            <td class="caption-end">{{ $score }}%</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <!-- Skills Detected -->
    <div class="section">
        <table class="section-head">
            <tr>
                <td class="section-title">Skill Terdeteksi</td>
                <td class="section-rule"></td>
            </tr>
        </table>
        <div class="chip-box">
            @forelse ($skills as $skill)
                <span class="chip chip-skill">{{ $skill }}</span>
            @empty
                <p class="empty-text">Belum ada skill yang terdeteksi dalam dokumen CV Anda.</p>
            @endforelse
        </div>
    </div>

    <!-- Skill Gap -->
    <div class="section">
        <table class="section-head">
            <tr>
                <td class="section-title">Skill Gap (Perlu Ditingkatkan)</td>
                <td class="section-rule"></td>
            </tr>
        </table>
        <div class="chip-box">
            @forelse ($analysis->skill_gap_json ?? [] as $gap)
                <span class="chip chip-gap">{{ $gap }}</span>
            @empty
                <p class="empty-text">Selamat! Tidak ada skill gap yang terdeteksi untuk posisi ini.</p>
            @endforelse
        </div>
    </div>

    <!-- Roadmap -->
    <div class="section">
        <table class="section-head">
            <tr>
                <td class="section-title">Roadmap Pengembangan Karir</td>
                <td class="section-rule"></td>
            </tr>
        </table>
        <table class="roadmap-table">
            <thead>
                <tr>
                    <th style="width: 130px;">Jangka Waktu</th>
                    <th>Fokus Pembelajaran &amp; Target</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($analysis->roadmap_json ?? [] as $step)
                    <tr>
                        <td><span class="week-label">Minggu {{ $step['week'] ?? '-' }}</span></td>
                        <td>{{ $step['topic'] ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="roadmap-empty">
                            <p class="empty-text">Belum ada roadmap pengembangan yang tersedia.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- AI Summary -->
    @if ($analysis->ai_summary)
        <div class="section">
            <table class="section-head">
                <tr>
                    <td class="section-title">Ringkasan &amp; Evaluasi AI</td>
                    <td class="section-rule"></td>
                </tr>
            </table>
            <div class="summary-card">
                {{ $analysis->ai_summary }}
            </div>
        </div>
    @endif

    <!-- Signature (letterhead touch) -->
    <div class="signature-block">
        <div class="signature-name">CareerMate AI</div>
        <div class="signature-role">Automated Career Analysis System</div>
    </div>

    <!-- Footer -->
    <div class="footer-note">
        Dokumen ini dihasilkan secara otomatis oleh platform <strong>CareerMate AI</strong>.
    </div>

</body>

</html>
