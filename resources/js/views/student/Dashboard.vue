<template>
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Hero Banner -->
        <StudentHero>
            <!-- Alert Profil Belum Lengkap -->
            <div
                v-if="!isProfileLoading && !isProfileComplete"
                class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 rounded-xl border border-amber-500/30 bg-amber-500/10 backdrop-blur-md px-5 py-4 fade-up"
                role="alert"
            >
                <div class="flex items-center gap-3">
                    <svg
                        class="h-5 w-5 text-amber-400 shrink-0"
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
                    <p class="text-sm text-amber-200">
                        Profil Anda belum lengkap. Lengkapi profil terlebih
                        dahulu sebelum mengunggah CV.
                    </p>
                </div>
                <router-link
                    :to="{ name: 'StudentProfile' }"
                    class="shrink-0 text-sm font-semibold text-amber-300 hover:text-amber-100 underline transition-colors"
                >
                    Lengkapi Profil &rarr;
                </router-link>
            </div>

            <!-- Greeting Content -->
            <div
                class="relative z-10 pr-28 sm:pr-36 md:pr-40 lg:pr-48"
            >
                <p
                    class="text-xs font-medium text-blue-300 uppercase tracking-widest mb-1 animate-greeting"
                    style="animation-delay: 0.05s"
                >
                    {{ greetingTime }}
                </p>
                <h1
                    class="text-2xl md:text-3xl font-semibold text-white animate-greeting"
                    style="animation-delay: 0.15s"
                >
                    Halo, {{ studentName }} 👋
                </h1>
                <p
                    class="mt-2 text-sm text-blue-200/80 max-w-md animate-greeting"
                    style="animation-delay: 0.25s"
                >
                    <template v-if="isProfileComplete && lastAnalysis">
                        Kamu sudah
                        <span class="font-semibold text-white"
                            >{{ roadmapProgress }}%</span
                        >
                        menuju target karier sebagai
                        <span class="text-white font-medium">{{
                            lastAnalysis.role
                        }}</span
                        >.
                    </template>
                    <template v-else>
                        Lengkapi profilmu sekarang untuk memulai jalur persiapan
                        karier dan analisis CV berbasis AI.
                    </template>
                </p>
            </div>

            <!-- AI Maskot "mengintip" dari bawah kartu hero -->
            <template #peek>
                <div
                    class="absolute -bottom-6 right-3 sm:right-6 pointer-events-none select-none z-10 animate-greeting"
                    style="animation-delay: 0.4s"
                >
                    <div class="relative">
                        <span class="ai-halo"></span>
                        <img
                            src="@/assets/newaiimg.png"
                            alt="AI Maskot"
                            class="ai-breathe relative w-28 sm:w-32 md:w-36 lg:w-44"
                        />
                    </div>
                </div>
            </template>
        </StudentHero>

        <!-- Toast Notification (Pengganti alert kaku) -->
        <transition name="toast">
            <div
                v-if="showToast"
                class="fixed bottom-6 right-6 z-50 flex items-center gap-3 bg-slate-900 text-white px-5 py-3.5 rounded-xl shadow-2xl border border-amber-500/40"
            >
                <span class="text-amber-400 text-lg">🔒</span>
                <div class="text-xs">
                    <p class="font-semibold text-amber-300">
                        Profil Belum Lengkap
                    </p>
                    <p class="text-slate-300">
                        Silakan lengkapi profil terlebih dahulu.
                    </p>
                </div>
                <button
                    @click="showToast = false"
                    class="ml-2 text-slate-400 hover:text-white font-bold text-sm"
                >
                    ✕
                </button>
            </div>
        </transition>

        <!-- Metrics Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">
            <!-- Analisis Terakhir -->
            <div
                class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-7 fade-up flex flex-col sm:flex-row sm:items-center gap-6 transition-transform duration-300 hover:-translate-y-0.5"
                style="animation-delay: 0.05s"
            >
                <template v-if="isDashboardLoading">
                    <div
                        class="shrink-0 h-24 w-24 mx-auto sm:mx-0 rounded-full bg-slate-100 animate-pulse"
                    ></div>
                    <div class="flex-1 space-y-3">
                        <div
                            class="h-3 w-28 bg-slate-200 rounded animate-pulse"
                        ></div>
                        <div
                            class="h-5 w-44 bg-slate-200 rounded animate-pulse"
                        ></div>
                        <div
                            class="h-6 w-32 bg-slate-100 rounded-full animate-pulse"
                        ></div>
                    </div>
                </template>

                <template v-else>
                <div class="relative shrink-0 h-24 w-24 mx-auto sm:mx-0">
                    <svg viewBox="0 0 80 80" class="h-24 w-24 -rotate-90">
                        <circle
                            :cx="svgConfig.center"
                            :cy="svgConfig.center"
                            :r="svgConfig.radius"
                            fill="none"
                            stroke="#EEF2FF"
                            stroke-width="7"
                        />
                        <circle
                            v-if="isProfileComplete && lastAnalysis"
                            :cx="svgConfig.center"
                            :cy="svgConfig.center"
                            :r="svgConfig.radius"
                            fill="none"
                            stroke="#2563eb"
                            stroke-width="7"
                            stroke-linecap="round"
                            :stroke-dasharray="circleCircumference"
                            :stroke-dashoffset="scoreDashOffset"
                            class="score-ring"
                        />
                    </svg>
                    <span
                        class="absolute inset-0 flex items-center justify-center text-base font-bold text-slate-800"
                    >
                        {{
                            isProfileComplete && lastAnalysis
                                ? `${animatedScore}%`
                                : "--"
                        }}
                    </span>
                </div>

                <div class="min-w-0 text-center sm:text-left flex-1">
                    <h2
                        class="text-xs font-medium text-slate-400 uppercase tracking-wide"
                    >
                        Analisis Terakhir
                    </h2>
                    <p class="mt-1 text-lg font-semibold text-slate-800">
                        {{
                            isProfileComplete && lastAnalysis
                                ? lastAnalysis.role
                                : "Belum Ada Analisis"
                        }}
                    </p>

                    <!-- Badge Condition -->
                    <div class="mt-2">
                        <span
                            v-if="isProfileComplete && lastAnalysis"
                            class="inline-flex items-center gap-1 text-xs font-medium text-blue-700 bg-blue-50 px-2.5 py-1 rounded-full"
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
                            Match sangat tinggi
                        </span>
                        <span
                            v-else
                            class="inline-flex items-center gap-1 text-xs font-medium text-slate-500 bg-slate-100 px-2.5 py-1 rounded-full"
                        >
                            Belum ada data CV
                        </span>
                    </div>

                    <button
                        type="button"
                        @click="navigateToAnalysis"
                        class="block mt-3 text-sm font-medium text-blue-600 hover:text-blue-700 mx-auto sm:mx-0 transition-colors"
                    >
                        Lihat detail analisis &rarr;
                    </button>
                </div>
                </template>
            </div>

            <!-- Upload Terakhir -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-7 fade-up flex flex-col justify-center transition-transform duration-300 hover:-translate-y-0.5"
                style="animation-delay: 0.1s"
            >
                <template v-if="isDashboardLoading">
                    <div
                        class="h-12 w-12 rounded-xl bg-slate-100 animate-pulse mb-4"
                    ></div>
                    <div class="space-y-2">
                        <div
                            class="h-3 w-24 bg-slate-200 rounded animate-pulse"
                        ></div>
                        <div
                            class="h-5 w-32 bg-slate-200 rounded animate-pulse"
                        ></div>
                        <div
                            class="h-3 w-28 bg-slate-100 rounded animate-pulse"
                        ></div>
                    </div>
                </template>

                <template v-else>
                <div
                    class="h-12 w-12 rounded-xl bg-amber-50 flex items-center justify-center mb-4"
                >
                    <svg
                        class="h-6 w-6 text-amber-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                        />
                    </svg>
                </div>
                <h2
                    class="text-xs font-medium text-slate-400 uppercase tracking-wide"
                >
                    Upload Terakhir
                </h2>
                <p class="mt-1 text-lg font-semibold text-slate-800">
                    {{
                        isProfileComplete && lastUploadDate
                            ? lastUploadDate
                            : "-"
                    }}
                </p>
                <p class="text-xs text-slate-400 mt-1">
                    {{
                        isProfileComplete && lastUploadDate
                            ? "CV berhasil dianalisis"
                            : "Belum mengunggah CV"
                    }}
                </p>
                </template>
            </div>
        </div>

        <!-- Progress Roadmap -->
        <div
            class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8 mb-8 fade-up"
            style="animation-delay: 0.15s"
        >
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-base font-semibold text-slate-800">
                    Progress Roadmap
                </h2>
                <span
                    v-if="isDashboardLoading"
                    class="text-sm font-bold text-slate-400 bg-slate-100 px-3 py-1 rounded-full animate-pulse"
                >
                    --%
                </span>
                <span
                    v-else
                    class="text-sm font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full"
                >
                    {{ isProfileComplete ? roadmapProgress : 0 }}%
                </span>
            </div>

            <div v-if="isDashboardLoading" class="relative px-3">
                <div class="absolute top-3 left-3 right-3 h-1 rounded-full">
                    <div
                        class="h-full bg-slate-200 rounded-full animate-pulse"
                    ></div>
                </div>
                <div class="relative flex justify-between">
                    <div
                        v-for="n in 4"
                        :key="n"
                        class="flex flex-col items-center"
                    >
                        <div
                            class="h-6 w-6 rounded-full bg-slate-100 animate-pulse"
                        ></div>
                        <div
                            class="mt-3 h-3 w-14 bg-slate-100 rounded animate-pulse"
                        ></div>
                    </div>
                </div>
            </div>

            <div v-else class="relative px-3">
                <!-- Progress Track -->
                <div
                    class="absolute top-3 left-3 right-3 h-1 bg-slate-100 rounded-full"
                />
                <div
                    class="absolute top-3 left-3 right-3 h-1 overflow-hidden rounded-full"
                >
                    <div
                        class="progress-fill"
                        :style="{
                            transform: `scaleX(${roadmapProgressScale})`,
                        }"
                    >
                        <span class="progress-shimmer"></span>
                    </div>
                </div>

                <!-- Milestones -->
                <div class="relative flex justify-between">
                    <div
                        v-for="(milestone, index) in milestones"
                        :key="milestone.label"
                        class="flex flex-col items-center"
                    >
                        <div
                            class="h-6 w-6 rounded-full border-2 flex items-center justify-center text-[10px] font-bold transition-colors duration-500 z-10 milestone-dot"
                            :class="[
                                isProfileComplete &&
                                roadmapProgress >= milestone.threshold
                                    ? 'bg-emerald-500 border-emerald-500 text-white'
                                    : 'bg-white border-slate-300 text-slate-400',
                                isProfileComplete &&
                                roadmapProgress >= milestone.threshold
                                    ? 'milestone-pop'
                                    : '',
                            ]"
                        >
                            <svg
                                v-if="
                                    isProfileComplete &&
                                    roadmapProgress >= milestone.threshold
                                "
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
                            <span v-else>{{ index + 1 }}</span>
                        </div>
                        <span
                            class="mt-2 text-[10px] sm:text-xs text-center"
                            :class="
                                isProfileComplete &&
                                roadmapProgress >= milestone.threshold
                                    ? 'text-slate-700 font-medium'
                                    : 'text-slate-400'
                            "
                        >
                            {{ milestone.label }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Upload CV Card Wrapper -->
            <div class="relative group/tooltip">
                <!-- Popover (Tampil saat Hover di Desktop, ATAU saat di-tap/diklik di Mobile jika profil belum lengkap) -->
                <div
                    v-if="!isProfileComplete"
                    class="absolute bottom-full mb-3 left-1/2 -translate-x-1/2 w-72 bg-slate-900/95 backdrop-blur-md text-white rounded-xl p-4 shadow-xl border border-amber-500/30 opacity-0 group-hover/tooltip:opacity-100 group-active/tooltip:opacity-100 transition-all duration-200 pointer-events-none z-30"
                >
                    <div
                        class="flex items-center gap-2 text-amber-400 font-semibold text-xs mb-1"
                    >
                        <span>⚠️ Profil Belum Lengkap!</span>
                    </div>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Lengkapi profil kamu terlebih dahulu agar AI bisa
                        menganalisis CV secara akurat.
                    </p>
                    <div
                        class="absolute top-full left-1/2 -translate-x-1/2 border-8 border-transparent border-t-slate-900/95"
                    ></div>
                </div>

                <button
                    type="button"
                    @click="handleUploadClick"
                    :class="[
                        'w-full group rounded-2xl p-6 text-left transition-all duration-200 flex items-center justify-between fade-up relative overflow-hidden',
                        isProfileComplete
                            ? 'bg-blue-600 hover:bg-blue-700 text-white hover:-translate-y-0.5 hover:shadow-lg'
                            : 'bg-slate-100/80 text-slate-400 border border-slate-200/60 hover:border-amber-300/80 cursor-pointer',
                        isShaking ? 'animate-shake' : '',
                    ]"
                    style="animation-delay: 0.2s"
                >
                    <div>
                        <div class="flex items-center gap-2">
                            <p
                                class="font-semibold text-slate-800"
                                :class="{ 'text-white': isProfileComplete }"
                            >
                                Upload CV Baru
                            </p>
                            <span
                                v-if="!isProfileComplete"
                                class="text-[10px] bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full font-bold uppercase tracking-wider"
                            >
                                🔒 Terkunci
                            </span>
                        </div>
                        <p
                            class="text-sm mt-0.5"
                            :class="
                                isProfileComplete
                                    ? 'text-blue-100'
                                    : 'text-slate-400'
                            "
                        >
                            Dapatkan analisis skill terbaru
                        </p>
                    </div>
                    <svg
                        class="h-5 w-5 transition-transform shrink-0"
                        :class="[
                            isProfileComplete
                                ? 'text-white group-hover:translate-x-1'
                                : 'text-slate-400',
                        ]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"
                        />
                    </svg>
                </button>
            </div>

            <!-- Lihat Hasil Analisis -->
            <button
                type="button"
                @click="navigateToAnalysis"
                class="group bg-white border border-slate-200 hover:bg-slate-50 text-slate-800 rounded-2xl p-6 text-left transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg fade-up flex items-center justify-between"
                style="animation-delay: 0.25s"
            >
                <div>
                    <p class="font-semibold">Lihat Hasil Analisis</p>
                    <p class="text-sm text-slate-400 mt-0.5">
                        Cek riwayat & detail skor kamu
                    </p>
                </div>
                <svg
                    class="h-5 w-5 text-blue-600 transition-transform group-hover:translate-x-1 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M14 5l7 7m0 0l-7 7m7-7H3"
                    />
                </svg>
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import StudentHero from "@/components/student/StudentHero.vue";
import analysisService from "@/services/student/analysisService";

