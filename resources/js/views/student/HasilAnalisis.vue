<template>
    <div v-if="loading" class="flex items-center justify-center py-24">
        <p class="text-sm text-slate-400">Memuat hasil analisis...</p>
    </div>

    <div
        v-else-if="errorMessage"
        class="flex flex-col items-center justify-center py-24 gap-3"
    >
        <p class="text-sm text-rose-500">{{ errorMessage }}</p>
        <button
            @click="router.push({ name: 'StudentCV' })"
            class="text-sm text-blue-600 underline"
        >
            Kembali ke Upload CV
        </button>
    </div>

    <div v-else class="container mx-auto px-4 py-8 max-w-5xl">
        <!-- Top Bar Hero -->
        <StudentHero compact>
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4"
            >
                <div>
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/10 backdrop-blur-md text-blue-200 text-[11px] font-semibold uppercase tracking-widest mb-3"
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
                    <h1 class="text-2xl md:text-3xl font-bold text-white">
                        Hasil Analisis CV Kamu
                    </h1>
                    <p class="mt-1.5 text-sm text-blue-200/80 max-w-md">
                        Ringkasan kecocokan karier, skill, dan rekomendasi
                        roadmap dari analisis CV terakhir.
                    </p>
                </div>
                <span class="shrink-0 text-xs text-blue-200/70 font-medium"
                    >Diperbarui: {{ currentDate }}</span
                >
            </div>
        </StudentHero>

        <!-- Header: Score Ring + Mini Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
            <!-- Ring Score Card -->
            <div
                class="md:col-span-2 bg-white rounded-2xl border border-slate-100 p-5 sm:p-6 shadow-sm flex items-center gap-4 sm:gap-6 relative overflow-hidden"
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
                            stroke="#2563eb"
                            stroke-width="6"
                            stroke-linecap="round"
                            :stroke-dasharray="ringCircumference"
                            :stroke-dashoffset="ringOffset"
                            class="transition-all duration-1000 ease-out"
                        />
                    </svg>
                    <span
                        class="absolute inset-0 flex items-center justify-center font-bold text-slate-800"
                        :class="scoreTextClass"
                    >
                        {{ scoreDisplay }}
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
                        class="font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md"
                        >{{ roadmapSteps.length }} Langkah</span
                    >
                </div>
            </div>
        </div>

        <!-- Skill Terdeteksi & Skill Gap (Career Recommendation DIHAPUS) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
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
        </div>

        <!-- Roadmap AI (Internship DIHAPUS, sekarang full width) -->
        <div class="grid grid-cols-1 gap-4 mb-6">
            <div
                class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm"
            >
                <div class="flex items-center justify-between mb-3.5">
                    <p
                        class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5"
                    >
                        <svg
                            class="w-3.5 h-3.5 text-blue-600"
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
                            class="h-5 w-5 mt-0.5 rounded-lg bg-blue-600 text-white text-[11px] font-bold flex items-center justify-center shrink-0 shadow-sm"
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

        <!-- AI Summary (BARU) -->
        <div
            class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm mb-6"
            v-if="aiSummary"
        >
            <p
                class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2"
            >
                Ringkasan AI
            </p>
            <p class="text-sm text-slate-600 leading-relaxed">
                {{ aiSummary }}
            </p>
        </div>

        <!-- Actions -->
        <div class="no-print flex flex-col sm:flex-row gap-3">
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
import StudentHero from "@/components/student/StudentHero.vue";
import analysisService from "@/services/student/analysisService";
import apiClient from "@/services/api";

const route = useRoute();
const router = useRouter();
const analysisId = route.params.id;

const loading = ref(true);
const errorMessage = ref("");
const analysis = ref(null);

const currentDate = computed(() => {
    if (!analysis.value?.updated_at) return "-";
    return new Date(analysis.value.updated_at).toLocaleDateString("id-ID", {
        day: "2-digit",
        month: "long",
        year: "numeric",
    });
});

const detectedSkills = computed(() =>
    (analysis.value?.skills_json ?? []).map((s) =>
        typeof s === "string" ? s : s.name,
    ),
);
const gapSkills = computed(() => analysis.value?.skill_gap_json ?? []);
const roadmapSteps = computed(() =>
    (analysis.value?.roadmap_json ?? []).map((r) => r.topic),
);
const aiSummary = computed(() => analysis.value?.ai_summary ?? "");

const topCareer = computed(() => ({
    title: analysis.value?.career?.title ?? "Belum ada rekomendasi",
}));
const matchScore = computed(() => analysis.value?.match_score ?? 0);

const RING_RADIUS = 30;
const RING_CIRCUMFERENCE = 2 * Math.PI * RING_RADIUS;

const scoreDisplay = computed(() => `${Math.round(matchScore.value)}%`);

const ringCircumference = computed(() => RING_CIRCUMFERENCE);

const ringOffset = computed(() => {
    const score = Math.min(Math.max(matchScore.value, 0), 100);
    return RING_CIRCUMFERENCE - (score / 100) * RING_CIRCUMFERENCE;
});

const scoreTextClass = computed(() => {
    const score = Math.round(matchScore.value);
    if (score >= 100) return "text-base";
    if (score >= 10) return "text-lg";
    return "text-xl";
});

onMounted(async () => {
    try {
        const analysisId = route.params.id;
        const result = analysisId
            ? await analysisService.getResult(analysisId)
            : await analysisService.getLatest();
        analysis.value = result.data;
    } catch (err) {
        errorMessage.value =
            err.response?.data?.message ?? "Gagal memuat hasil analisis.";
    } finally {
        loading.value = false;
    }
});

async function downloadPdf() {
    try {
        const id = analysis.value?.id;
        if (!id) {
            alert("Data analisis belum tersedia.");
            return;
        }

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
    }
}

function reuploadCv() {
    router.push({ name: "StudentCV" });
}
</script>
