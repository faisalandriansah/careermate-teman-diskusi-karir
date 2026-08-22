<template>
    <div
        v-if="loading || isProfileLoading"
        class="flex flex-col items-center justify-center py-24 gap-4"
    >
        <div class="loading-ring"></div>
        <p class="text-sm text-slate-400">Memuat detail karir...</p>
    </div>

    <EmptyState
        v-else-if="!isProfileComplete"
        icon="lock"
        title="Lengkapi Profil Dulu, Yuk!"
        description="Fitur target karir akan terbuka setelah profil kamu lengkap."
        :steps="[
            'Lengkapi biodata & detail profil',
            'Upload CV kamu',
            'Pilih target karirmu',
        ]"
        primary-label="Lengkapi Profil"
        :primary-to="{ name: 'StudentProfile' }"
    />

    <div v-else-if="errorMessage" class="container mx-auto px-4 py-8 max-w-2xl">
        <div
            class="bg-white rounded-2xl border border-slate-100 p-8 text-center shadow-sm"
        >
            <p class="text-sm text-rose-500">{{ errorMessage }}</p>
            <button
                type="button"
                @click="load"
                class="mt-5 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold transition active:scale-95 shadow-md shadow-blue-600/25"
            >
                Coba Lagi
            </button>
        </div>
    </div>

    <div v-else class="container mx-auto px-4 py-8 max-w-3xl">
        <StudentHero compact>
            <div
                class="flex items-center gap-2 text-[11px] text-blue-200/80 font-medium mb-2"
            >
                <router-link
                    :to="{
                        name: 'StudentHasilAnalisis',
                        params: { id: analysisId },
                    }"
                    class="inline-flex items-center gap-1 hover:text-white transition"
                >
                    <svg
                        class="w-3.5 h-3.5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                    Kembali ke Hasil Analisis
                </router-link>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-white">
                {{ target?.career?.title ?? "Target Karir" }}
            </h1>
            <p class="mt-1.5 text-sm text-blue-200/80 max-w-md">
                Seberapa siap kamu untuk peran ini, skill yang kamu punya, dan
                langkah yang perlu dipelajari.
            </p>
        </StudentHero>

        <!-- Score card -->
        <div
            class="bg-white rounded-2xl border border-slate-100 p-5 sm:p-6 shadow-sm mb-5"
        >
            <div class="flex items-center gap-5">
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
                            :stroke-dasharray="RING_CIRCUMFERENCE"
                            :stroke-dashoffset="ringOffset"
                            class="transition-all duration-1000 ease-out"
                        />
                    </svg>
                    <span
                        class="absolute inset-0 flex items-center justify-center font-bold text-slate-800"
                        >{{ scoreDisplay }}</span
                    >
                </div>
                <div class="min-w-0 flex-1">
                    <p
                        class="text-xs font-semibold text-slate-400 uppercase tracking-wider"
                    >
                        Kecocokan Kamu
                    </p>
                    <p class="text-sm text-slate-500 mt-1 leading-relaxed">
                        Berdasarkan skill yang terdeteksi di CV-mu, kamu sudah
                        siap {{ scoreDisplay }} untuk peran ini.
                    </p>
                </div>
            </div>
        </div>

        <!-- Skills -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
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
                    Sudah Kamu Kuasai
                </p>
                <div v-if="matchedSkills.length" class="flex flex-wrap gap-1.5">
                    <span
                        v-for="s in matchedSkills"
                        :key="s"
                        class="text-xs font-semibold px-3 py-1.5 rounded-xl bg-emerald-50/80 border border-emerald-100 text-emerald-800"
                    >
                        {{ s }}
                    </span>
                </div>
                <p v-else class="text-[11px] text-slate-400 italic">
                    Belum ada skill yang cocok untuk peran ini.
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
                    Selamat! Tidak ada skill gap untuk peran ini.
                </p>
            </div>
        </div>

        <!-- Roadmap -->
        <div
            class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm mb-5"
        >
            <div class="flex items-center justify-between mb-1">
                <p
                    class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5"
                >
                    <svg
                        class="w-3.5 h-3.5 text-blue-600 shrink-0"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"
                        />
                    </svg>
                    Roadmap Pengembangan
                </p>
                <span
                    v-if="generating"
                    class="inline-flex items-center gap-1.5 text-[10px] font-bold text-blue-600 bg-blue-50 border border-blue-100 rounded-full px-2.5 py-1"
                >
                    <span
                        class="h-2.5 w-2.5 rounded-full border-2 border-blue-300 border-t-blue-600 animate-spin"
                    ></span>
                    AI Menyusun...
                </span>
            </div>
            <p class="text-[11px] text-slate-400 mb-4 -mt-1.5">
                Langkah yang disarankan untuk mendekati target kariermu.
            </p>

            <div v-if="roadmapSteps.length" class="space-y-2.5">
                <div
                    v-for="(step, i) in roadmapSteps"
                    :key="i"
                    class="flex items-start gap-2.5 p-3 bg-slate-50 border border-slate-100 rounded-xl min-w-0"
                >
                    <span
                        class="h-5 w-5 mt-0.5 rounded-lg bg-blue-600 text-white text-[11px] font-bold flex items-center justify-center shrink-0 shadow-sm"
                    >
                        {{ i + 1 }}
                    </span>
                    <div class="min-w-0 flex-1">
                        <p
                            v-if="step.week"
                            class="text-[10px] font-semibold text-blue-600 uppercase tracking-wide"
                        >
                            Minggu {{ step.week }}
                        </p>
                        <p
                            class="text-xs font-semibold text-slate-700 leading-snug min-w-0 flex-1 break-words"
                        >
                            {{ step.topic }}
                        </p>
                    </div>
                </div>
            </div>

            <div
                v-else-if="generating"
                class="flex flex-col items-center justify-center py-10 gap-3"
            >
                <span
                    class="h-10 w-10 rounded-full border-[3px] border-slate-200 border-t-blue-600 animate-spin"
                ></span>
                <p class="text-xs text-slate-500 font-medium">
                    AI sedang menyusun roadmap pengembangan terbaik untukmu...
                </p>
                <p class="text-[11px] text-slate-400">
                    Sekitar 10-30 detik, mohon jangan tinggalkan halaman ini.
                </p>
            </div>

            <div v-else-if="roadmapError" class="text-center py-6">
                <p class="text-xs text-rose-500 mb-4">{{ roadmapError }}</p>
                <button
                    @click="generateRoadmap"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold transition active:scale-95 shadow-md shadow-blue-600/25"
                >
                    Coba Buat Roadmap Lagi
                </button>
            </div>

            <button
                v-if="roadmapSteps.length"
                :disabled="generating"
                @click="generateRoadmap"
                class="mt-4 w-full inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-600 text-xs font-semibold hover:bg-slate-50 transition disabled:opacity-50 disabled:cursor-not-allowed"
            >
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
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                    />
                </svg>
                Buat Ulang Roadmap
            </button>
        </div>

        <!-- Rekomendasi Magang -->
        <div
            v-if="internships.length"
            class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm mb-6"
        >
            <p
                class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-1"
            >
                Rekomendasi Tempat Magang
            </p>
            <p class="text-[11px] text-slate-400 mb-3.5">
                Internship yang relevan dengan
                <span class="font-semibold text-slate-500">{{
                    target?.career?.title
                }}</span
                >.
            </p>
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

        <!-- AI Summary -->
        <div
            v-if="target?.ai_summary"
            class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm mb-6"
        >
            <p
                class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2"
            >
                Ringkasan AI
            </p>
            <p class="text-sm text-slate-600 leading-relaxed">
                {{ target.ai_summary }}
            </p>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { useRoute } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import StudentHero from "@/components/student/StudentHero.vue";