const authStore = useAuthStore();
const router = useRouter();

// State & Timers
const showToast = ref(false);
const isShaking = ref(false);
const isProfileLoading = ref(true);
let toastTimer = null;
let scoreTimer = null;

// User State
const studentName = computed(() => authStore.user?.name ?? "Mahasiswa");
const isProfileComplete = computed(() => authStore.isProfileComplete ?? false);

// Data Analisis Terakhir (dinamis dari API, dengan cache agar cepat saat kembali)
const CACHE_KEY = "latestAnalysis";

function readCachedAnalysis() {
    try {
        const raw = localStorage.getItem(CACHE_KEY);
        return raw ? JSON.parse(raw) : null;
    } catch {
        return null;
    }
}

function writeCachedAnalysis(data) {
    try {
        localStorage.setItem(CACHE_KEY, JSON.stringify(data));
    } catch {
        /* ignore quota errors */
    }
}

function clearCachedAnalysis() {
    try {
        localStorage.removeItem(CACHE_KEY);
    } catch {
        /* ignore */
    }
}

const latestAnalysis = ref(readCachedAnalysis());
const isDashboardLoading = ref(!latestAnalysis.value);

const lastAnalysis = computed(() => {
    if (!latestAnalysis.value) return null;
    return {
        id: latestAnalysis.value.id,
        role: latestAnalysis.value.career?.title ?? "Belum ada rekomendasi",
        score: latestAnalysis.value.match_score,
    };
});

