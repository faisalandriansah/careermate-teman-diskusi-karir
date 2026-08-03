<template>
    <div class="space-y-6">
        <!-- Header -->
        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-700 p-6 shadow-lg animate-fade-in-up"
        >
            <!-- dekorasi blur -->
            <div
                class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/10 blur-2xl"
            ></div>
            <div
                class="absolute -bottom-8 right-20 h-24 w-24 rounded-full bg-white/10 blur-xl"
            ></div>

            <div
                class="relative flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between"
            >
                <div>
                    <p class="text-sm font-medium text-blue-100">
                        CareerMate Admin
                    </p>
                    <h1 class="mt-1 text-2xl font-semibold text-white">
                        {{ greeting }}, Admin
                    </h1>
                    <p class="mt-2 text-sm text-blue-100">
                        Selamat datang kembali di CareerMate. Ini ringkasan
                        sistem hari ini.
                    </p>
                </div>
                <div
                    class="flex items-center gap-2 rounded-full bg-white/15 px-3 py-1 text-sm font-medium text-white backdrop-blur"
                >
                    <span class="relative flex h-2.5 w-2.5">
                        <span
                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"
                        ></span>
                        <span
                            class="relative inline-flex h-2.5 w-2.5 rounded-full bg-emerald-400"
                        ></span>
                    </span>
                    Live monitoring
                </div>
            </div>
        </div>

        <!-- Ringkasan Sistem -->
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div
                v-for="(item, index) in summary"
                :key="item.title"
                class="animate-fade-in-up rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_8px_30px_rgba(15,23,42,0.04)] transition-all duration-300 hover:-translate-y-0.5 hover:shadow-[0_12px_30px_rgba(15,23,42,0.08)]"
                :style="{ animationDelay: `${index * 80}ms` }"
            >
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            {{ item.title }}
                        </p>
                        <p class="mt-2 text-3xl font-semibold text-slate-900">
                            {{ item.displayValue }}
                        </p>
                        <p
                            class="mt-1 text-xs font-medium"
                            :class="
                                item.trend >= 0
                                    ? 'text-emerald-600'
                                    : 'text-red-500'
                            "
                        >
                            {{ item.trend >= 0 ? "+" : "" }}{{ item.trend }}%
                            bulan ini
                        </p>
                    </div>
                    <div
                        :class="item.iconBg"
                        class="rounded-2xl p-3 transition-transform duration-300 hover:scale-105"
                    >
                        <svg
                            class="h-6 w-6"
                            :class="item.iconColor"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                v-for="path in item.paths"
                                :key="path"
                                :d="path"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                            />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Penggunaan + Grafik Career Recommendation -->
        <div class="grid gap-6 xl:grid-cols-[1.15fr_0.85fr]">
            <div
                class="animate-fade-in-up rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]"
                style="animation-delay: 150ms"
            >
                <div class="mb-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">
                            Statistik Penggunaan
                        </h2>
                        <p class="text-sm text-slate-500">
                            Aktivitas upload CV dan analisis mahasiswa.
                        </p>
                    </div>
                    <span
                        class="rounded-full bg-blue-50 px-3 py-1 text-sm font-medium text-blue-700"
                        >This month</span
                    >
                </div>
                <div class="space-y-4">
                    <div
                        v-for="item in usageStats"
                        :key="item.label"
                        class="rounded-xl border border-slate-100 bg-slate-50 p-4"
                    >
                        <div
                            class="mb-2 flex items-center justify-between text-sm"
                        >
                            <span class="font-medium text-slate-700">{{
                                item.label
                            }}</span>
                            <span class="font-semibold text-slate-900"
                                >{{ item.value }}
                                <span class="font-normal text-slate-400"
                                    >({{ item.percent }}%)</span
                                ></span
                            >
                        </div>
                        <div
                            class="h-2.5 overflow-hidden rounded-full bg-slate-200"
                        >
                            <div
                                class="h-2.5 w-full origin-left rounded-full bar-fill"
                                :class="item.color"
                                :style="{
                                    transform: barsReady
                                        ? `scaleX(${item.percent / 100})`
                                        : 'scaleX(0)',
                                }"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="animate-fade-in-up rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]"
                style="animation-delay: 200ms"
            >
                <div class="mb-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">
                            Career Recommendation
                        </h2>
                        <p class="text-sm text-slate-500">
                            Distribusi hasil rekomendasi.
                        </p>
                    </div>
                    <span
                        class="rounded-full bg-violet-50 px-3 py-1 text-sm font-medium text-violet-700"
                        >Summary</span
                    >
                </div>
                <div class="flex flex-col items-center gap-6">
                    <div
                        class="relative h-40 w-40 animate-scale-in rounded-full"
                        style="animation-delay: 350ms"
                        :style="{ background: donutGradient }"
                    >
                        <div
                            class="absolute inset-3 flex flex-col items-center justify-center rounded-full bg-white"
                        >
                            <p class="text-2xl font-semibold text-slate-900">
                                {{ totalRecommendation }}
                            </p>
                            <p class="text-xs text-slate-500">Total</p>
                        </div>
                    </div>
                    <div class="w-full space-y-2">
                        <div
                            v-for="slice in careerDistribution"
                            :key="slice.label"
                            class="flex items-center justify-between text-sm transition-colors duration-200 hover:bg-slate-50 rounded-lg px-1 -mx-1"
                        >
                            <div class="flex items-center gap-2">
                                <span
                                    class="h-2.5 w-2.5 rounded-full"
                                    :style="{ backgroundColor: slice.color }"
                                ></span>
                                <span class="font-medium text-slate-700">{{
                                    slice.label
                                }}</span>
                            </div>
                            <span class="text-slate-500"
                                >{{ slice.value }}%</span
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Skill Terpopuler + Aktivitas Terbaru -->
        <div class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
            <div
                class="animate-fade-in-up rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]"
                style="animation-delay: 250ms"
            >
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-slate-900">
                        Skill Terpopuler
                    </h2>
                    <span
                        class="rounded-full bg-emerald-50 px-3 py-1 text-sm font-medium text-emerald-700"
                        >Top 3</span
                    >
                </div>
                <div class="space-y-4">
                    <div
                        v-for="skill in popularSkills"
                        :key="skill.name"
                        class="rounded-xl border border-slate-100 bg-slate-50 p-4"
                    >
                        <div
                            class="mb-2 flex items-center justify-between text-sm"
                        >
                            <span class="font-medium text-slate-700">{{
                                skill.name
                            }}</span>
                            <span class="text-slate-500"
                                >{{ skill.count }} mahasiswa</span
                            >
                        </div>
                        <div
                            class="h-2.5 overflow-hidden rounded-full bg-slate-200"
                        >
                            <div
                                class="h-2.5 w-full origin-left rounded-full bg-blue-500 bar-fill"
                                :style="{
                                    transform: barsReady
                                        ? `scaleX(${skill.percent / 100})`
                                        : 'scaleX(0)',
                                }"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="animate-fade-in-up rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]"
                style="animation-delay: 300ms"
            >
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-slate-900">
                        Aktivitas Terbaru
                    </h2>
                    <span
                        class="rounded-full bg-amber-50 px-3 py-1 text-sm font-medium text-amber-700"
                        >Fresh</span
                    >
                </div>
                <div class="space-y-3">
                    <div
                        v-for="(activity, index) in recentActivities"
                        :key="activity.title"
                        class="animate-fade-in-up rounded-xl border border-slate-100 bg-slate-50 px-4 py-3 transition-colors duration-200 hover:bg-slate-100"
                        :style="{ animationDelay: `${350 + index * 80}ms` }"
                    >
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-slate-800">
                                {{ activity.title }}
                            </p>
                            <span class="text-xs text-slate-400">{{
                                activity.time
                            }}</span>
                        </div>
                        <p class="mt-1 text-sm text-slate-500">
                            {{ activity.detail }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Akses Cepat -->
        <div
            class="animate-fade-in-up rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]"
            style="animation-delay: 400ms"
        >
            <div class="mb-4">
                <h2 class="text-lg font-semibold text-slate-900">
                    Akses Cepat
                </h2>
                <p class="text-sm text-slate-500">
                    Tindakan yang sering digunakan.
                </p>
            </div>
            <div class="grid gap-3 md:grid-cols-2 xl:grid-cols-4">
                <button
                    v-for="action in quickActions"
                    :key="action.title"
                    @click="$router.push(action.to)"
                    class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white p-4 text-left transition-all duration-300 ease-out hover:-translate-y-0.5 hover:border-blue-300 hover:shadow-[0_8px_30px_rgba(15,23,42,0.06)] active:scale-[0.98]"
                >
                    <div
                        :class="action.iconBg"
                        class="rounded-xl p-2.5 transition-transform duration-300"
                    >
                        <svg
                            class="h-5 w-5"
                            :class="action.iconColor"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                v-for="path in action.paths"
                                :key="path"
                                :d="path"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                            />
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-slate-800">{{
                        action.title
                    }}</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, ref, onMounted } from "vue";