import EmptyState from "@/components/student/EmptyState.vue";
import analysisService from "@/services/student/analysisService";
import cvService from "@/services/student/cvService";

const route = useRoute();
const authStore = useAuthStore();
const analysisId = route.params.id;
const careerId = route.params.careerId;

const loading = ref(true);
const isProfileLoading = ref(false);
const isProfileComplete = computed(() => authStore.isProfileComplete);
const errorMessage = ref("");
const target = ref(null);
const generating = ref(false);
const roadmapError = ref("");

const RING_RADIUS = 30;
const RING_CIRCUMFERENCE = 2 * Math.PI * RING_RADIUS;

const matchScore = computed(() => target.value?.match_score ?? 0);
const scoreDisplay = computed(() => `${Math.round(matchScore.value)}%`);
const ringOffset = computed(() => {
    const score = Math.min(Math.max(matchScore.value, 0), 100);
    return RING_CIRCUMFERENCE - (score / 100) * RING_CIRCUMFERENCE;
});

const matchedSkills = computed(() => target.value?.matched_skills_json ?? []);
const gapSkills = computed(() => target.value?.skill_gap_json ?? []);
const roadmapSteps = computed(() => target.value?.roadmap_json ?? []);

const internships = computed(() => target.value?.career?.internships ?? []);

async function generateRoadmap() {
    generating.value = true;
    roadmapError.value = "";
    try {
        const result = await cvService.generateRoadmap(analysisId, careerId);
        target.value = result.data;
    } catch (err) {
        roadmapError.value =
            err.response?.data?.message ??
            "Gagal menyusun roadmap. Silakan coba lagi.";
    } finally {
        generating.value = false;
    }
}

async function load() {
    loading.value = true;
    errorMessage.value = "";
    try {
        const result = await analysisService.getTargetAnalysis(
            analysisId,
            careerId,
        );
        target.value = result.data;
        loading.value = false;

        if (!roadmapSteps.value.length) {
            await generateRoadmap();
        }
    } catch (err) {
        loading.value = false;
        errorMessage.value =
            err.response?.data?.message ?? "Gagal memuat detail karir.";
    }
}

onMounted(async () => {
    // Profil sudah disegarkan oleh StudentLayout (fetchMe), cukup muat data target.
    await load();
});
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