const lastUploadDate = computed(() => {
    if (!latestAnalysis.value?.created_at) return null;
    return new Date(latestAnalysis.value.created_at).toLocaleDateString(
        "id-ID",
        {
            day: "numeric",
            month: "long",
            year: "numeric",
        },
    );
});

const roadmapProgress = computed(() => {
    const score = lastAnalysis.value?.score ?? 0;
    return Math.min(Math.max(Math.round(score), 0), 100);
});

const roadmapProgressScale = computed(
    () => (isProfileComplete.value ? roadmapProgress.value : 0) / 100,
);

const animatedScore = ref(0);

function animateScore(target) {
    if (scoreTimer) cancelAnimationFrame(scoreTimer);
    const start = animatedScore.value;
    const duration = 1000;
    const startTime = performance.now();
    const step = (now) => {
        const elapsed = now - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        animatedScore.value = Math.round(start + (target - start) * eased);
        if (progress < 1) {
            scoreTimer = requestAnimationFrame(step);
        } else {
            scoreTimer = null;
        }
    };
    scoreTimer = requestAnimationFrame(step);
}

const milestones = [
    { label: "Mulai", threshold: 0 },
    { label: "Skill Match", threshold: 33 },
    { label: "Siap Magang", threshold: 66 },
    { label: "Siap Kerja", threshold: 100 },
];

