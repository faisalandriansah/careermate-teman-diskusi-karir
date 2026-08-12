<template>
    <div
        v-if="loading || isProfileLoading"
        class="flex flex-col items-center justify-center py-24 gap-4"
    >
        <div class="loading-ring"></div>
        <p class="text-sm text-slate-400">Memuat riwayat analisis...</p>
    </div>

    <EmptyState
        v-else-if="!isProfileComplete"
        icon="lock"
        title="Lengkapi Profil Dulu, Yuk!"
        description="Riwayat analisis CV-mu akan muncul setelah profil kamu lengkap. Lengkapi profil dulu supaya kamu bisa mulai menganalisis CV dan memantau perkembangannya."
        :steps="['Lengkapi biodata & detail profil', 'Upload CV kamu', 'Pantau perkembanganmu']"
        primary-label="Lengkapi Profil"
        :primary-to="{ name: 'StudentProfile' }"
    />

    <div
        v-else-if="errorMessage"
        class="flex flex-col items-center justify-center py-24 gap-3"
    >
        <div
            class="h-14 w-14 rounded-2xl bg-rose-50 border border-rose-100 flex items-center justify-center"
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
        <p class="text-sm text-rose-500">{{ errorMessage }}</p>
        <button
            type="button"
            @click="loadHistory"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold transition active:scale-95 shadow-md shadow-blue-600/25"
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
            Coba Lagi
        </button>
    </div>

    <EmptyState
        v-else-if="rawHistory.length === 0"
        icon="history"
        title="Belum Ada Riwayat Analisis"
        description="Riwayat analisis CV-mu akan muncul di sini. Unggah CV untuk mendapatkan analisis AI dan pantau perkembangannya dari waktu ke waktu."
        :steps="['Upload CV kamu', 'AI menganalisis profil', 'Pantau perkembanganmu']"
        primary-label="Upload CV Sekarang"
        :primary-to="{ name: 'StudentCV' }"
    />

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
            class="flex flex-col sm:flex-row sm:flex-wrap items-stretch sm:items-center justify-between gap-3 mb-2 text-xs text-slate-500 font-medium bg-slate-50 p-3 rounded-xl border border-slate-100"
        >
            <div class="flex flex-wrap items-center gap-2 min-w-0">
                <span
                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-white border border-slate-200 text-slate-700 font-semibold"
                    title="Jumlah total CV yang pernah kamu analisis"
                >
                    Total {{ rawHistory.length }} Kali Analisis
                </span>
                <span
                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-slate-500"
                    title="Rata-rata skor kecocokan dari semua analisis kamu"
                    >Rata-rata Skor Match:
                    <strong class="text-slate-800"
                        >{{ avgScore }}%</strong
                    ></span
                >
                <span
                    class="text-emerald-600 font-semibold inline-flex items-center gap-1 px-2.5 py-1"
                    title="Perbandingan skor analisis terakhir dengan sebelumnya"
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

        <p
            class="text-[11px] text-slate-400 mb-4 px-1 flex items-start gap-1.5"
        >
            <svg
                class="h-3.5 w-3.5 mt-0.5 shrink-0 text-blue-500"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </svg>
            Skor match menunjukkan seberapa cocok CV-mu dengan peran yang
            direkomendasikan AI. Semakin tinggi skornya, semakin besar
            peluangmu untuk mengejar peran tersebut.
        </p>

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
                            class="text-[10px] font-semibold shrink-0"
                            :class="scoreBadgeClass(item.score)"
                        >
                            {{ scoreLabel(item.score) }}
                        </span>
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
import { useAuthStore } from "@/stores/auth";
import StudentHero from "@/components/student/StudentHero.vue";
import EmptyState from "@/components/student/EmptyState.vue";
import analysisService from "@/services/student/analysisService";

const router = useRouter();
const authStore = useAuthStore();
const loading = ref(true);
const isProfileLoading = ref(true);
const isProfileComplete = computed(() => authStore.isProfileComplete);
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
    await Promise.all([loadProfile(), loadHistory()]);
});
onUnmounted(() => document.removeEventListener("click", handleClickOutside));

async function loadProfile() {
    if (!authStore.token) {
        isProfileLoading.value = false;
        return;
    }
    try {
        await authStore.fetchMe();
    } catch (e) {
        console.log("Auth me gagal", e);
    } finally {
        isProfileLoading.value = false;
    }
}

async function loadHistory() {
    loading.value = true;
    errorMessage.value = "";
    try {
        const result = await analysisService.getHistory();
        rawHistory.value = mapHistory(result.data);
    } catch (err) {
        errorMessage.value = "Gagal memuat riwayat analisis.";
    } finally {
        loading.value = false;
    }
}

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

function scoreLabel(score) {
    if (score >= 80) return "Sangat Tinggi";
    if (score >= 60) return "Tinggi";
    if (score >= 40) return "Sedang";
    return "Perlu Ditingkatkan";
}

function scoreBadgeClass(score) {
    if (score >= 80)
        return "text-emerald-600 bg-emerald-50 border border-emerald-100 rounded-md px-2 py-0.5";
    if (score >= 60)
        return "text-blue-600 bg-blue-50 border border-blue-100 rounded-md px-2 py-0.5";
    if (score >= 40)
        return "text-amber-600 bg-amber-50 border border-amber-100 rounded-md px-2 py-0.5";
    return "text-rose-600 bg-rose-50 border border-rose-100 rounded-md px-2 py-0.5";
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
    if (rawHistory.value.length < 2)
        return "lakukan 2x analisis untuk melihat tren";
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
