<template>
    <div class="container mx-auto px-4 py-8 max-w-5xl">
        <!-- Top Bar Hero -->
        <StudentHero compact>
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4"
            >
                <div>
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/10 backdrop-blur-md text-indigo-200 text-[11px] font-semibold uppercase tracking-widest mb-3"
                    >
                        <svg
                            class="w-3.5 h-3.5 text-amber-300 animate-pulse"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"
                            />
                        </svg>
                        <span>Laporan Hasil AI Resume Analysis</span>
                    </div>
                    <h1
                        class="text-2xl md:text-3xl font-bold text-white"
                    >
                        Hasil Analisis CV Kamu
                    </h1>
                    <p class="mt-1.5 text-sm text-indigo-200/80 max-w-md">
                        Ringkasan kecocokan karier, skill, dan rekomendasi
                        roadmap dari analisis CV terakhir.
                    </p>
                </div>
                <span
                    class="shrink-0 text-xs text-indigo-200/70 font-medium"
                    >Diperbarui: {{ currentDate }}</span
                >
            </div>
        </StudentHero>

        <!-- Header: Score Ring + Mini Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
            <!-- Ring Score Card -->
            <div
                class="md:col-span-2 bg-white rounded-2xl border border-slate-100 p-5 sm:p-6 shadow-sm flex items-center gap-6 relative overflow-hidden"
            >
                <div
                    class="relative shrink-0 h-20 w-20 flex items-center justify-center"
                >
                    <svg
                        viewBox="0 0 72 72"
                        class="h-20 w-20 -rotate-90 transform"
                    >
                        <circle
                            cx="36"
                            cy="36"
                            r="30"
                            fill="none"
                            stroke="#F1F5F9"
                            stroke-width="6"
                        />
                        <circle
                            cx="36"
                            cy="36"
                            r="30"
                            fill="none"
                            stroke="#4F46E5"
                            stroke-width="6"
                            stroke-linecap="round"
                            :stroke-dasharray="strokeDasharray"
                            :stroke-dashoffset="strokeDashoffset"
                            class="transition-all duration-1000 ease-out"
                        />
                    </svg>
                    <span
                        class="absolute inset-0 flex items-center justify-center text-lg font-bold text-slate-800"
                    >
                        {{ matchScore }}%
                    </span>
                </div>

                <div class="min-w-0 flex-1">
                    <p
                        class="text-xs font-semibold text-slate-400 uppercase tracking-wider"
                    >
                        Peran Paling Cocok
                    </p>
                    <h1
                        class="text-xl sm:text-2xl font-bold text-slate-800 mt-0.5 truncate"
                    >
                        {{ topCareer.title }}
                    </h1>
                    <div class="mt-2.5 flex items-center gap-2">
                        <span
                            class="text-xs font-semibold px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60 inline-flex items-center gap-1.5"
                        >
                            <span
                                class="h-1.5 w-1.5 rounded-full bg-emerald-500"
                            ></span>
                            Kecocokan Sangat Tinggi
                        </span>
                    </div>
                </div>
            </div>

            <!-- Quick Metrics -->
            <div
                class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm flex flex-col justify-center gap-3"
            >
                <div class="flex items-center justify-between text-xs">
                    <span class="text-slate-500 font-medium"
                        >Skill Dikuasai</span
                    >
                    <span
                        class="font-bold text-slate-800 bg-slate-100 px-2 py-0.5 rounded-md"
                        >{{ detectedSkills.length }}</span
                    >
                </div>
                <div class="flex items-center justify-between text-xs">
                    <span class="text-slate-500 font-medium"
                        >Skill Perlu Dipelajari</span
                    >
                    <span
                        class="font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-md"
                        >{{ gapSkills.length }}</span
                    >
                </div>
                <div class="flex items-center justify-between text-xs">
                    <span class="text-slate-500 font-medium"
                        >Estimasi Langkah Roadmap</span
                    >
                    <span
                        class="font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md"
                        >{{ roadmapSteps.length }} Langkah</span
                    >
                </div>
            </div>
        </div>

        <!-- Skill Terdeteksi, Skill Gap, Career Recommendation -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
            <!-- Skill Terdeteksi -->
            <div
                class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm flex flex-col justify-between"
            >
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <p
                            class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5"
                        >
                            <svg
                                class="h-4 w-4 text-emerald-500"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2.5"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                            Skill Terdeteksi
                        </p>
                        <span
                            class="text-[11px] text-emerald-600 font-semibold bg-emerald-50 px-2 py-0.5 rounded-md"
                            >Valid</span
                        >
                    </div>
                    <div class="flex flex-wrap gap-1.5">
                        <span
                            v-for="s in detectedSkills"
                            :key="s"
                            class="text-xs font-semibold px-3 py-1.5 rounded-xl bg-emerald-50/80 border border-emerald-100 text-emerald-800"
                        >
                            {{ s }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Skill Gap -->
            <div
                class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm flex flex-col justify-between"
            >
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <p
                            class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5"
                        >
                            <svg
                                class="h-4 w-4 text-amber-500"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"
                                />
                            </svg>
                            Skill Gap AI
                        </p>
                        <span
                            class="text-[11px] text-amber-600 font-semibold bg-amber-50 px-2 py-0.5 rounded-md"
                            >Perlu Dipelajari</span
                        >
                    </div>
                    <div class="flex flex-wrap gap-1.5">
                        <span
                            v-for="s in gapSkills"
                            :key="s"
                            class="text-xs font-semibold px-3 py-1.5 rounded-xl bg-amber-50/80 border border-amber-100 text-amber-800"
                        >
                            {{ s }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Career Recommendation -->
            <div
                class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm"
            >
                <p
                    class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-3.5 flex items-center justify-between"
                >
                    <span>Rekomendasi Karir</span>
                    <span class="text-[10px] text-indigo-600 font-semibold"
                        >AI Ranked</span
                    >
                </p>
                <div class="space-y-3">
                    <div
                        v-for="(c, i) in careers"
                        :key="c.title"
                        class="flex items-center gap-3"
                    >
                        <span
                            class="shrink-0 h-6 w-6 rounded-lg text-xs font-bold flex items-center justify-center"
                            :class="
                                i === 0
                                    ? 'bg-indigo-600 text-white shadow-sm'
                                    : 'bg-slate-100 text-slate-500'
                            "
                        >
                            {{ i + 1 }}
                        </span>
                        <div class="flex-1 min-w-0">
                            <div
                                class="flex justify-between text-xs font-medium mb-1"
                            >
                                <span class="text-slate-700 truncate">{{
                                    c.title
                                }}</span>
                                <span class="text-slate-500 font-bold shrink-0"
                                    >{{ c.score }}%</span
                                >
                            </div>
                            <div
                                class="h-1.5 bg-slate-100 rounded-full overflow-hidden"
                            >
                                <div
                                    class="h-full rounded-full transition-all duration-500"
                                    :class="
                                        i === 0
                                            ? 'bg-indigo-600'
                                            : 'bg-slate-300'
                                    "
                                    :style="{ width: c.score + '%' }"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Internship + Roadmap AI -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
            <!-- Internship Recommendation (2 cols) -->
            <div
                class="md:col-span-2 bg-white rounded-2xl border border-slate-100 p-5 shadow-sm"
            >
                <p
                    class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-3.5"
                >
                    Rekomendasi Tempat Magang
                </p>
                <div class="flex flex-col gap-2">
                    <a
                        v-for="company in internships"
                        :key="company"
                        href="#"
                        class="flex items-center justify-between p-3 bg-slate-50 hover:bg-indigo-50/50 rounded-xl border border-slate-100 hover:border-indigo-100 text-xs font-medium text-slate-700 hover:text-indigo-700 transition group"
                    >
                        <span>{{ company }}</span>
                        <svg
                            class="h-4 w-4 text-slate-400 group-hover:text-indigo-600 transition"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                            />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Roadmap AI (3 cols) -->
            <div
                class="md:col-span-3 bg-white rounded-2xl border border-slate-100 p-5 shadow-sm"
            >
                <div class="flex items-center justify-between mb-3.5">
                    <p
                        class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5"
                    >
                        <svg
                            class="w-3.5 h-3.5 text-indigo-600"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"
                            />
                        </svg>
                        Roadmap Pengembangan AI
                    </p>
                    <span class="text-[10px] text-slate-400"
                        >Langkah yang Disarankan</span
                    >
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                    <div
                        v-for="(step, i) in roadmapSteps"
                        :key="step"
                        class="flex items-start gap-2.5 p-3 bg-slate-50 border border-slate-100 rounded-xl"
                    >
                        <span
                            class="h-5 w-5 mt-0.5 rounded-lg bg-indigo-600 text-white text-[11px] font-bold flex items-center justify-center shrink-0 shadow-sm"
                        >
                            {{ i + 1 }}
                        </span>
                        <span
                            class="text-xs font-semibold text-slate-700 leading-snug"
                            >{{ step }}</span
                        >
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-3">
            <button
                @click="downloadPdf"
                class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-slate-300 bg-white text-slate-700 text-xs font-semibold hover:bg-slate-50 transition active:scale-95 shadow-sm"
            >
                <svg
                    class="h-4 w-4 text-slate-500"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3"
                    />
                </svg>
                Download Laporan (PDF)
            </button>
            <button
                @click="reuploadCv"
                class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold transition active:scale-95 shadow-md shadow-indigo-500/20"
            >
                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
                    />
                </svg>
                Upload CV Baru
            </button>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";
import StudentHero from "@/components/student/StudentHero.vue";

const currentDate = "04 Agustus 2026";

const detectedSkills = ["PHP", "Laravel", "MySQL", "Git", "Docker"];
const gapSkills = ["Vue.js", "REST API", "Testing"];

const careers = [
    { title: "Backend Developer", score: 95 },
    { title: "Fullstack Developer", score: 90 },
    { title: "Software Engineer", score: 87 },
];

const internships = [
    "PT Telkom Indonesia",
    "PT GITS Indonesia",
    "PT Astra Digital",
];

const roadmapSteps = [
    "Pelajari REST API Standards",
    "Belajar Dasar Containerization (Docker)",
    "Bangun Portofolio Aplikasi Backend",
    "Belajar Automated Testing (PHPUnit)",
];

// Top Career Computed
const topCareer = computed(() => careers[0]);
const matchScore = computed(() => topCareer.value.score);

// Dynamic Circular Progress Calculation
const strokeDasharray = 188; // 2 * PI * r (r=30 -> 188.49)
const strokeDashoffset = computed(() => {
    return strokeDasharray - (strokeDasharray * matchScore.value) / 100;
});

function downloadPdf() {
    alert("Mengunduh laporan hasil analisis AI...");
}

function reuploadCv() {
    // Logic navigasi ke halaman upload CV
    console.log("Kembali ke halaman upload");
}
</script>