import dashboardService from "@/services/dashboardService";

// ---- Greeting dinamis ----
const greeting = computed(() => {
    const h = new Date().getHours();
    if (h < 11) return "Selamat Pagi";
    if (h < 15) return "Selamat Siang";
    if (h < 18) return "Selamat Sore";
    return "Selamat Malam";
});

// state
const loading = ref(true);
const error = ref(null);
const barsReady = ref(false);
const donutProgress = ref(0);

const summaryRaw = ref([]);
const usageStats = ref([]);
const careerDistribution = ref([]);
const popularSkills = ref([]);
const recentActivities = ref([]);

// ---- Icon map (dipisah dari data API, biar backend cuma kirim angka) ----
const iconMap = {
    mahasiswa: {
        title: "Mahasiswa",
        iconBg: "bg-blue-50",
        iconColor: "text-blue-600",
        paths: [
            "M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z",
        ],
    },
    skill: {
        title: "Skill",
        iconBg: "bg-emerald-50",
        iconColor: "text-emerald-600",
        paths: ["M13 10V3L4 14h7v7l9-11h-7z"],
    },
    career: {
        title: "Karier",
        iconBg: "bg-violet-50",
        iconColor: "text-violet-600",
        paths: [
            "M20 7h-3V5a2 2 0 00-2-2H9a2 2 0 00-2 2v2H4a1 1 0 00-1 1v3a2 2 0 002 2h14a2 2 0 002-2V8a1 1 0 00-1-1zM9 5h6v2H9V5zM3 13v6a2 2 0 002 2h14a2 2 0 002-2v-6H3z",
        ],
    },
    magang: {
        title: "Magang",
        iconBg: "bg-amber-50",
        iconColor: "text-amber-600",
        paths: [
            "M12 14l9-5-9-5-9 5 9 5zM12 14l6.16-3.42A12.083 12.083 0 0112 21a12.083 12.083 0 01-6.16-10.42L12 14z",
        ],
    },
};

