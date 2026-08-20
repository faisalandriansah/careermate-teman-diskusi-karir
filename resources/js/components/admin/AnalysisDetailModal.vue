<template>
    <div
        class="fixed inset-0 z-50 flex items-end sm:items-center justify-center"
    >
        <!-- Backdrop -->
        <div
            class="fixed inset-0 bg-gray-900/50"
            @click="$emit('close')"
        ></div>

        <!-- Modal panel -->
        <div
            class="relative bg-white w-full sm:max-w-3xl sm:rounded-2xl sm:shadow-xl sm:mx-4 max-h-[92vh] sm:max-h-[85vh] flex flex-col rounded-t-2xl overflow-hidden"
        >
            <!-- Header -->
            <div
                class="relative px-5 pt-5 pb-6 sm:px-6 sm:pt-6 sm:pb-8 bg-gradient-to-br from-indigo-600 to-blue-600 shrink-0"
            >
                <button
                    type="button"
                    class="absolute top-4 right-4 text-white/70 hover:text-white p-1 rounded-md focus:outline-none focus:ring-2 focus:ring-white/50"
                    @click="$emit('close')"
                >
                    <svg
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>

                <div class="flex items-center gap-4 pr-8">
                    <div
                        class="relative flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-full bg-white/15 border-2 border-white/30 text-white text-lg font-semibold"
                    >
                        <img
                            v-if="analysis.user?.student_profile_photo_url"
                            :src="analysis.user?.student_profile_photo_url"
                            alt=""
                            class="h-full w-full object-cover"
                            @error="$event.target.style.display = 'none'"
                        />
                        <span
                            v-if="!analysis.user?.student_profile_photo_url"
                            class="flex h-full w-full items-center justify-center"
                        >
                            {{ initials }}
                        </span>
                    </div>
                    <div class="min-w-0">
                        <h3
                            class="text-white text-lg sm:text-xl font-semibold truncate"
                        >
                            {{ analysis.user?.name ?? "-" }}
                        </h3>
                        <p class="text-blue-100 text-sm truncate">
                            {{ analysis.user?.email ?? "-" }}
                        </p>
                        <p class="text-blue-200/80 text-xs mt-1">
                            Analisis •
                            {{ formatDate(analysis.created_at) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Body (scrollable) -->
            <div class="overflow-y-auto px-5 py-5 sm:px-6 sm:py-6 space-y-5">
                <!-- Loading -->
                <div v-if="loading" class="flex flex-col items-center py-10 gap-3">
                    <div class="loading-ring"></div>
                    <p class="text-sm text-slate-400">
                        Memuat daftar kecocokan karir...
                    </p>
                </div>

                <!-- Error -->
                <div
                    v-else-if="errorMessage"
                    class="flex flex-col items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 px-6 py-10 text-center"
                >
                    <p class="text-sm font-semibold text-red-600">
                        Gagal memuat detail analisis
                    </p>
                    <p class="mt-1 text-xs text-slate-500">{{ errorMessage }}</p>
                    <button
                        @click="loadCareers"
                        class="mt-3 rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50"
                    >
                        Coba lagi
                    </button>
                </div>

                <template v-else>
                    <!-- Best match highlight -->
                    <div
                        v-if="bestCareer"
                        class="rounded-2xl border border-blue-100 bg-blue-50/60 p-4 sm:p-5"
                    >
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-[11px] font-bold text-blue-600 uppercase tracking-wider mb-1"
                                >
                                    Karir Paling Sesuai
                                </p>
                                <h4 class="text-lg font-bold text-slate-900 truncate">
                                    {{ bestCareer.career?.title ?? "-" }}
                                </h4>
                                <p
                                    v-if="bestCareer.career?.description"
                                    class="mt-1 text-xs text-slate-500 leading-relaxed line-clamp-2"
                                >
                                    {{ bestCareer.career.description }}
                                </p>
                            </div>
                            <div class="shrink-0 text-center sm:text-right">
                                <span
                                    class="text-3xl font-extrabold tabular-nums"
                                    :class="scoreTextClass(bestCareer.match_score)"
                                >
                                    {{ Math.round(bestCareer.match_score ?? 0) }}%
                                </span>
                                <p
                                    class="text-[11px] font-semibold mt-0.5"
                                    :class="scoreTextClass(bestCareer.match_score)"
                                >
                                    {{ scoreLabel(bestCareer.match_score) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Other careers -->
                    <div v-if="careers.length">
                        <h4 class="text-sm font-bold text-slate-800 mb-3">
                            Semua Karir yang Cocok
                            <span
                                class="ml-1 inline-flex items-center rounded-full bg-indigo-50 px-2 py-0.5 text-[10px] font-semibold text-indigo-600"
                            >
                                {{ careers.length }} karir
                            </span>
                        </h4>
                        <div class="space-y-3">
                            <div
                                v-for="m in careers"
                                :key="m.id"
                                class="rounded-xl border border-slate-200 p-4"
                                :class="
                                    m.is_best_match
                                        ? 'border-blue-200 bg-blue-50/40'
                                        : 'bg-white'
                                "
                            >
                                <div
                                    class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3"
                                >
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <p
                                                class="text-sm font-semibold text-slate-800 truncate"
                                            >
                                                {{ m.career?.title ?? "-" }}
                                            </p>
                                            <span
                                                v-if="m.is_best_match"
                                                class="inline-flex items-center rounded-full bg-blue-600 px-2 py-0.5 text-[10px] font-bold text-white"
                                            >
                                                Terbaik
                                            </span>
                                            <span
                                                v-if="hasRoadmap(m)"
                                                class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-0.5 text-[10px] font-semibold text-emerald-700 border border-emerald-100"
                                            >
                                                <svg
                                                    class="h-3 w-3"
                                                    fill="currentColor"
                                                    viewBox="0 0 20 20"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                                Roadmap tersedia
                                            </span>
                                        </div>

                                        <div
                                            class="mt-2.5 flex flex-wrap gap-1.5"
                                        >
                                            <span
                                                v-for="s in matchedSkills(m)"
                                                :key="s"
                                                class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-emerald-50 border border-emerald-100 text-emerald-800"
                                            >
                                                {{ s }}
                                            </span>
                                        </div>
                                        <div
                                            v-if="gapSkills(m).length"
                                            class="mt-1.5 flex flex-wrap gap-1.5"
                                        >
                                            <span
                                                v-for="s in gapSkills(m)"
                                                :key="s"
                                                class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-amber-50 border border-amber-100 text-amber-800"
                                            >
                                                {{ s }} (gap)
                                            </span>
                                        </div>
                                    </div>
                                    <div class="shrink-0 text-left sm:text-right">
                                        <span
                                            class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-bold"
                                            :class="scoreBadgeClass(m.match_score)"
                                        >
                                            {{ Math.round(m.match_score ?? 0) }}%
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Empty -->
                    <div
                        v-else
                        class="flex flex-col items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 px-6 py-10 text-center"
                    >
                        <p class="text-sm font-medium text-slate-600">
                            Belum ada data kecocokan karir untuk analisis ini.
                        </p>
                    </div>
                </template>
            </div>

            <!-- Footer -->
            <div
                class="px-5 py-3.5 sm:px-6 border-t border-gray-200 flex justify-end shrink-0"
            >
                <button
                    type="button"
                    class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300"
                    @click="$emit('close')"
                >
                    Tutup
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { analysisHistoryService } from "@/services/admin/analysisHistoryService";

const props = defineProps({
    analysis: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(["close"]);

const loading = ref(true);
const errorMessage = ref("");
const careers = ref([]);

const bestCareer = computed(
    () => careers.value.find((c) => c.is_best_match) ?? careers.value[0] ?? null,
);

const initials = computed(() => {
    const name = props.analysis?.user?.name;
    if (!name) return "?";
    return name
        .split(" ")
        .filter(Boolean)
        .slice(0, 2)
        .map((w) => w[0].toUpperCase())
        .join("");
});

const matchedSkills = (m) => m.matched_skills_json ?? [];
const gapSkills = (m) => m.skill_gap_json ?? [];
const hasRoadmap = (m) =>
    (m.roadmap_json && m.roadmap_json.length > 0) || !!m.ai_summary;

function scoreLabel(score) {
    const s = score ?? 0;
    if (s >= 80) return "Sangat Tinggi";
    if (s >= 60) return "Tinggi";
    if (s >= 40) return "Sedang";
    return "Perlu Ditingkatkan";
}

function scoreTextClass(score) {
    const s = score ?? 0;
    if (s >= 80) return "text-emerald-600";
    if (s >= 60) return "text-blue-600";
    if (s >= 40) return "text-amber-600";
    return "text-rose-600";
}

function scoreBadgeClass(score) {
    const s = score ?? 0;
    if (s >= 80)
        return "bg-emerald-50 text-emerald-700 border border-emerald-100";
    if (s >= 60)
        return "bg-blue-50 text-blue-700 border border-blue-100";
    if (s >= 40)
        return "bg-amber-50 text-amber-700 border border-amber-100";
    return "bg-rose-50 text-rose-700 border border-rose-100";
}

function formatDate(dateString) {
    if (!dateString) return "-";
    const options = { day: "2-digit", month: "short", year: "numeric" };
    return new Date(dateString).toLocaleDateString("id-ID", options);
}

async function loadCareers() {
    loading.value = true;
    errorMessage.value = "";
    try {
        const { data } = await analysisHistoryService.getAnalysisCareers(
            props.analysis.id,
        );
        careers.value = data.data?.careers ?? data.careers ?? [];
    } catch (err) {
        errorMessage.value =
            err.response?.data?.message ?? "Terjadi kesalahan pada server";
    } finally {
        loading.value = false;
    }
}

onMounted(loadCareers);
</script>

<style scoped>
.loading-ring {
    height: 36px;
    width: 36px;
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