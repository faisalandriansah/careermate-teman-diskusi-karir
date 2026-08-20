<template>
    <div class="px-4 py-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-6 flex flex-wrap items-center gap-3">
            <div
                class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-600/10 text-indigo-600"
            >
                <svg
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                    />
                </svg>
            </div>
            <div class="min-w-0">
                <h1 class="text-xl font-bold text-slate-900 sm:text-2xl">
                    Riwayat Analisis
                </h1>
                <p class="mt-0.5 text-sm text-slate-500">
                    Pantau seluruh aktivitas analisis CV mahasiswa di platform
                </p>
            </div>
        </div>

        <!-- Search -->
        <div class="relative mb-5 w-full">
            <svg
                class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21 21l-4.35-4.35M17 10.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z"
                />
            </svg>
            <input
                type="search"
                v-model="search"
                placeholder="Cari nama atau email mahasiswa..."
                aria-label="Cari riwayat analisis"
                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-11 text-sm text-slate-700 shadow-sm outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 [&::-webkit-search-cancel-button]:hidden [&::-webkit-search-decoration]:hidden"
            />
            <button
                v-if="search && !loading"
                @click="clearSearch"
                aria-label="Hapus pencarian"
                class="absolute right-2.5 top-1/2 -translate-y-1/2 rounded-full p-1.5 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
            >
                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
            <svg
                v-if="loading"
                class="absolute right-3.5 top-1/2 h-4 w-4 -translate-y-1/2 animate-spin text-blue-500"
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
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                ></path>
            </svg>
        </div>

        <!-- Loading Skeleton -->
        <div v-if="loading" class="space-y-3">
            <div
                v-for="n in 5"
                :key="n"
                class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4"
            >
                <div
                    class="h-10 w-10 animate-pulse rounded-full bg-slate-200"
                ></div>
                <div class="flex-1 space-y-2">
                    <div
                        class="h-3 w-1/3 animate-pulse rounded bg-slate-200"
                    ></div>
                    <div
                        class="h-3 w-2/3 animate-pulse rounded bg-slate-200"
                    ></div>
                </div>
            </div>
        </div>

        <!-- Error State -->
        <div
            v-else-if="errorMessage"
            class="flex flex-col items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-12 text-center"
        >
            <p class="text-sm font-semibold text-red-600">
                Gagal memuat riwayat analisis
            </p>
            <p class="mt-1 text-xs text-slate-500">{{ errorMessage }}</p>
            <button
                @click="loadHistory()"
                class="mt-3 rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50"
            >
                Coba lagi
            </button>
        </div>

        <!-- Empty State -->
        <div
            v-else-if="items.length === 0"
            class="flex flex-col items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-16 text-center"
        >
            <div
                class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400"
            >
                <svg
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                    />
                </svg>
            </div>
            <h3 class="text-sm font-semibold text-slate-900">
                Belum Ada Analisis
            </h3>
            <p class="mt-1 text-xs text-slate-500">
                Belum ada mahasiswa yang menjalankan analisis CV
            </p>
        </div>

        <!-- Data Table (desktop & mobile-friendly) -->
        <div
            v-else
            class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
        >
            <div
                class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 bg-slate-50/70 px-4 py-3 sm:px-5"
            >
                <p class="text-sm font-semibold text-slate-700">
                    Daftar Riwayat Analisis
                </p>
                <span
                    class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-600"
                >
                    {{ total }} data
                </span>
            </div>
            <div class="divide-y divide-slate-100">
                <div
                    v-for="item in items"
                    :key="item.id"
                    class="flex flex-col gap-3 p-4 transition-colors hover:bg-slate-50/60 sm:flex-row sm:items-center sm:justify-between sm:gap-6"
                >
                    <!-- Mahasiswa -->
                    <div class="flex min-w-0 items-center gap-3">
                        <div
                            class="relative flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-full bg-gradient-to-br from-indigo-500 to-blue-600 text-sm font-semibold text-white"
                        >
                            <img
                                v-if="studentPhoto(item)"
                                :src="studentPhoto(item)"
                                alt=""
                                class="h-full w-full object-cover"
                                @error="$event.target.style.display = 'none'"
                            />
                            <span
                                v-if="!studentPhoto(item)"
                                class="flex h-full w-full items-center justify-center"
                            >
                                {{ initials(item.user?.name) }}
                            </span>
                        </div>
                        <div class="min-w-0">
                            <p
                                class="truncate text-sm font-semibold text-slate-900"
                            >
                                {{ item.user?.name ?? "-" }}
                            </p>
                            <p
                                class="truncate text-xs text-slate-500"
                                :title="item.user?.email"
                            >
                                {{ item.user?.email ?? "-" }}
                            </p>
                        </div>
                    </div>

                    <!-- Karier & Skor -->
                    <div
                        class="flex-1 sm:max-w-sm sm:shrink-0 sm:flex sm:items-center sm:justify-end sm:gap-5"
                    >
                        <div class="min-w-0">
                            <p
                                class="truncate text-xs text-slate-500"
                            >
                                Karier Rekomendasi
                            </p>
                            <div class="flex min-w-0 items-center gap-1.5">
                                <p
                                    class="truncate text-sm font-semibold text-slate-800"
                                >
                                    {{ item.career?.title ?? "-" }}
                                </p>
                                <span
                                    v-if="(item.career_matches_count ?? 0) > 1"
                                    class="inline-flex shrink-0 items-center rounded-full border border-indigo-100 bg-indigo-50 px-2 py-0.5 text-[10px] font-semibold text-indigo-600"
                                >
                                    +{{ (item.career_matches_count ?? 0) - 1 }} karir lain
                                </span>
                            </div>
                        </div>

                        <div class="hidden sm:block h-9 w-px bg-slate-200"></div>

                        <span
                            class="mt-1.5 inline-flex min-w-[3.25rem] w-fit items-center justify-center rounded-full px-2.5 py-1 text-xs font-bold"
                            :class="scoreClass(item.match_score)"
                        >
                            {{ Math.round(item.match_score ?? 0) }}%
                        </span>
                    </div>

                    <!-- Tanggal & CV -->
                    <div
                        class="flex items-center justify-between gap-4 sm:shrink-0"
                    >
                        <div class="min-w-0">
                            <p class="text-xs text-slate-500">Tanggal</p>
                            <p class="text-sm text-slate-800">
                                {{ formatDate(item.created_at) }}
                            </p>
                        </div>
                        <button
                            @click="openDetail(item)"
                            class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-blue-600 transition hover:border-blue-200 hover:bg-blue-50 active:scale-[0.98]"
                        >
                            <svg
                                class="h-3.5 w-3.5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                />
                            </svg>
                            Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div
            v-if="!loading && !errorMessage && total > 0"
            class="mt-4 flex flex-col items-center justify-between gap-3 sm:flex-row sm:gap-4"
        >
            <div class="text-sm text-slate-600">
                Menampilkan
                <span class="font-semibold text-slate-900">{{ shownFrom }}</span>
                -
                <span class="font-semibold text-slate-900">{{ shownTo }}</span>
                dari
                <span class="font-semibold text-slate-900">{{ total }}</span>
                data
            </div>

            <div
                class="grid w-full grid-cols-3 items-stretch overflow-hidden rounded-xl border border-slate-300 bg-white shadow-sm sm:w-auto sm:inline-flex"
            >
                <button
                    @click="changePage(currentPage - 1)"
                    :disabled="currentPage <= 1"
                    class="inline-flex items-center justify-center gap-1 border-r border-slate-200 px-3 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-40"
                >
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                    <span>Sebelumnya</span>
                </button>

                <span
                    class="flex items-center justify-center border-r border-slate-200 bg-slate-50 px-1 py-2.5 text-sm font-semibold text-slate-700"
                >
                    {{ currentPage }}
                    <span class="text-slate-400">/ {{ lastPage }}</span>
                </span>

                <button
                    @click="changePage(currentPage + 1)"
                    :disabled="currentPage >= lastPage"
                    class="inline-flex items-center justify-center gap-1 px-3 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-40"
                >
                    <span>Berikutnya</span>
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <AnalysisDetailModal
        v-if="detailOpen && selectedAnalysis"
        :analysis="selectedAnalysis"
        @close="closeDetail"
    />
