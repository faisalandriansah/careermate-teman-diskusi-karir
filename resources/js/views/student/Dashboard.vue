<template>
    <div class="container mx-auto px-4 py-8 max-w-5xl">
        <!-- Hero Banner -->
        <div
            class="hero relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 p-6 md:p-10 mb-8 fade-up"
        >
            <!-- Alert Profil Belum Lengkap -->
            <div
                v-if="!isProfileComplete"
                class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 rounded-xl border border-amber-200/40 bg-amber-500/10 backdrop-blur-sm px-5 py-4 fade-up"
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
                    class="shrink-0 text-sm font-medium text-amber-300 hover:text-amber-100 underline"
                >
                    Lengkapi Profil
                </router-link>
            </div>

            <!-- Glow Orbs -->
            <div class="orb orb-blue" />
            <div class="orb orb-amber" />

            <!-- Route Line Background -->
            <svg
                class="absolute right-0 top-0 h-full w-1/2 opacity-[0.08] pointer-events-none"
                viewBox="0 0 200 200"
                fill="none"
                aria-hidden="true"
            >
                <path
                    d="M0 150 Q 60 20 120 100 T 200 40"
                    stroke="white"
                    stroke-width="3"
                    stroke-dasharray="6 8"
                />
            </svg>

            <div class="relative z-10">
                <p
                    class="text-xs font-medium text-indigo-300 uppercase tracking-widest mb-1"
                >
                    {{ greetingTime }}
                </p>
                <h1 class="text-2xl md:text-3xl font-semibold text-white">
                    Halo, {{ studentName }} 👋
                </h1>
                <p class="mt-2 text-sm text-indigo-200/80 max-w-md">
                    Kamu sudah
                    <span class="font-semibold text-white"
                        >{{ roadmapProgress }}%</span
                    >
                    menuju target karier sebagai
                    <span class="text-white font-medium">{{
                        lastAnalysis.role
                    }}</span
                    >.
                </p>
            </div>
        </div>

        <!-- Metrics Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">
            <!-- Analisis Terakhir -->
            <div
                class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-7 fade-up flex flex-col sm:flex-row sm:items-center gap-6"
                style="animation-delay: 0.05s"
            >
                <div class="relative shrink-0 h-24 w-24 mx-auto sm:mx-0">
                    <svg viewBox="0 0 80 80" class="h-24 w-24 -rotate-90">
                        <circle
                            cx="40"
                            cy="40"
                            :r="circleRadius"
                            fill="none"
                            stroke="#EEF2FF"
                            stroke-width="7"
                        />
                        <circle
                            cx="40"
                            cy="40"
                            :r="circleRadius"
                            fill="none"
                            stroke="#2563EB"
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
                        {{ lastAnalysis.score }}%
                    </span>
                </div>

                <div class="min-w-0 text-center sm:text-left flex-1">
                    <h2
                        class="text-xs font-medium text-slate-400 uppercase tracking-wide"
                    >
                        Analisis Terakhir
                    </h2>
                    <p class="mt-1 text-lg font-semibold text-slate-800">
                        {{ lastAnalysis.role }}
                    </p>
                    <span
                        class="inline-flex items-center gap-1 mt-2 text-xs font-medium text-blue-700 bg-blue-50 px-2.5 py-1 rounded-full"
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
                    <button
                        type="button"
                        @click="navigateToAnalysis"
                        class="block mt-3 text-sm font-medium text-blue-600 hover:text-blue-700 mx-auto sm:mx-0"
                    >
                        Lihat detail analisis &rarr;
                    </button>
                </div>
            </div>

            <!-- Upload Terakhir -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-7 fade-up flex flex-col justify-center"
                style="animation-delay: 0.1s"
            >
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
                    {{ lastUploadDate }}
                </p>
                <p class="text-xs text-slate-400 mt-1">
                    CV berhasil dianalisis
                </p>
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
                    class="text-sm font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full"
                >
                    {{ roadmapProgress }}%
                </span>
            </div>

            <div class="relative px-3">
                <!-- Progress Track -->
                <div
                    class="absolute top-3 left-3 right-3 h-1 bg-slate-100 rounded-full"
                />
                <div
                    class="absolute top-3 left-3 h-1 bg-emerald-500 rounded-full transition-all duration-700"
                    :style="{ width: `${roadmapProgress}%` }"
                />

                <!-- Milestones -->
                <div class="relative flex justify-between">
                    <div
                        v-for="(milestone, index) in milestones"
                        :key="milestone.label"
                        class="flex flex-col items-center"
                    >
                        <div
                            class="h-6 w-6 rounded-full border-2 flex items-center justify-center text-[10px] font-bold transition-colors duration-500 z-10"
                            :class="
                                roadmapProgress >= milestone.threshold
                                    ? 'bg-emerald-500 border-emerald-500 text-white'
                                    : 'bg-white border-slate-300 text-slate-400'
                            "
                        >
                            <svg
                                v-if="roadmapProgress >= milestone.threshold"
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
                            class="mt-2 text-xs text-center"
                            :class="
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
            <button
                type="button"
                @click="handleUploadClick"
                :disabled="!isProfileComplete"
                :class="[
                    'group rounded-2xl p-6 text-left transition-all duration-200 flex items-center justify-between fade-up',
                    isProfileComplete
                        ? 'bg-blue-600 hover:bg-blue-700 text-white hover:-translate-y-0.5 hover:shadow-lg'
                        : 'bg-slate-100 text-slate-400 cursor-not-allowed',
                ]"
                style="animation-delay: 0.2s"
            >
                <div>
                    <p class="font-semibold">Upload CV Baru</p>
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
                    class="h-5 w-5 transition-transform group-hover:translate-x-1 shrink-0"
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
import { ref, computed, onMounted } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";

const authStore = useAuthStore();
const router = useRouter();

// User State
const studentName = computed(() => authStore.user?.name ?? "Mahasiswa");
const isProfileComplete = computed(() => authStore.isProfileComplete ?? false);

// Data Mock / State
const lastAnalysis = ref({
    role: "Backend Developer",
    score: 95,
});
const lastUploadDate = ref("03 Agustus 2026");
const roadmapProgress = ref(40);

const milestones = [
    { label: "Mulai", threshold: 0 },
    { label: "Skill Match", threshold: 33 },
    { label: "Siap Magang", threshold: 66 },
    { label: "Siap Kerja", threshold: 100 },
];

// Computed SVG Math
const circleRadius = 34;
const circleCircumference = computed(() => 2 * Math.PI * circleRadius);
const scoreDashOffset = computed(() => {
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
        alert("Silakan lengkapi profil terlebih dahulu.");
        router.push({ name: "StudentProfile" });
        return;
    }
    router.push({ name: "StudentCV" });
}

function navigateToAnalysis() {
    router.push({ name: "StudentCV" });
}

onMounted(async () => {
    if (!authStore.user) {
        await authStore.fetchMe();
    }
});
</script>

<style scoped>
.fade-up {
    animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(12px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.score-ring {
    transition: stroke-dashoffset 1s ease-out;
}

.orb {
    position: absolute;
    border-radius: 9999px;
    filter: blur(40px);
    opacity: 0.25;
    pointer-events: none;
}

.orb-blue {
    width: 180px;
    height: 180px;
    background: #3b82f6;
    top: -60px;
    right: 40px;
}

.orb-amber {
    width: 140px;
    height: 140px;
    background: #f59e0b;
    bottom: -50px;
    right: 180px;
}
</style>
