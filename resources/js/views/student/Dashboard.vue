<template>
    <div class="container mx-auto px-4 py-8 max-w-5xl">
        <!-- Hero -->
        <div
            class="hero relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 p-8 md:p-10 mb-8 fade-up"
        >
            <!-- glow orbs -->
            <div class="orb orb-blue"></div>
            <div class="orb orb-amber"></div>
            <!-- route line -->
            <svg
                class="absolute right-0 top-0 h-full w-1/2 opacity-[0.08]"
                viewBox="0 0 200 200"
                fill="none"
            >
                <path
                    d="M0 150 Q 60 20 120 100 T 200 40"
                    stroke="white"
                    stroke-width="3"
                    stroke-dasharray="6 8"
                />
            </svg>

            <div class="relative">
                <p
                    class="text-xs font-medium text-indigo-300 uppercase tracking-widest mb-1"
                >
                    {{ greetingTime }}
                </p>
                <h1 class="text-2xl md:text-3xl font-semibold text-white">
                    Halo, {{ studentName }} 👋
                </h1>
                <p class="mt-2 text-sm text-indigo-200/80 max-w-md">
                    Kamu sudah {{ roadmapProgress }}% menuju target karier
                    sebagai
                    <span class="text-white font-medium">{{
                        lastAnalysis.role
                    }}</span
                    >.
                </p>
            </div>
        </div>

        <!-- Analisis + Upload -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">
            <!-- Analisis Terakhir -->
            <div
                class="lg:col-span-2 bg-white rounded-2xl shadow-sm border p-6 md:p-7 fade-up flex flex-col sm:flex-row sm:items-center gap-6"
                style="animation-delay: 0.05s"
            >
                <div class="relative shrink-0 h-24 w-24 mx-auto sm:mx-0">
                    <svg viewBox="0 0 80 80" class="h-24 w-24 -rotate-90">
                        <circle
                            cx="40"
                            cy="40"
                            r="34"
                            fill="none"
                            stroke="#EEF2FF"
                            stroke-width="7"
                        />
                        <circle
                            cx="40"
                            cy="40"
                            r="34"
                            fill="none"
                            stroke="#2563EB"
                            stroke-width="7"
                            stroke-linecap="round"
                            :stroke-dasharray="214"
                            class="score-ring"
                            :style="{
                                strokeDashoffset:
                                    214 - (214 * lastAnalysis.score) / 100,
                            }"
                        />
                    </svg>
                    <span
                        class="absolute inset-0 flex items-center justify-center text-base font-bold text-slate-800"
                    >
                        {{ lastAnalysis.score }}%
                    </span>
                </div>

                <div class="min-w-0 text-center sm:text-left">
                    <h3
                        class="text-xs font-medium text-gray-400 uppercase tracking-wide"
                    >
                        Analisis Terakhir
                    </h3>
                    <p class="mt-1 text-lg font-semibold text-gray-800">
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
                        class="block mt-3 text-sm font-medium text-blue-600 hover:text-blue-700"
                    >
                        Lihat detail analisis →
                    </button>
                </div>
            </div>

            <!-- Upload Terakhir -->
            <div
                class="bg-white rounded-2xl shadow-sm border p-6 md:p-7 fade-up flex flex-col justify-center"
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
                <h3
                    class="text-xs font-medium text-gray-400 uppercase tracking-wide"
                >
                    Upload Terakhir
                </h3>
                <p class="mt-1 text-lg font-semibold text-gray-800">
                    {{ lastUploadDate }}
                </p>
                <p class="text-xs text-gray-400 mt-1">CV berhasil dianalisis</p>
            </div>
        </div>

        <!-- Progress Roadmap: stepper -->
        <div
            class="bg-white rounded-2xl shadow-sm border p-6 md:p-8 mb-8 fade-up"
            style="animation-delay: 0.15s"
        >
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-base font-semibold text-gray-800">
                    Progress Roadmap
                </h2>
                <span
                    class="text-sm font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full"
                >
                    {{ roadmapProgress }}%
                </span>
            </div>

            <div class="relative px-2">
                <!-- track -->
                <div
                    class="absolute top-3 left-2 right-2 h-1 bg-gray-100 rounded-full"
                ></div>
                <div
                    class="absolute top-3 left-2 h-1 bg-emerald-500 rounded-full transition-all duration-700"
                    :style="{
                        width: `calc((100% - 16px) * ${roadmapProgress / 100})`,
                    }"
                ></div>

                <!-- milestones -->
                <div class="relative flex justify-between">
                    <div
                        v-for="(m, i) in milestones"
                        :key="m.label"
                        class="flex flex-col items-center w-1/4"
                    >
                        <div
                            class="h-6 w-6 rounded-full border-2 flex items-center justify-center text-[10px] font-bold transition-colors duration-500"
                            :class="
                                roadmapProgress >= m.threshold
                                    ? 'bg-emerald-500 border-emerald-500 text-white'
                                    : 'bg-white border-gray-300 text-gray-400'
                            "
                        >
                            <svg
                                v-if="roadmapProgress >= m.threshold"
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
                            <span v-else>{{ i + 1 }}</span>
                        </div>
                        <span
                            class="mt-2 text-xs text-center"
                            :class="
                                roadmapProgress >= m.threshold
                                    ? 'text-gray-700 font-medium'
                                    : 'text-gray-400'
                            "
                        >
                            {{ m.label }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <button
                class="group bg-blue-600 hover:bg-blue-700 text-white rounded-2xl p-6 text-left transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg fade-up flex items-center justify-between"
                style="animation-delay: 0.2s"
            >
                <div>
                    <p class="font-semibold">Upload CV Baru</p>
                    <p class="text-sm text-blue-100 mt-0.5">
                        Dapatkan analisis skill terbaru
                    </p>
                </div>
                <svg
                    class="h-5 w-5 transition-transform group-hover:translate-x-1"
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
                class="group bg-white border hover:bg-gray-50 text-gray-800 rounded-2xl p-6 text-left transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg fade-up flex items-center justify-between"
                style="animation-delay: 0.25s"
            >
                <div>
                    <p class="font-semibold">Lihat Hasil Analisis</p>
                    <p class="text-sm text-gray-400 mt-0.5">
                        Cek riwayat & detail skor kamu
                    </p>
                </div>
                <svg
                    class="h-5 w-5 text-blue-600 transition-transform group-hover:translate-x-1"
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
import { ref, computed } from "vue";

// Ganti dengan data asli dari API/store nanti
const studentName = ref("Achmad Faisal");

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

const greetingTime = computed(() => {
    const hour = new Date().getHours();
    if (hour < 11) return "Selamat pagi";
    if (hour < 15) return "Selamat siang";
    if (hour < 18) return "Selamat sore";
    return "Selamat malam";
});
</script>

<style scoped>
.fade-up {
    animation: fadeUp 0.6s ease-out both;
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