</template>

<script setup>
import { ref, computed, watch, onMounted } from "vue";
import { analysisHistoryService } from "@/services/admin/analysisHistoryService";
import AnalysisDetailModal from "@/components/admin/AnalysisDetailModal.vue";

const items = ref([]);
const loading = ref(false);
const errorMessage = ref("");
const search = ref("");
let searchTimer = null;

const selectedAnalysis = ref(null);
const detailOpen = ref(false);

function openDetail(item) {
    selectedAnalysis.value = item;
    detailOpen.value = true;
}

function closeDetail() {
    detailOpen.value = false;
    selectedAnalysis.value = null;
}

const currentPage = ref(1);
const lastPage = ref(1);
const total = ref(0);
const perPage = 12;

const shownFrom = computed(() =>
    total.value === 0 ? 0 : (currentPage.value - 1) * perPage + 1,
);
const shownTo = computed(() =>
    Math.min(currentPage.value * perPage, total.value),
);

async function loadHistory(page = 1) {
    loading.value = true;
    errorMessage.value = "";
    try {
        const { data } = await analysisHistoryService.getHistory({
            page,
            per_page: perPage,
            search: search.value || undefined,
        });
        items.value = data.data?.data ?? data.data ?? [];
        currentPage.value = data.data?.current_page ?? page;
        lastPage.value = data.data?.last_page ?? 1;
        total.value = data.data?.total ?? 0;
    } catch (err) {
        errorMessage.value =
            err.response?.data?.message ?? "Terjadi kesalahan pada server";
    } finally {
        loading.value = false;
    }
}

function changePage(page) {
    if (page < 1 || page > lastPage.value) return;
    loadHistory(page);
}

function clearSearch() {
    search.value = "";
}

// Live search: ketik langsung cari, debounce 400ms
watch(search, () => {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => {
        loadHistory(1);
    }, 400);
});

function initials(name) {
    if (!name) return "?";
    return name
        .split(" ")
        .filter(Boolean)
        .slice(0, 2)
        .map((w) => w[0].toUpperCase())
        .join("");
}

function studentPhoto(item) {
    return (
        item.user?.student_profile_photo_url ??
        item.user?.student_profile?.photo_url ??
        null
    );
}

function formatDate(dateString) {
    if (!dateString) return "-";
    const options = { day: "2-digit", month: "short", year: "numeric" };
    return new Date(dateString).toLocaleDateString("id-ID", options);
}

function scoreClass(score) {
    const s = score ?? 0;
    if (s >= 75) return "bg-emerald-50 text-emerald-700";
    if (s >= 50) return "bg-blue-50 text-blue-700";
    return "bg-amber-50 text-amber-700";
}

onMounted(() => loadHistory(1));
</script>