// SVG Config & Calculations
const svgConfig = {
    center: 40,
    radius: 34,
};

const circleCircumference = computed(() => 2 * Math.PI * svgConfig.radius);
const scoreDashOffset = computed(() => {
    if (!lastAnalysis.value) return circleCircumference.value;
    return (
        circleCircumference.value -
        (circleCircumference.value * lastAnalysis.value.score) / 100
    );
});

// Dynamic Greeting
const greetingTime = computed(() => {
    const hour = new Date().getHours();
    if (hour < 11) return "Selamat pagi";
    if (hour < 15) return "Selamat siang";
    if (hour < 18) return "Selamat sore";
    return "Selamat malam";
});

// Actions
function handleUploadClick() {
    if (!isProfileComplete.value) {
        // Efek Shake pada Tombol
        isShaking.value = true;
        setTimeout(() => {
            isShaking.value = false;
        }, 500);

        // Tampilkan Toast
        showToast.value = true;
        if (toastTimer) clearTimeout(toastTimer);
        toastTimer = setTimeout(() => {
            showToast.value = false;
        }, 3500);

        // Arahkan ke Halaman Lengkapi Profil
        router.push({ name: "StudentProfile" });
        return;
    }
    router.push({ name: "StudentCV" });
}

function navigateToAnalysis() {
    if (lastAnalysis.value?.id) {
        router.push({
            name: "StudentHasilAnalisis",
            params: { id: lastAnalysis.value.id },
        });
        return;
    }
    router.push({ name: "StudentCV" });
}