const usageColorMap = {
    sudah_upload: { label: "Sudah Upload CV", color: "bg-emerald-500" },
    belum_upload: { label: "Belum Upload", color: "bg-amber-500" },
    total_analisis: { label: "Total Analisis", color: "bg-blue-500" },
};

const distributionColors = [
    "#3b82f6",
    "#10b981",
    "#8b5cf6",
    "#f59e0b",
    "#ef4444",
];

const quickActions = [
    {
        title: "Tambah Skill",
        to: "/admin/skill/create",
        iconBg: "bg-blue-50",
        iconColor: "text-blue-600",
        paths: ["M12 4v16m8-8H4"],
    },
    {
        title: "Tambah Career",
        to: "/admin/career/create",
        iconBg: "bg-emerald-50",
        iconColor: "text-emerald-600",
        paths: [
            "M20 7h-3V5a2 2 0 00-2-2H9a2 2 0 00-2 2v2H4a1 1 0 00-1 1v3a2 2 0 002 2h14a2 2 0 002-2V8a1 1 0 00-1-1z",
        ],
    },
    {
        title: "Tambah Magang",
        to: "/admin/internship/create",
        iconBg: "bg-amber-50",
        iconColor: "text-amber-600",
        paths: ["M12 14l9-5-9-5-9 5 9 5z"],
    },
    {
        title: "Career Mapping",
        to: "/admin/mapping",
        iconBg: "bg-violet-50",
        iconColor: "text-violet-600",
        paths: [
            "M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7",
        ],
    },
];

// count up composable
function useCountUp(target, duration = 900) {
    const value = ref(0);
    const start = performance.now();
    const step = (now) => {
        const progress = Math.min((now - start) / duration, 1);
        const eased = 1 - (1 - progress) * (1 - progress);
        value.value = Math.floor(eased * target);
        if (progress < 1) requestAnimationFrame(step);
        else value.value = target;
    };
    requestAnimationFrame(step);
    return value;
}

