<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Laporan Hasil Analisis CV</title>
    <style>
        @page {
            size: A4;
            margin: 16mm 16mm 18mm 16mm;
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
            font-size: 9.5pt;
            color: #1f2937;
            line-height: 1.55;
        }

        /* ============ MASTHEAD ============ */
        .masthead {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        .masthead td {
            vertical-align: middle;
        }

        .mh-logo {
            width: 46px;
        }

        .logo-box {
            width: 40px;
            height: 40px;
            border: 1.5px solid #1e293b;
            border-radius: 6px;
            text-align: center;
            line-height: 38px;
        }

        .logo-box img {
            height: 24px;
            width: auto;
            vertical-align: middle;
        }

        .logo-fallback {
            font-weight: 700;
            color: #1e293b;
            font-size: 12pt;
        }

        .brand-name {
            font-size: 13pt;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: .2px;
        }

        .brand-sub {
            font-size: 7pt;
            color: #64748b;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .mh-meta {
            width: 44%;
            text-align: right;
        }

        .meta-line {
            font-size: 8pt;
            margin-bottom: 3px;
        }

        .meta-line .k {
            color: #64748b;
        }

        .meta-line .v {
            color: #0f172a;
            font-weight: 700;
            padding-left: 6px;
        }

        /* ============ DOCUMENT TITLE ============ */
        .doc-title {
            text-align: center;
            border-top: 2px solid #1e293b;
            border-bottom: 1px solid #cbd5e1;
            padding: 12px 0 10px;
            margin-bottom: 16px;
        }

        .doc-title h1 {
            font-size: 14pt;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: 2px;
        }

        .doc-title p {
            font-size: 8pt;
            color: #475569;
            margin-top: 4px;
            letter-spacing: .3px;
        }

        /* ============ SECTION ============ */
        .section {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        .sec-head {
            border-bottom: 1.2px solid #94a3b8;
            padding-bottom: 5px;
            margin-bottom: 9px;
        }

        .sec-no {
            display: inline-block;
            background: #1e293b;
            color: #ffffff;
            font-size: 8pt;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 3px;
            margin-right: 8px;
            vertical-align: middle;
        }

        .sec-title {
            font-size: 10pt;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: .4px;
            text-transform: uppercase;
            vertical-align: middle;
        }

        /* ============ INFO TABLE ============ */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #e2e8f0;
        }

        .info-table td {
            padding: 6px 12px;
            font-size: 9pt;
            border-bottom: 1px solid #eef2f7;
        }

        .info-table tr:last-child td {
            border-bottom: none;
        }

        .info-table .k {
            width: 28%;
            color: #64748b;
            font-weight: 600;
            background: #f8fafc;
        }

        .info-table .v {
            color: #0f172a;
            font-weight: 600;
        }

        /* ============ RESULT CARD ============ */
        .result-card {
            border: 1px solid #e2e8f0;
            border-top: 4px solid #1e293b;
            border-radius: 6px;
            background: #fcfcfd;
        }

        .result-table {
            width: 100%;
            border-collapse: collapse;
        }

        .score-cell {
            width: 160px;
            text-align: center;
            vertical-align: middle;
            padding: 14px 16px;
        }

        .score-num {
            font-size: 32pt;
            font-weight: 700;
            color: #1e293b;
            line-height: 1;
        }

        .score-cap {
            font-size: 7pt;
            text-transform: uppercase;
            letter-spacing: 1.3px;
            color: #64748b;
            margin-top: 6px;
        }

        .career-cell {
            padding: 14px 18px 14px 20px;
            vertical-align: middle;
            border-left: 1px solid #e2e8f0;
        }

        .career-role {
            font-size: 7.5pt;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .career-name {
            font-size: 12.5pt;
            font-weight: 700;
            color: #0f172a;
        }

        .career-desc {
            font-size: 8.5pt;
            color: #475569;
            margin: 4px 0 10px;
        }

        .progress-track {
            background: #e2e8f0;
            height: 6px;
            border-radius: 3px;
        }

        .progress-fill {
            background: #1e293b;
            height: 6px;
            border-radius: 3px;
        }

        .progress-cap {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .progress-cap td {
            font-size: 7.5pt;
            color: #64748b;
        }

        .progress-cap .r {
            text-align: right;
        }

        /* ============ CHIPS ============ */
        .chip-box {
            line-height: 2.3;
        }

        .chip {
            display: inline-block;
            padding: 3px 11px;
            border-radius: 4px;
            font-size: 8.5pt;
            font-weight: 500;
            margin-right: 5px;
            margin-bottom: 4px;
        }

        .chip-own {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #334155;
        }

        .chip-gap {
            background: #ffffff;
            border: 1px solid #94a3b8;
            color: #0f172a;
        }

        .empty {
            font-size: 8.5pt;
            color: #64748b;
            font-style: italic;
        }

        /* ============ RANK TABLE ============ */
        .rank-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #dbe3ee;
        }

        .rank-table th {
            background: #1e293b;
            color: #ffffff;
            font-size: 8pt;
            font-weight: 600;
            letter-spacing: .4px;
            padding: 7px 10px;
            text-align: left;
        }

        .rank-table td {
            padding: 7px 10px;
            border-bottom: 1px solid #eef2f7;
            font-size: 9pt;
            color: #1f2937;
        }

        .rank-table tr:nth-child(even) td {
            background: #f8fafc;
        }

        .rank-table tr:last-child td {
            border-bottom: none;
        }

        .rank-no {
            width: 34px;
            color: #64748b;
        }

        .rank-name {
            font-weight: 700;
            color: #0f172a;
        }

        .best-tag {
            display: inline-block;
            font-size: 6.5pt;
            font-weight: 700;
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            border-radius: 3px;
            padding: 1px 6px;
            margin-left: 6px;
            vertical-align: middle;
        }

        .rank-score {
            width: 80px;
            text-align: right;
            font-weight: 700;
            color: #0f172a;
        }

        .rank-level {
            width: 130px;
            text-align: right;
            font-weight: 600;
        }

        .lv-hi {
            color: #166534;
        }

        .lv-mid {
            color: #b45309;
        }

        .lv-low {
            color: #b91c1c;
        }

        /* ============ ALTERNATIVE CAREER ============ */
        .alt-card {
            border: 1px solid #e2e8f0;
            border-left: 3px solid #64748b;
            border-radius: 5px;
            padding: 10px 14px;
            margin-bottom: 8px;
        }

        .alt-head {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        .alt-head td {
            padding: 0;
            vertical-align: middle;
        }

        .alt-name {
            font-size: 10pt;
            font-weight: 700;
            color: #0f172a;
        }

        .alt-score {
            text-align: right;
            font-size: 9pt;
            font-weight: 700;
            color: #1e293b;
        }

        .alt-sub {
            font-size: 7pt;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .8px;
            margin: 6px 0 2px;
        }

        /* ============ ROADMAP TABLE ============ */
        .roadmap-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #dbe3ee;
        }

        .roadmap-table th {
            background: #1e293b;
            color: #ffffff;
            font-size: 8pt;
            font-weight: 600;
            letter-spacing: .4px;
            padding: 7px 12px;
            text-align: left;
        }

        .roadmap-table td {
            padding: 7px 12px;
            border-bottom: 1px solid #eef2f7;
            font-size: 9pt;
            color: #1f2937;
        }

        .roadmap-table tr:nth-child(even) td {
            background: #f8fafc;
        }

        .roadmap-table tr:last-child td {
            border-bottom: none;
        }

        .week-label {
            font-weight: 700;
            color: #1e293b;
            white-space: nowrap;
        }

        .roadmap-empty {
            text-align: center;
            padding: 12px;
        }

        /* ============ CONCLUSION ============ */
        .conclusion {
            border: 1px solid #e2e8f0;
            border-left: 4px solid #1e293b;
            border-radius: 4px;
            padding: 11px 16px;
            font-size: 9pt;
            line-height: 1.65;
            color: #334155;
            background: #fcfcfd;
        }

        /* ============ SIGNATURE & FOOTER ============ */
        .signature {
            margin-top: 24px;
            page-break-inside: avoid;
        }

        .sig-name {
            font-size: 10.5pt;
            font-weight: 700;
            color: #0f172a;
        }

        .sig-role {
            font-size: 8pt;
            color: #64748b;
        }

        .footer-note {
            margin-top: 14px;
            padding-top: 9px;
            border-top: 1px solid #cbd5e1;
            font-size: 7.5pt;
            color: #64748b;
            text-align: center;
        }

        .footer-note b {
            color: #334155;
        }
    </style>
</head>

<body>
    @php
        $logoPath = public_path('images/careermate-logo.png');
        $logoData = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : null;
        $updatedAt = $analysis->updated_at?->locale('id')->translatedFormat('d F Y');
        $score = (int) round($analysis->match_score ?? 0);
        $skills = collect($analysis->skills_json ?? [])->map(fn ($s) => is_array($s) ? $s['name'] : $s);
        $user = $analysis->user;
        $matches = $analysis->careerMatches;
        $best = $analysis->career;
        $reportNo = 'RPT-CM-' . str_pad($analysis->id, 4, '0', STR_PAD_LEFT) . '/' . ($analysis->created_at?->year ?? date('Y'));

        $levelOf = function ($s) {
            if ($s >= 80) {
                return 'Sangat Tinggi';
            }
            if ($s >= 60) {
                return 'Tinggi';
            }
            if ($s >= 40) {
                return 'Sedang';
            }
            return 'Perlu Ditingkatkan';
        };
        $levelClass = function ($s) {
            if ($s >= 60) {
                return 'lv-hi';
            }
            if ($s >= 40) {
                return 'lv-mid';
            }
            return 'lv-low';
        };
    @endphp

    <!-- Masthead -->
    <table class="masthead">
        <tr>
            <td class="mh-logo">
                <div class="logo-box">
                    @if ($logoData)
                        <img src="data:image/png;base64,{{ $logoData }}" alt="CareerMate">
                    @else
                        <span class="logo-fallback">CM</span>
                    @endif
                </div>
            </td>
            <td>
                <div class="brand-name">CareerMate</div>
                <div class="brand-sub">Pusat Pengembangan Karir Mahasiswa</div>
            </td>
            <td class="mh-meta">
                <div class="meta-line"><span class="k">No. Laporan</span><span class="v">{{ $reportNo }}</span></div>
                <div class="meta-line"><span class="k">Tanggal Terbit</span><span class="v">{{ $updatedAt ?? '—' }}</span></div>
                <div class="meta-line"><span class="k">Status</span><span class="v">Final</span></div>
            </td>
        </tr>
    </table>

    <!-- Document title -->
    <div class="doc-title">
        <h1>LAPORAN HASIL ANALISIS CV</h1>
        <p>Dokumen ini merupakan hasil pemetaan kualifikasi, keterampilan, dan kesesuaian karir berdasarkan berkas CV.</p>
    </div>

    <!-- I. Data Analisis -->
    <div class="section">
        <div class="sec-head"><span class="sec-no">I</span><span class="sec-title">Data Analisis</span></div>
        <table class="info-table">
            <tr>
                <td class="k">Nama Mahasiswa</td>
                <td class="v">{{ $user->name ?? '—' }}</td>
            </tr>
            <tr>
                <td class="k">Email</td>
                <td class="v">{{ $user->email ?? '—' }}</td>
            </tr>
            <tr>
                <td class="k">Berkas CV</td>
                <td class="v">{{ $analysis->cvFile->file_name ?? '—' }}</td>
            </tr>
            <tr>
                <td class="k">Tanggal Analisis</td>
                <td class="v">{{ $analysis->created_at?->locale('id')->translatedFormat('d F Y H:i') ?? '—' }}</td>
            </tr>
        </table>
    </div>

    <!-- II. Hasil Rekomendasi Utama -->
    <div class="section">
        <div class="sec-head"><span class="sec-no">II</span><span class="sec-title">Hasil Rekomendasi Utama</span></div>
        <div class="result-card">
            <table class="result-table">
                <tr>
                    <td class="score-cell">
                        <div class="score-num">{{ $score }}%</div>
                        <div class="score-cap">Skor Kecocokan</div>
                    </td>
                    <td class="career-cell">
                        <div class="career-role">Rekomendasi Karir Utama</div>
                        <div class="career-name">{{ $best->title ?? 'Belum ada rekomendasi' }}</div>
                        @if (!empty($best->description))
                            <div class="career-desc">{{ $best->description }}</div>
                        @endif
                        <div class="progress-track">
                            <div class="progress-fill" style="width: {{ $score }}%;"></div>
                        </div>
                        <table class="progress-cap">
                            <tr>
                                <td>Tingkat Kecocokan: {{ $levelOf($score) }}</td>
                                <td class="r">{{ $score }}%</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- III. Keterampilan Terdeteksi -->
    <div class="section">
        <div class="sec-head"><span class="sec-no">III</span><span class="sec-title">Keterampilan Terdeteksi</span></div>
        <div class="chip-box">
            @forelse ($skills as $skill)
                <span class="chip chip-own">{{ $skill }}</span>
            @empty
                <p class="empty">Belum ada keterampilan yang terdeteksi dalam berkas CV.</p>
            @endforelse
        </div>
    </div>

    <!-- IV. Daftar Rekomendasi Karir -->
    <div class="section">
        <div class="sec-head"><span class="sec-no">IV</span><span class="sec-title">Daftar Rekomendasi Karir</span></div>
        <table class="rank-table">
            <thead>
                <tr>
                    <th style="width:34px;">No</th>
                    <th>Karir</th>
                    <th style="width:80px; text-align:right;">Skor</th>
                    <th style="width:130px; text-align:right;">Tingkat Kecocokan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($matches as $index => $m)
                    <tr>
                        <td class="rank-no">{{ $index + 1 }}</td>
                        <td class="rank-name">
                            {{ $m->career->title ?? '—' }}
                            @if ($m->is_best_match)
                                <span class="best-tag">Rekomendasi Utama</span>
                            @endif
                        </td>
                        <td class="rank-score">{{ (int) round($m->match_score ?? 0) }}%</td>
                        <td class="rank-level {{ $levelClass($m->match_score ?? 0) }}">
                            {{ $levelOf($m->match_score ?? 0) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="rank-no">1</td>
                        <td class="rank-name">{{ $best->title ?? '—' }}</td>
                        <td class="rank-score">{{ $score }}%</td>
                        <td class="rank-level {{ $levelClass($score) }}">{{ $levelOf($score) }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- V. Keterampilan yang Perlu Ditingkatkan -->
    <div class="section">
        <div class="sec-head"><span class="sec-no">V</span><span class="sec-title">Keterampilan yang Perlu Ditingkatkan</span></div>
        <p class="empty" style="margin-bottom:6px;">
            Untuk memenuhi kualifikasi sebagai <strong>{{ $best->title ?? 'karir utama' }}</strong>.
        </p>
        <div class="chip-box">
            @forelse ($analysis->skill_gap_json ?? [] as $gap)
                <span class="chip chip-gap">{{ $gap }}</span>
            @empty
                <p class="empty">Selamat, tidak ada keterampilan yang perlu ditingkatkan untuk karir utama.</p>
            @endforelse
        </div>
    </div>

    <!-- VI. Roadmap Pengembangan Karir Utama -->
    <div class="section">
        <div class="sec-head"><span class="sec-no">VI</span><span class="sec-title">Roadmap Pengembangan Karir Utama</span></div>
        <table class="roadmap-table">
            <thead>
                <tr>
                    <th style="width:130px;">Jangka Waktu</th>
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
                            <span class="empty">Belum ada roadmap pengembangan yang tersedia.</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- VII. Rekomendasi Karir Alternatif -->
    @if ($matches->count() > 1)
        <div class="section">
            <div class="sec-head"><span class="sec-no">VII</span><span class="sec-title">Rekomendasi Karir Alternatif</span></div>
            @foreach ($matches->skip(1)->take(4) as $m)
                <div class="alt-card">
                    <table class="alt-head">
                        <tr>
                            <td class="alt-name">{{ $m->career->title ?? '—' }}</td>
                            <td class="alt-score">{{ (int) round($m->match_score ?? 0) }}%</td>
                        </tr>
                    </table>
                    @if (($m->matched_skills_json ?? []) && is_array($m->matched_skills_json))
                        <div class="alt-sub">Keterampilan yang Dimiliki</div>
                        <div class="chip-box">
                            @foreach ($m->matched_skills_json as $skill)
                                <span class="chip chip-own">{{ $skill }}</span>
                            @endforeach
                        </div>
                    @endif
                    @if (($m->skill_gap_json ?? []) && is_array($m->skill_gap_json))
                        <div class="alt-sub">Keterampilan yang Perlu Ditingkatkan</div>
                        <div class="chip-box">
                            @foreach ($m->skill_gap_json as $gap)
                                <span class="chip chip-gap">{{ $gap }}</span>
                            @endforeach
                        </div>
                    @endif
                    @if (($m->roadmap_json ?? []) && is_array($m->roadmap_json))
                        <div class="alt-sub">Roadmap Pengembangan</div>
                        <table class="roadmap-table">
                            <thead>
                                <tr>
                                    <th style="width:130px;">Jangka Waktu</th>
                                    <th>Fokus Pembelajaran &amp; Target</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($m->roadmap_json as $step)
                                    <tr>
                                        <td><span class="week-label">Minggu {{ $step['week'] ?? '-' }}</span></td>
                                        <td>{{ $step['topic'] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <!-- VIII. Kesimpulan -->
    @if ($analysis->ai_summary)
        <div class="section">
            <div class="sec-head"><span class="sec-no">VIII</span><span class="sec-title">Kesimpulan &amp; Rekomendasi</span></div>
            <div class="conclusion">
                {{ $analysis->ai_summary }}
            </div>
        </div>
    @endif

    <!-- Signature -->
    <div class="signature">
        <div class="sig-name">CareerMate</div>
        <div class="sig-role">Pusat Pengembangan Karir Mahasiswa</div>
    </div>

    <!-- Footer -->
    <div class="footer-note">
        Dokumen ini dihasilkan secara otomatis oleh sistem <b>CareerMate</b>. Nomor laporan
        <b>{{ $reportNo }}</b> digunakan sebagai referensi penelusuran arsip.
    </div>

</body>

</html>