onMounted(async () => {
    // Jika ada cache, tampilkan dulu & mulai animasi skor tanpa menunggu jaringan
    if (latestAnalysis.value) {
        animateScore(lastAnalysis.value?.score ?? 0);
    }

    // Jalankan fetchMe & getLatest secara paralel (dulu berurutan → 2x lambat)
    try {
        await Promise.all([
            authStore.fetchMe(),
            analysisService
                .getLatest()
                .then((result) => {
                    latestAnalysis.value = result.data;
                    writeCachedAnalysis(result.data);
                    animateScore(lastAnalysis.value?.score ?? 0);
                })
                .catch(() => {
                    latestAnalysis.value = null;
                    clearCachedAnalysis();
                }),
        ]);
    } finally {
        isProfileLoading.value = false;
        isDashboardLoading.value = false;
    }
});

onUnmounted(() => {
    if (toastTimer) clearTimeout(toastTimer);
    if (scoreTimer) cancelAnimationFrame(scoreTimer);
});
</script>

<style scoped>
.fade-up {
    animation: fadeUp 0.6s cubic-bezier(0.22, 1, 0.36, 1) backwards;
    will-change: transform, opacity;
    backface-visibility: hidden;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translate3d(0, 12px, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

/* Greeting entrance (stagger) */
.animate-greeting {
    animation: greetingIn 0.7s cubic-bezier(0.16, 1, 0.3, 1) backwards;
}

@keyframes greetingIn {
    from {
        opacity: 0;
        transform: translate3d(0, 10px, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

/* AI maskot breathing + halo */
.ai-breathe {
    animation: aiBreathe 3.5s ease-in-out infinite;
    filter: drop-shadow(0 12px 24px rgba(37, 99, 235, 0.45));
    will-change: transform;
    backface-visibility: hidden;
}

@keyframes aiBreathe {
    0%,
    100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.04);
    }
}

.ai-halo {
    position: absolute;
    inset: -12px;
    border-radius: 9999px;
    background: radial-gradient(
        circle,
        rgba(96, 165, 250, 0.55),
        rgba(37, 99, 235, 0.25) 45%,
        transparent 70%
    );
    filter: blur(20px);
    animation: aiGlow 3.5s ease-in-out infinite;
    will-change: transform, opacity;
    backface-visibility: hidden;
}

/* Bayangan lantai supaya maskot terlihat berdiri */
.ai-shadow {
    position: absolute;
    bottom: -6px;
    left: 50%;
    transform: translateX(-50%);
    width: 70%;
    height: 14px;
    border-radius: 9999px;
    background: radial-gradient(
        ellipse at center,
        rgba(2, 6, 23, 0.4),
        transparent 70%
    );
    filter: blur(5px);
}

@media (min-width: 768px) {
    .ai-halo {
        inset: -20px;
    }
}

@keyframes aiGlow {
    0%,
    100% {
        opacity: 0.7;
        transform: scale(0.92);
    }
    50% {
        opacity: 1;
        transform: scale(1.08);
    }
}

/* Progress bar fill + shimmer */
.progress-fill {
    position: absolute;
    inset: 0;
    height: 100%;
    width: 100%;
    background: #10b981;
    border-radius: 9999px;
    transform-origin: left center;
    transition: transform 1.2s cubic-bezier(0.22, 1, 0.36, 1);
    will-change: transform;
    backface-visibility: hidden;
}

.progress-shimmer {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(255, 255, 255, 0.6),
        transparent
    );
    animation: shimmer 1.8s infinite;
}

@keyframes shimmer {
    0% {
        transform: translateX(-100%);
    }
    100% {
        transform: translateX(100%);
    }
}

/* Milestone dots */
.milestone-dot {
    position: relative;
}

.milestone-pop {
    animation: milestonePop 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) backwards;
    box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.5);
    will-change: transform;
    backface-visibility: hidden;
}