function animateDonut(duration = 900) {
    const start = performance.now();
    const step = (now) => {
        const progress = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        donutProgress.value = eased;
        if (progress < 1) requestAnimationFrame(step);
    };
    requestAnimationFrame(step);
}

const summary = computed(() =>
    summaryRaw.value.map((item) => ({
        ...iconMap[item.key],
        trend: item.trend ?? 0,
        displayValue: item.animated,
    })),
);

const totalRecommendation = computed(() =>
    careerDistribution.value.reduce((sum, s) => sum + s.rawValue, 0),
);

const donutGradient = computed(() => {
    const progress = donutProgress.value;
    let cumulative = 0;
    const stops = careerDistribution.value.map((slice) => {
        const start = cumulative * progress;
        cumulative += slice.value;
        const end = cumulative * progress;
        return `${slice.color} ${start}% ${end}%`;
    });
    stops.push(`#e2e8f0 ${cumulative * progress}% 100%`);
    return `conic-gradient(${stops.join(", ")})`;
});

async function fetchDashboard() {
    loading.value = true;
    error.value = null;
    try {
        const { data } = await dashboardService.getDashboardData();

        summaryRaw.value = Object.entries(data.summary).map(([key, value]) => ({
            key,
            animated: useCountUp(value),
        }));

        const usageTotal = data.usage_stats.total_analisis || 1;
        usageStats.value = Object.entries(data.usage_stats).map(
            ([key, value]) => ({
                label: usageColorMap[key].label,
                value,
                percent: Math.round((value / usageTotal) * 100),
                color: usageColorMap[key].color,
            }),
        );

        const distTotal =
            data.career_distribution.reduce((s, d) => s + d.value, 0) || 1;
        careerDistribution.value = data.career_distribution.map((item, i) => ({
            label: item.label,
            rawValue: item.value,
            value: Math.round((item.value / distTotal) * 100),
            color: distributionColors[i % distributionColors.length],
        }));

        const maxSkillCount = Math.max(
            ...data.popular_skills.map((s) => s.count),
            1,
        );
        popularSkills.value = data.popular_skills.map((s) => ({
            name: s.name,
            count: s.count,
            percent: Math.round((s.count / maxSkillCount) * 100),
        }));

        recentActivities.value = data.recent_activities;

        requestAnimationFrame(() => {
            barsReady.value = true;
            animateDonut();
        });
    } catch (err) {
        error.value = "Gagal memuat data dashboard.";
        console.error(err);
    } finally {
        loading.value = false;
    }
}

onMounted(fetchDashboard);
</script>
<style scoped>
/* Isolasi elemen blur ke GPU layer sendiri biar gak numpuk kerja render bareng animasi lain */
.absolute.blur-2xl,
.absolute.blur-xl {
    transform: translateZ(0);
    will-change: transform;
}

/* Fade-in-up yang lebih mengalir, override animasi default Tailwind */
.animate-fade-in-up {
    animation: fadeInUpSmooth 0.5s cubic-bezier(0.22, 1, 0.36, 1) both;
    will-change: transform, opacity;
    backface-visibility: hidden;
}

@keyframes fadeInUpSmooth {
    from {
        opacity: 0;
        transform: translate3d(0, 14px, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

/* Donut chart masuk lebih halus, gak nyentak pas scale */
.animate-scale-in {
    animation: scaleInSmooth 0.6s cubic-bezier(0.22, 1, 0.36, 1) both;
    will-change: transform, opacity;
}

@keyframes scaleInSmooth {
    from {
        opacity: 0;
        transform: scale3d(0.92, 0.92, 1);
    }
    to {
        opacity: 1;
        transform: scale3d(1, 1, 1);
    }
}

/* Progress bar pakai transform, bukan width, biar gak reflow tiap frame */
.bar-fill {
    transition: transform 0.85s cubic-bezier(0.22, 1, 0.36, 1);
    will-change: transform;
    backface-visibility: hidden;
}

/* Hover card gak numpuk transition properti beda-beda, disatuin biar konsisten */
.hover\:-translate-y-0\.5,
.hover\:scale-105 {
    transition-timing-function: cubic-bezier(0.22, 1, 0.36, 1);
}
</style>
