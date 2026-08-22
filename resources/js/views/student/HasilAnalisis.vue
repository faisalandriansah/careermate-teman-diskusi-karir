<template>
    <div
        v-if="loading || isProfileLoading"
        class="flex flex-col items-center justify-center py-24 gap-4"
    >
        <div class="loading-ring"></div>
        <p class="text-sm text-slate-400">Memuat hasil analisis...</p>
    </div>

    <EmptyState
        v-else-if="!isProfileComplete"
        icon="lock"
        title="Lengkapi Profil Dulu, Yuk!"
        description="Fitur hasil analisis akan terbuka setelah profil kamu lengkap. Lengkapi profil dulu supaya analisis CV-mu lebih akurat."
        :steps="[
            'Lengkapi biodata & detail profil',
            'Upload CV kamu',
            'Terima rekomendasi karier',
        ]"
        primary-label="Lengkapi Profil"
        :primary-to="{ name: 'StudentProfile' }"
    />

    <EmptyState
        v-else-if="isEmpty"
        icon="analysis"
        title="Belum Ada Hasil Analisis"
        description="Upload CV-mu sekarang untuk melihat kecocokan karier, keterampilan yang kamu miliki, dan langkah pengembangan selanjutnya."
        :steps="[
            'Upload CV kamu',
            'Profil & CV dianalisis',
            'Terima rekomendasi karier',
        ]"
        primary-label="Upload CV Sekarang"
        :primary-to="{ name: 'StudentCV' }"
        secondary-label="Lihat Riwayat Analisis"
        :secondary-to="{ name: 'StudentRiwayatAnalisis' }"
    />

    <div v-else-if="errorMessage" class="container mx-auto px-4 py-8 max-w-2xl">
        <div
            class="relative overflow-hidden rounded-2xl bg-white border border-slate-100 shadow-sm"
        >
            <div class="px-6 py-12 flex flex-col items-center text-center">
                <div
                    class="h-14 w-14 rounded-xl bg-rose-50 border border-rose-100 flex items-center justify-center mb-5"
                >
                    <svg
                        class="h-7 w-7 text-rose-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v3.75m0 3.75h.008v.008H12v-.008zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-slate-800">
                    Gagal Memuat Hasil Analisis
                </h2>
                <p class="mt-2 max-w-sm text-sm text-slate-500">
                    {{ errorMessage }}
                </p>
                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <button
                        type="button"
                        @click="loadAnalysis"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold transition active:scale-95 shadow-md shadow-blue-600/25"
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
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                            />
                        </svg>
                        Coba Lagi
                    </button>
                    <router-link
                        :to="{ name: 'StudentCV' }"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs font-semibold hover:bg-slate-50 transition active:scale-95 shadow-sm"
                    >
                        Kembali ke Upload CV
                    </router-link>
                </div>
            </div>
        </div>
    </div>

    <div v-else class="container mx-auto px-4 py-8 max-w-5xl">
        <!-- Header -->
        <StudentHero compact>
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4"
            >
                <div>
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/10 backdrop-blur-md text-blue-200 text-[11px] font-semibold uppercase tracking-widest mb-3"
                    >
                        <svg
                            class="w-3.5 h-3.5 text-amber-300"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"
                            />
                        </svg>
                        <span>Hasil Analisis CV</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white">
                        Rekomendasi Karir Kamu
                    </h1>
                    <p class="mt-1.5 text-sm text-blue-200/80 max-w-md">
                        Berdasarkan keterampilan di CV-mu, berikut karir yang
                        paling cocok dan langkah yang bisa kamu ambil
                        selanjutnya.
                    </p>
                </div>
                <button
                    @click="downloadPdf"
                    :disabled="downloading"
                    class="shrink-0 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-white/10 hover:bg-white/20 border border-white/10 backdrop-blur-md text-white text-xs font-semibold transition active:scale-95 disabled:opacity-60 disabled:cursor-not-allowed"
                >
                    <svg
                        v-if="downloading"
                        class="h-4 w-4 animate-spin text-blue-100"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"
                        ></circle>
                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                        ></path>
                    </svg>
                    <svg
                        v-else
                        class="h-4 w-4 text-blue-100"
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
                    {{
                        downloading
                            ? "Menyiapkan Laporan..."
                            : "Download Laporan"
                    }}
                </button>
            </div>
        </StudentHero>

        <!-- Karir Paling Sesuai -->
        <div
            v-if="topCareer.title"
            class="bg-white rounded-2xl border border-slate-100 p-6 sm:p-8 shadow-sm mb-6"
        >
            <div
                class="flex flex-col md:flex-row md:items-center gap-6 md:gap-8"
            >
                <div class="flex-1 min-w-0">
                    <span
                        class="inline-flex items-center gap-1.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400"
                    >
                        <svg
                            class="h-3.5 w-3.5 text-blue-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                            />
                        </svg>
                        Karir Paling Sesuai
                    </span>
                    <h2
                        class="text-2xl sm:text-3xl font-bold text-slate-900 mt-2 truncate"
                    >
                        {{ topCareer.title }}
                    </h2>
                    <div class="mt-3 flex flex-wrap items-center gap-2">
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-[11px] font-semibold"
                            :class="matchBadgeClass"
                        >
                            <span
                                class="h-1.5 w-1.5 rounded-full"
                                :class="matchDotClass"
                            ></span>
                            {{ matchLabel }}
                        </span>
                    </div>
                    <p
                        class="mt-3 text-sm text-slate-500 leading-relaxed max-w-md"
                    >
                        Peran ini paling sesuai dengan keterampilan yang kamu
                        miliki. Lihat langkah-langkah yang bisa kamu ambil untuk
                        terus berkembang di karir ini.
                    </p>
                    <button
                        v-if="bestCareerId"
                        @click="goToTarget(bestCareerId)"
                        class="mt-5 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold transition active:scale-95 shadow-sm shadow-blue-600/20"
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
                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l5-2.5m-5 2.5v-13m5 10.5l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L19 6M14 17.5v-13"
                            />
                        </svg>
                        Lihat Roadmap Karir
                        <svg
                            class="h-3.5 w-3.5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"
                            />
                        </svg>
                    </button>
                </div>

                <div class="shrink-0 mx-auto md:mx-0">
                    <div
                        class="relative h-28 w-28 flex items-center justify-center"
                    >
                        <svg
                            viewBox="0 0 72 72"
                            class="h-28 w-28 -rotate-90 transform"
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
                                stroke="#2563eb"
                                stroke-width="6"
                                stroke-linecap="round"
                                :stroke-dasharray="ringCircumference"
                                :stroke-dashoffset="ringOffset"
                                class="transition-all duration-1000 ease-out"
                            />
                        </svg>
                        <span
                            class="absolute inset-0 flex flex-col items-center justify-center"
                        >
                            <span class="text-2xl font-bold text-slate-800">
                                {{ scoreDisplay }}
                            </span>
                            <span class="text-[10px] text-slate-400">
                                kecocokan
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Karir Lain yang Cocok -->
        <div
            v-if="otherMatches.length"
            class="bg-white rounded-2xl border border-slate-100 p-5 sm:p-6 shadow-sm mb-6"
        >
            <div class="mb-4">
                <h3
                    class="text-sm font-bold text-slate-800 flex items-center gap-2"
                >
                    <svg
                        class="h-4 w-4 text-blue-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16"
                        />
                    </svg>
                    Karir Lain yang Cocok
                </h3>
                <p class="text-[11px] text-slate-400 mt-0.5">
                    Klik salah satu untuk melihat detail dan roadmap
                    pengembangan.
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                <button
                    v-for="m in otherMatches"
                    :key="m.career_id"
                    @click="goToTarget(m.career_id)"
                    class="flex items-center gap-3 p-3.5 bg-slate-50 hover:bg-blue-50/50 border border-slate-100 hover:border-blue-200 rounded-xl transition text-left group"
                >
                    <div class="flex-1 min-w-0">
                        <p
                            class="text-sm font-semibold text-slate-800 truncate"
                        >
                            {{ m.career?.title ?? "Karir" }}
                        </p>
                        <p class="text-[11px] text-slate-400 mt-0.5">
                            Kecocokan
                            <span
                                class="font-bold"
                                :class="scoreColor(m.match_score)"
                            >
                                {{ Math.round(m.match_score) }}%
                            </span>
                        </p>
                    </div>
                    <span
                        class="shrink-0 text-xs font-bold px-2.5 py-1 rounded-lg"
                        :class="scoreBadgeClass(m.match_score)"
                    >
                        {{ Math.round(m.match_score) }}%
                    </span>
                    <svg
                        class="h-4 w-4 shrink-0 text-slate-300 group-hover:text-blue-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Keterampilan -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div
                class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm"
            >
                <p
                    class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5 mb-3"
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
                    Keterampilan Terdeteksi
                </p>
                <p class="text-[11px] text-slate-400 mb-3 -mt-1.5">
                    Keterampilan yang ditemukan dari CV-mu.
                </p>
                <div
                    v-if="detectedSkills.length"
                    class="flex flex-wrap gap-1.5"
                >
                    <span
                        v-for="s in detectedSkills"
                        :key="s"
                        class="text-xs font-semibold px-3 py-1.5 rounded-xl bg-emerald-50/80 border border-emerald-100 text-emerald-800"
                    >
                        {{ s }}
                    </span>
                </div>
                <p v-else class="text-[11px] text-slate-400 italic">
                    Belum ada keterampilan yang terdeteksi.
                </p>
            </div>

            <div
                class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm"
            >
                <p
                    class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5 mb-3"
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
                    Perlu Dipelajari
                </p>
                <p class="text-[11px] text-slate-400 mb-3 -mt-1.5">
                    Keterampilan yang belum kamu kuasai untuk peran
                    <span class="font-semibold text-slate-500">{{
                        topCareer.title
                    }}</span
                    >.
                </p>
                <div v-if="gapSkills.length" class="flex flex-wrap gap-1.5">
                    <span
                        v-for="s in gapSkills"
                        :key="s"
                        class="text-xs font-semibold px-3 py-1.5 rounded-xl bg-amber-50/80 border border-amber-100 text-amber-800"
                    >
                        {{ s }}
                    </span>
                </div>
                <p v-else class="text-[11px] text-slate-400 italic">
                    Selamat! Tidak ada keterampilan yang perlu dipelajari untuk
                    peran ini.
                </p>
            </div>
        </div>

        <!-- Roadmap & Ringkasan (data lama / best match) -->
        <div
            v-if="hasRoadmap || aiSummary"
            class="bg-white rounded-2xl border border-slate-100 p-5 sm:p-6 shadow-sm mb-6"
        >
            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 sm:gap-3 mb-4"
            >
                <h3 class="text-sm font-bold text-slate-800">
                    Roadmap Pengembangan
                </h3>
                <span
                    class="text-[11px] text-slate-400 shrink-0 whitespace-nowrap"
                    >untuk {{ topCareer.title }}</span
                >
            </div>

            <div
                v-if="roadmapSteps.length"
                class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 sm:gap-3 mb-4"
            >
                <div
                    v-for="(step, i) in roadmapSteps"
                    :key="step"
                    class="flex items-start gap-2.5 p-3 bg-slate-50 border border-slate-100 rounded-xl min-w-0"
                >
                    <span
                        class="h-5 w-5 mt-0.5 rounded-lg bg-blue-600 text-white text-[11px] font-bold flex items-center justify-center shrink-0 shadow-sm"
                    >
                        {{ i + 1 }}
                    </span>
                    <span
                        class="text-xs font-semibold text-slate-700 leading-snug min-w-0 flex-1 break-words"
                        >{{ step }}</span
                    >
                </div>
            </div>

            <div v-if="aiSummary">
                <p
                    class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2"
                >
                    Ringkasan
                </p>
                <p class="text-sm text-slate-600 leading-relaxed">
                    {{ aiSummary }}
                </p>
            </div>
        </div>

        <!-- Rekomendasi Magang -->
        <div
            v-if="internships.length"
            class="bg-white rounded-2xl border border-slate-100 p-5 sm:p-6 shadow-sm mb-6"
        >
            <div class="mb-3.5">
                <h3 class="text-sm font-bold text-slate-800">
                    Rekomendasi Tempat Magang
                </h3>
                <p class="text-[11px] text-slate-400 mt-0.5">
                    Internship yang relevan dengan
                    <span class="font-semibold text-slate-500">{{
                        topCareer.title
                    }}</span
                    >.
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div
                    v-for="job in internships"
                    :key="job.id"
                    class="p-4 rounded-xl border border-slate-100 bg-slate-50/50"
                >
                    <p class="text-sm font-semibold text-slate-800">
                        {{ job.position }}
                    </p>
                    <p class="text-xs text-slate-500 mt-0.5">
                        {{ job.company_name }}
                    </p>

                    <p
                        v-if="job.location"
                        class="text-xs text-slate-400 mt-0.5"
                    >
                        {{ job.location }}
                    </p>

                    <a
                        v-if="job.application_url"
                        :href="job.application_url"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-1 mt-3 text-xs font-semibold text-blue-600 hover:text-blue-700"
                    >
                        Daftar Internship
                        <svg
                            class="h-3.5 w-3.5"
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
                    <span
                        v-else
                        class="inline-block mt-3 text-xs text-slate-400"
                    >
                        Info internship
                    </span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="no-print flex flex-col sm:flex-row gap-3">
            <button
                @click="reuploadCv"
                class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold transition active:scale-95 shadow-md shadow-blue-600/20"
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
import { ref, computed, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import StudentHero from "@/components/student/StudentHero.vue";
import EmptyState from "@/components/student/EmptyState.vue";
import analysisService from "@/services/student/analysisService";
import apiClient from "@/services/api";

const route = useRoute();
const router = useRouter();
const authStore = useAuthStore();
const analysisId = route.params.id;
const resolvedId = computed(() => analysis.value?.id ?? analysisId);

const loading = ref(true);
const isProfileLoading = ref(false);
const isProfileComplete = computed(() => authStore.isProfileComplete);
const errorMessage = ref("");
const isEmpty = ref(false);
const analysis = ref(null);
const careerMatches = ref([]);

const detectedSkills = computed(() =>
    (analysis.value?.skills_json ?? []).map((s) =>
        typeof s === "string" ? s : s.name,
    ),
);

const bestMatch = computed(() => careerMatches.value[0] ?? null);

const topCareer = computed(() => ({
    title:
        bestMatch.value?.career?.title ??
        analysis.value?.career?.title ??
        "Belum ada rekomendasi",
}));

const internships = computed(
    () =>
        bestMatch.value?.career?.internships ??
        analysis.value?.career?.internships ??
        [],
);

const bestCareerId = computed(
    () => bestMatch.value?.career_id ?? analysis.value?.career_id,
);

const matchScore = computed(
    () => bestMatch.value?.match_score ?? analysis.value?.match_score ?? 0,
);

const gapSkills = computed(
    () =>
        bestMatch.value?.skill_gap_json ?? analysis.value?.skill_gap_json ?? [],
);

const otherMatches = computed(() => careerMatches.value.slice(1));

const roadmapSteps = computed(() =>
    (analysis.value?.roadmap_json ?? []).map((r) => r.topic),
);
const aiSummary = computed(() => analysis.value?.ai_summary ?? "");
const hasRoadmap = computed(() => roadmapSteps.value.length > 0);

const RING_RADIUS = 30;
const RING_CIRCUMFERENCE = 2 * Math.PI * RING_RADIUS;

const scoreDisplay = computed(() => `${Math.round(matchScore.value)}%`);

const ringCircumference = computed(() => RING_CIRCUMFERENCE);

const ringOffset = computed(() => {
    const score = Math.min(Math.max(matchScore.value, 0), 100);
    return RING_CIRCUMFERENCE - (score / 100) * RING_CIRCUMFERENCE;
});

const matchLabel = computed(() => {
    const score = Math.round(matchScore.value);
    if (score >= 80) return "Kecocokan Sangat Tinggi";
    if (score >= 60) return "Kecocokan Tinggi";
    if (score >= 40) return "Kecocokan Sedang";
    return "Kecocokan Perlu Ditingkatkan";
});

const matchBadgeClass = computed(() => {
    const score = matchScore.value;
    if (score >= 80)
        return "bg-emerald-50 text-emerald-700 border-emerald-200/60";
    if (score >= 60) return "bg-blue-50 text-blue-700 border-blue-200/60";
    if (score >= 40) return "bg-amber-50 text-amber-700 border-amber-200/60";
    return "bg-rose-50 text-rose-700 border-rose-200/60";
});

const matchDotClass = computed(() => {
    const score = matchScore.value;
    if (score >= 80) return "bg-emerald-500";
    if (score >= 60) return "bg-blue-500";
    if (score >= 40) return "bg-amber-500";
    return "bg-rose-500";
});

function scoreColor(score) {
    if (score >= 80) return "text-emerald-600";
    if (score >= 60) return "text-blue-600";
    if (score >= 40) return "text-amber-600";
    return "text-rose-600";
}

function scoreBadgeClass(score) {
    if (score >= 80)
        return "bg-emerald-50 text-emerald-700 border border-emerald-100";
    if (score >= 60) return "bg-blue-50 text-blue-700 border border-blue-100";
    if (score >= 40)
        return "bg-amber-50 text-amber-700 border border-amber-100";
    return "bg-rose-50 text-rose-700 border border-rose-100";
}

function goToTarget(careerId) {
    router.push({
        name: "StudentTargetDetail",
        params: { id: resolvedId.value, careerId },
    });
}

async function loadAnalysis() {
    loading.value = true;
    errorMessage.value = "";
    isEmpty.value = false;
    try {
        const routeId = route.params.id;

        // Jalankan ambil data analisis & daftar karir secara paralel
        // (dulu berurutan → 2x lambat karena server mesti balas 2 request).
        const analysisPromise = routeId
            ? analysisService.getResult(routeId)
            : analysisService.getLatest();
        const matchesPromise = routeId
            ? analysisService.getCareerMatches(routeId).catch(() => ({}))
            : null;

        const result = await analysisPromise;
        analysis.value = result.data;

        if (matchesPromise) {
            const matches = await matchesPromise;
            careerMatches.value = matches.data ?? [];
        } else {
            const resolvedId = analysis.value?.id;
            if (resolvedId) {
                try {
                    const matches =
                        await analysisService.getCareerMatches(resolvedId);
                    careerMatches.value = matches.data ?? [];
                } catch (e) {
                    careerMatches.value = [];
                }
            }
        }
    } catch (err) {
        if (err.response?.status === 404) {
            isEmpty.value = true;
        } else {
            errorMessage.value =
                err.response?.data?.message ?? "Gagal memuat hasil analisis.";
        }
    } finally {
        loading.value = false;
    }
}

onMounted(async () => {
    // Profil sudah disegarkan oleh StudentLayout (fetchMe), jadi cukup muat data analisis.
    await loadAnalysis();
});

const downloading = ref(false);

async function downloadPdf() {
    if (downloading.value) return;
    const id = analysis.value?.id;
    if (!id) {
        alert("Data analisis belum tersedia.");
        return;
    }

    downloading.value = true;
    try {
        const response = await apiClient.get(`student/analysis/${id}/pdf`, {
            responseType: "blob",
        });

        const url = window.URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement("a");
        link.href = url;
        link.setAttribute("download", `hasil-analisis-${id}.pdf`);
        document.body.appendChild(link);
        link.click();
        link.remove();
        window.URL.revokeObjectURL(url);
    } catch (err) {
        alert("Gagal mengunduh PDF. Silakan coba lagi.");
    } finally {
        downloading.value = false;
    }
}

function reuploadCv() {
    router.push({ name: "StudentCV" });
}
</script>

<style scoped>
.loading-ring {
    height: 44px;
    width: 44px;
    border-radius: 9999px;
    border: 3px solid #e2e8f0;
    border-top-color: #2563eb;
    animation: loadingSpin 0.8s linear infinite;
}

@keyframes loadingSpin {
    to {
        transform: rotate(360deg);
    }
}

@media (prefers-reduced-motion: reduce) {
    .loading-ring {
        animation-duration: 2s;
    }
}
</style>
