<template>
    <div class="container mx-auto px-4 py-6 max-w-4xl">
        <div class="flex items-baseline justify-between mb-1 gap-3">
            <h1 class="text-lg font-semibold text-gray-800">
                Riwayat Analisis
            </h1>

            <!-- Custom sort dropdown -->
            <div class="relative shrink-0" ref="dropdownRef">
                <button
                    @click="isSortOpen = !isSortOpen"
                    class="flex items-center gap-1.5 text-sm font-medium text-gray-700 border border-gray-200 rounded-lg px-3 py-1.5 hover:bg-gray-50 transition"
                >
                    <svg
                        class="h-3.5 w-3.5 text-gray-400"
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
                    {{ sortOptions.find((o) => o.value === sortBy)?.label }}
                    <svg
                        class="h-3.5 w-3.5 text-gray-400 transition-transform"
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
                    class="absolute right-0 top-full mt-1.5 w-44 bg-white border border-gray-200 rounded-lg shadow-lg py-1 z-10"
                >
                    <button
                        v-for="opt in sortOptions"
                        :key="opt.value"
                        @click="
                            sortBy = opt.value;
                            isSortOpen = false;
                        "
                        class="w-full flex items-center justify-between gap-2 px-3 py-2 text-sm text-left hover:bg-gray-50 transition"
                        :class="
                            sortBy === opt.value
                                ? 'text-blue-600 font-medium'
                                : 'text-gray-700'
                        "
                    >
                        {{ opt.label }}
                        <svg
                            v-if="sortBy === opt.value"
                            class="h-3.5 w-3.5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <p class="text-sm text-gray-400 mb-5">
            {{ history.length }} riwayat · rata-rata match {{ avgScore }}% ·
            <span class="text-emerald-600">{{ trendLabel }}</span>
        </p>

        <div class="bg-white rounded-xl border divide-y overflow-hidden">
            <div
                v-for="item in sortedHistory"
                :key="item.id"
                class="group hover:bg-gray-50 transition-colors cursor-pointer"
            >
                <!-- ===== Mobile layout (< sm): stacked card ===== -->
                <div class="sm:hidden px-4 py-4">
                    <div class="flex items-start gap-3">
                        <div
                            class="h-9 w-9 rounded-lg flex items-center justify-center shrink-0"
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
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-2">
                                <p
                                    class="text-sm font-medium text-gray-800 truncate"
                                >
                                    {{ item.role }}
                                </p>
                                <span
                                    v-if="item.isLatest"
                                    class="text-[10px] font-medium px-1.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 shrink-0"
                                >
                                    Terbaru
                                </span>
                            </div>
                            <p class="text-xs text-gray-400 truncate mt-0.5">
                                {{ item.dateShort }} · {{ item.skills }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 mt-3">
                        <div class="flex-1 h-1.5 bg-gray-100 rounded-full">
                            <div
                                class="h-1.5 rounded-full"
                                :class="
                                    item.isLatest
                                        ? 'bg-blue-600'
                                        : 'bg-gray-300'
                                "
                                :style="{ width: item.score + '%' }"
                            ></div>
                        </div>
                        <span
                            class="text-sm w-9 text-right"
                            :class="
                                item.isLatest
                                    ? 'font-medium text-blue-600'
                                    : 'text-gray-500'
                            "
                        >
                            {{ item.score }}%
                        </span>
                    </div>

                    <button
                        class="w-full mt-3 flex items-center justify-center gap-1 text-sm font-medium text-gray-700 border border-gray-200 rounded-lg py-2 active:bg-gray-100 transition"
                    >
                        Lihat detail
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

                <!-- ===== Desktop layout (sm+): single row ===== -->
                <div
                    class="hidden sm:grid grid-cols-[36px_110px_1fr_150px_90px] items-center gap-4 px-5 py-3.5"
                >
                    <div
                        class="h-8 w-8 rounded-lg flex items-center justify-center shrink-0"
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

                    <span class="text-sm text-gray-400">{{
                        item.dateShort
                    }}</span>

                    <div class="min-w-0">
                        <div class="flex items-center gap-2">
                            <p
                                class="text-sm font-medium text-gray-800 truncate"
                            >
                                {{ item.role }}
                            </p>
                            <span
                                v-if="item.isLatest"
                                class="text-[10px] font-medium px-1.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 shrink-0"
                            >
                                Terbaru
                            </span>
                        </div>
                        <span class="text-xs text-gray-400 truncate">{{
                            item.skills
                        }}</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <div class="flex-1 h-1.5 bg-gray-100 rounded-full">
                            <div
                                class="h-1.5 rounded-full"
                                :class="
                                    item.isLatest
                                        ? 'bg-blue-600'
                                        : 'bg-gray-300'
                                "
                                :style="{ width: item.score + '%' }"
                            ></div>
                        </div>
                        <span
                            class="text-sm w-9 text-right"
                            :class="
                                item.isLatest
                                    ? 'font-medium text-blue-600'
                                    : 'text-gray-500'
                            "
                        >
                            {{ item.score }}%
                        </span>
                    </div>

                    <button
                        class="w-full flex items-center justify-center gap-1 text-sm font-medium text-gray-700 border border-gray-200 rounded-lg py-1.5 group-hover:border-gray-300 transition"
                    >
                        Detail
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

// Statis dulu — data ditulis langsung, belum nyambung ke halaman Hasil Analisis
const rawHistory = [
    {
        id: 1,
        date: "2026-08-03",
        dateShort: "03 Agu 2026",
        role: "Backend Developer",
        skills: "PHP, Laravel, MySQL",
        score: 95,
        iconBg: "bg-blue-50",
        iconColor: "text-blue-600",
        iconPath:
            "M5 12a2 2 0 012-2h10a2 2 0 012 2v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6zM5 12V8a2 2 0 012-2h10a2 2 0 012 2v4M9 16h.01M13 16h.01",
    },
    {
        id: 2,
        date: "2026-07-20",
        dateShort: "20 Jul 2026",
        role: "Backend Developer",
        skills: "PHP, Laravel, MySQL",
        score: 90,
        iconBg: "bg-blue-50",
        iconColor: "text-blue-600",
        iconPath:
            "M5 12a2 2 0 012-2h10a2 2 0 012 2v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6zM5 12V8a2 2 0 012-2h10a2 2 0 012 2v4M9 16h.01M13 16h.01",
    },
    {
        id: 3,
        date: "2026-07-12",
        dateShort: "12 Jul 2026",
        role: "Frontend Developer",
        skills: "Vue.js, JavaScript, Tailwind",
        score: 82,
        iconBg: "bg-purple-50",
        iconColor: "text-purple-600",
        iconPath:
            "M4 6a2 2 0 012-2h12a2 2 0 012 2v2H4V6zM4 10h16v8a2 2 0 01-2 2H6a2 2 0 01-2-2v-8z",
    },
];

const sortOptions = [
    { value: "terbaru", label: "Terbaru" },
    { value: "skor", label: "Skor tertinggi" },
];

const sortBy = ref("terbaru");
const isSortOpen = ref(false);
const dropdownRef = ref(null);

function handleClickOutside(e) {
    if (dropdownRef.value && !dropdownRef.value.contains(e.target)) {
        isSortOpen.value = false;
    }
}

onMounted(() => document.addEventListener("click", handleClickOutside));
onUnmounted(() => document.removeEventListener("click", handleClickOutside));

const history = computed(() =>
    rawHistory.map((item, i) => ({ ...item, isLatest: i === 0 })),
);

const sortedHistory = computed(() => {
    const items = [...history.value];
    if (sortBy.value === "skor") {
        return items.sort((a, b) => b.score - a.score);
    }
    return items.sort((a, b) => new Date(b.date) - new Date(a.date));
});

const avgScore = computed(() =>
    Math.round(
        rawHistory.reduce((sum, h) => sum + h.score, 0) / rawHistory.length,
    ),
);

const trendLabel = computed(() => {
    if (rawHistory.length < 2) return "belum ada tren";
    const diff = rawHistory[0].score - rawHistory[1].score;
    if (diff > 0) return `naik ${diff} poin dari analisis sebelumnya`;
    if (diff < 0)
        return `turun ${Math.abs(diff)} poin dari analisis sebelumnya`;
    return "stabil dari analisis sebelumnya";
});
</script>