.milestone-pop::after {
    content: "";
    position: absolute;
    inset: -4px;
    border-radius: 9999px;
    border: 2px solid rgba(16, 185, 129, 0.5);
    animation: pulseRing 2s infinite;
}

@keyframes milestonePop {
    0% {
        transform: scale(0.4);
    }
    60% {
        transform: scale(1.2);
    }
    100% {
        transform: scale(1);
    }
}

@keyframes pulseRing {
    0% {
        transform: scale(0.8);
        opacity: 1;
    }
    100% {
        transform: scale(1.6);
        opacity: 0;
    }
}

/* Shake Animation untuk tombol terkunci saat dipencet */
@keyframes shake {
    0%,
    100% {
        transform: translateX(0);
    }
    20%,
    60% {
        transform: translateX(-4px);
    }
    40%,
    80% {
        transform: translateX(4px);
    }
}

.animate-shake {
    animation: shake 0.4s ease-in-out;
}

.score-ring {
    transition: stroke-dashoffset 1.2s cubic-bezier(0.22, 1, 0.36, 1);
    will-change: stroke-dashoffset;
}

/* Toast Transitions */
.toast-enter-active,
.toast-leave-active {
    transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
}
.toast-enter-from,
.toast-leave-to {
    opacity: 0;
    transform: translateY(16px) scale(0.95);
}

/* Hormati user yang mematikan animasi (aksesibilitas & performa) */
@media (prefers-reduced-motion: reduce) {
    .fade-up,
    .animate-greeting,
    .ai-breathe,
    .ai-halo,
    .progress-shimmer,
    .milestone-pop,
    .milestone-pop::after,
    .animate-shake,
    .toast-enter-active,
    .toast-leave-active {
        animation: none !important;
        transition: none !important;
    }
    .progress-fill {
        transition: none !important;
    }
}
</style>
