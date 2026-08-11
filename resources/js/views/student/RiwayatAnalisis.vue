<template>
    <div v-if="loading" class="flex items-center justify-center py-24">
        <p class="text-sm text-slate-400">Memuat riwayat analisis...</p>
    </div>

    <div
        v-else-if="errorMessage"
        class="flex flex-col items-center justify-center py-24 gap-3"
    >
        <p class="text-sm text-rose-500">{{ errorMessage }}</p>
    </div>

    <div
        v-else-if="rawHistory.length === 0"
        class="flex flex-col items-center justify-center py-24 gap-3"
    >
        <p class="text-sm text-slate-400">Belum ada riwayat analisis.</p>
        <router-link to="/student/cv" class="text-sm text-blue-600 underline">
            Upload CV Sekarang
        </router-link>
    </div>
    <div
        v-else
        class="container mx-auto px-4 py-8 max-w-5xl"
    >
        <!-- Header Page -->
        <StudentHero compact>
            <div
                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/10 backdrop-blur-md text-blue-200 text-[11px] font-semibold uppercase tracking-widest mb-3"
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
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                    />
                </svg>
                <span>Riwayat Analisis</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-white">
                Riwayat Analisis CV
            </h1>
            <p class="mt-1.5 text-sm text-blue-200/80 max-w-md">
                Pantau perkembangan analisis dan kecocokan profil Anda dari
                waktu ke waktu.
            </p>
        </StudentHero>

        <!-- Stats & Sort Bar -->
        <div
            class="flex flex-col sm:flex-row sm:flex-wrap items-stretch sm:items-center justify-between gap-3 mb-6 text-xs text-slate-500 font-medium bg-slate-50 p-3 rounded-xl border border-slate-100"
        >
            <div class="flex flex-wrap items-center gap-2 min-w-0">
                <span
                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-white border border-slate-200 text-slate-700 font-semibold"
                >
                    Total {{ rawHistory.length }} Kali Analisis
                </span>
                <span
                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-slate-500"
                    >Rata-rata Skor Match:
                    <strong class="text-slate-800"
                        >{{ avgScore }}%</strong
                    ></span
                >
                <span
                    class="text-emerald-600 font-semibold inline-flex items-center gap-1 px-2.5 py-1"
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
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
                        />
                    </svg>
                    {{ trendLabel }}
                </span>
            </div>

            <!-- Custom Sort Dropdown -->
            <div class="relative shrink-0 ml-auto" ref="dropdownRef">
                <button
                    @click="isSortOpen = !isSortOpen"
                    class="flex items-center gap-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl px-3.5 py-2 hover:bg-slate-50 hover:border-slate-300 transition shadow-sm"
                >
                    <svg
                        class="h-4 w-4 text-slate-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 4h18M6 8h12M9 12h6M11 16h2"
                        />
                    </svg>
                    <span>{{ currentSortLabel }}</span>
                    <svg
                        class="h-3.5 w-3.5 text-slate-400 transition-transform duration-200"
                        :class="isSortOpen && 'rotate-180'"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7"
                        />
                    </svg>
                </button>

                <div
                    v-if="isSortOpen"
                    class="absolute right-0 top-full mt-2 w-48 bg-white border border-slate-100 rounded-xl shadow-lg py-1.5 z-20 overflow-hidden"
                >
                    <button
                        v-for="opt in sortOptions"
                        :key="opt.value"
                        @click="selectSort(opt.value)"
                        class="w-full flex items-center justify-between px-3.5 py-2 text-xs text-left transition"
                        :class="
                            sortBy === opt.value
                                ? 'bg-blue-50/60 text-blue-600 font-semibold'
                                : 'text-slate-600 hover:bg-slate-50'
                        "
                    >
                        <span>{{ opt.label }}</span>
                        <svg
                            v-if="sortBy === opt.value"
                            class="h-3.5 w-3.5 text-blue-600"
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
                    </button>
                </div>
            </div>
        </div>

        <!-- History List Card -->
        <div
            class="bg-white rounded-2xl border border-slate-100 divide-y divide-slate-100 shadow-sm overflow-hidden"
        >
            <div
                v-for="item in sortedHistory"
                :key="item.id"
                @click="viewDetail(item)"
                class="group hover:bg-slate-50/80 transition cursor-pointer"
            >
                <!-- ===== Mobile Layout (< sm) ===== -->
                <div class="sm:hidden p-4">
                    <div class="flex items-start gap-3">
                        <div
                            class="h-10 w-10 rounded-xl flex items-center justify-center shrink-0 shadow-2xs"
                            :class="item.iconBg"
                        >
                            <svg
                                class="h-5 w-5"
                                :class="item.iconColor"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    :d="item.iconPath"
                                />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-2">
                                <p
                                    class="text-sm font-bold text-slate-800 truncate"
                                >
                                    {{ item.role }}
                                </p>
                                <span
                                    v-if="item.isLatest"
                                    class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60 shrink-0"
                                >
                                    Terbaru
                                </span>
                            </div>
                            <p class="text-xs text-slate-400 truncate mt-0.5">
                                {{ item.dateShort }} ·
                                <span class="text-slate-500 font-medium">{{
                                    item.skills
                                }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mt-3">
                        <div
                            class="flex-1 h-2 bg-slate-100 rounded-full overflow-hidden"
                        >
                            <div
                                class="h-full rounded-full transition-all duration-500"
                                :class="
                                    item.isLatest
                                        ? 'bg-blue-600'
                                        : 'bg-slate-400'
                                "
                                :style="{ width: item.score + '%' }"
                            ></div>
                        </div>
                        <span
                            class="text-xs font-bold w-10 text-right"
                            :class="
                                item.isLatest
                                    ? 'text-blue-600'
                                    : 'text-slate-600'
                            "
                        >
                            {{ item.score }}%
                        </span>
                    </div>

                    <button
                        class="w-full mt-3 flex items-center justify-center gap-1.5 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl py-2 group-hover:bg-blue-50 group-hover:text-blue-600 group-hover:border-blue-100 transition shadow-2xs"
                    >
                        <span>Lihat Detail Analysis</span>
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

                <!-- ===== Tablet/Desktop Layout (sm+) ===== -->
                <div
                    class="hidden sm:grid grid-cols-[40px_minmax(0,1fr)_110px_90px] lg:grid-cols-[40px_110px_minmax(0,1fr)_150px_100px] items-center gap-3 lg:gap-4 px-4 sm:px-5 py-4"
                >
                    <!-- Icon -->
                    <div
                        class="h-9 w-9 rounded-xl flex items-center justify-center shrink-0 shadow-2xs"
                        :class="item.iconBg"
                    >
                        <svg
                            class="h-4 w-4"
                            :class="item.iconColor"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                :d="item.iconPath"
                            />
                        </svg>
                    </div>

                    <!-- Date (hanya tampil di lg+) -->
                    <span
                        class="hidden lg:block text-xs font-medium text-slate-400 truncate"
                        >{{ item.dateShort }}</span
                    >

                    <!-- Role & Skills -->
                    <div class="min-w-0">
                        <div class="flex items-center gap-2">
                            <p
                                class="text-xs sm:text-sm font-bold text-slate-800 truncate"
                            >
                                {{ item.role }}
                            </p>
                            <span
                                v-if="item.isLatest"
                                class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60 shrink-0"
                            >
                                Terbaru
                            </span>
                        </div>
                        <p class="text-xs text-slate-400 truncate mt-0.5">
                            {{ item.skills }}
                        </p>
                    </div>

                    <!-- Score Progress -->
                    <div
                        class="flex items-center gap-2 lg:gap-2.5 min-w-0 mr-1.5 sm:mr-2 lg:mr-3"
                    >
                        <div
                            class="flex-1 min-w-0 h-2 bg-slate-100 rounded-full overflow-hidden"
                        >
                            <div
                                class="h-full rounded-full transition-all duration-500"
                                :class="
                                    item.isLatest
                                        ? 'bg-blue-600'
                                        : 'bg-slate-300'
                                "
                                :style="{ width: item.score + '%' }"
                            ></div>
                        </div>
                        <span
                            class="text-xs font-bold w-9 text-right shrink-0"
                            :class="
                                item.isLatest
                                    ? 'text-blue-600'
                                    : 'text-slate-600'
                            "
                        >
                            {{ item.score }}%
                        </span>
                    </div>

                    <!-- Action Button -->
                    <button
                        class="w-full flex items-center justify-center gap-1 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl py-2 group-hover:border-blue-200 group-hover:bg-blue-50 group-hover:text-blue-600 transition shadow-2xs"
                    >
                        <span>Detail</span>
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
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue";
import { useRouter } from "vue-router";
import StudentHero from "@/components/student/StudentHero.vue";
import analysisService from "@/services/student/analysisService";

const router = useRouter();
const loading = ref(true);
const errorMessage = ref("");
const rawHistory = ref([]);

const sortOptions = [
    { value: "terbaru", label: "Terbaru" },
    { value: "skor", label: "Skor tertinggi" },
];

const sortBy = ref("terbaru");
const isSortOpen = ref(false);
const dropdownRef = ref(null);

const currentSortLabel = computed(() => {
    return (
        sortOptions.find((o) => o.value === sortBy.value)?.label || "Urutkan"
    );
});

function selectSort(val) {
    sortBy.value = val;
    isSortOpen.value = false;
}

function handleClickOutside(e) {
    if (dropdownRef.value && !dropdownRef.value.contains(e.target)) {
        isSortOpen.value = false;
    }
}

onMounted(async () => {
    document.addEventListener("click", handleClickOutside);

    try {
        const result = await analysisService.getHistory();
        rawHistory.value = mapHistory(result.data);
    } catch (err) {
        errorMessage.value = "Gagal memuat riwayat analisis.";
    } finally {
        loading.value = false;
    }
});
onUnmounted(() => document.removeEventListener("click", handleClickOutside));

// Ubah data mentah dari API jadi bentuk yang dipakai tampilan
function mapHistory(items) {
    return items.map((item) => {
        const skillNames = (item.skills_json ?? [])
            .map((s) => (typeof s === "string" ? s : s.name))
            .slice(0, 3)
            .join(", ");

        return {
            id: item.id,
            date: item.created_at,
            dateShort: formatDateShort(item.created_at),
            role: item.career?.title ?? "Belum ada rekomendasi",
            skills: skillNames || "Belum ada skill terdeteksi",
            score: item.match_score ?? 0,
            iconBg: "bg-blue-50",
            iconColor: "text-blue-600",
            iconPath:
                "M5 12a2 2 0 012-2h10a2 2 0 012 2v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6zM5 12V8a2 2 0 012-2h10a2 2 0 012 2v4M9 16h.01M13 16h.01",
        };
    });
}

function formatDateShort(dateStr) {
    if (!dateStr) return "-";
    return new Date(dateStr).toLocaleDateString("id-ID", {
        day: "2-digit",
        month: "short",
        year: "numeric",
    });
}

const history = computed(() =>
    rawHistory.value.map((item, i) => ({ ...item, isLatest: i === 0 })),
);

const sortedHistory = computed(() => {
    const items = [...history.value];
    if (sortBy.value === "skor") {
        return items.sort((a, b) => b.score - a.score);
    }
    return items.sort((a, b) => new Date(b.date) - new Date(a.date));
});

const avgScore = computed(() => {
    if (rawHistory.value.length === 0) return 0;
    return Math.round(
        rawHistory.value.reduce((sum, h) => sum + h.score, 0) /
            rawHistory.value.length,
    );
});

const trendLabel = computed(() => {
    if (rawHistory.value.length < 2) return "belum ada tren";
    const sorted = [...rawHistory.value].sort(
        (a, b) => new Date(b.date) - new Date(a.date),
    );
    const diff = sorted[0].score - sorted[1].score;
    if (diff > 0) return `naik ${diff} poin dari analisis sebelumnya`;
    if (diff < 0)
        return `turun ${Math.abs(diff)} poin dari analisis sebelumnya`;
    return "stabil dari analisis sebelumnya";
});

function viewDetail(item) {
    router.push({ name: "StudentHasilAnalisis", params: { id: item.id } });
}
</script>
