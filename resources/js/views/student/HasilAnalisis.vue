<template>
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Back button (khusus kalau dibuka dari Riwayat) -->
        <button
            v-if="showBackButton"
            @click="$emit('back')"
            class="flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700 mb-5 fade-up"
        >
            <svg
                class="h-4 w-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 19l-7-7m0 0l7-7m-7 7h18"
                />
            </svg>
            Kembali ke Riwayat
        </button>

        <!-- Ringkasan (hero) -->
        <div
            class="hero relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 p-8 md:p-10 mb-6 fade-up"
        >
            <div class="orb orb-blue"></div>
            <div class="orb orb-amber"></div>

            <div
                class="relative flex flex-col sm:flex-row sm:items-center gap-6"
            >
                <div class="relative shrink-0 h-24 w-24 mx-auto sm:mx-0">
                    <svg viewBox="0 0 80 80" class="h-24 w-24 -rotate-90">
                        <circle
                            cx="40"
                            cy="40"
                            r="34"
                            fill="none"
                            stroke="rgba(255,255,255,0.12)"
                            stroke-width="7"
                        />
                        <circle
                            cx="40"
                            cy="40"
                            r="34"
                            fill="none"
                            stroke="#60A5FA"
                            stroke-width="7"
                            stroke-linecap="round"
                            :stroke-dasharray="214"
                            class="score-ring"
                            :style="{
                                strokeDashoffset:
                                    214 - (214 * displayResult.score) / 100,
                            }"
                        />
                    </svg>
                    <span
                        class="absolute inset-0 flex items-center justify-center text-lg font-bold text-white"
                    >
                        {{ displayResult.score }}%
                    </span>
                </div>
                <div class="text-center sm:text-left">
                    <p
                        class="text-xs font-medium text-indigo-300 uppercase tracking-widest mb-1"
                    >
                        {{ displayResult.date }}
                    </p>
                    <h1 class="text-2xl font-semibold text-white">
                        {{ displayResult.role }}
                    </h1>
                    <p class="text-sm text-indigo-200/80 mt-1">
                        Kecocokan karier berdasarkan CV kamu
                    </p>
                </div>
            </div>
        </div>

        <!-- Skill Terdeteksi & Skill Gap -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
            <div
                class="bg-white rounded-2xl shadow-sm border p-6 fade-up"
                style="animation-delay: 0.05s"
            >
                <h2
                    class="text-sm font-semibold text-gray-800 mb-4 flex items-center gap-2"
                >
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    Skill Terdeteksi
                </h2>
                <div class="flex flex-wrap gap-2">
                    <span
                        v-for="s in displayResult.skills"
                        :key="s"
                        class="px-3 py-1 rounded-full text-sm font-medium bg-emerald-50 text-emerald-700"
                        >{{ s }}</span
                    >
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-sm border p-6 fade-up"
                style="animation-delay: 0.1s"
            >
                <h2
                    class="text-sm font-semibold text-gray-800 mb-4 flex items-center gap-2"
                >
                    <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                    Skill Gap
                </h2>
                <div class="flex flex-wrap gap-2">
                    <span
                        v-for="s in displayResult.gaps"
                        :key="s"
                        class="px-3 py-1 rounded-full text-sm font-medium bg-amber-50 text-amber-700"
                        >{{ s }}</span
                    >
                </div>
            </div>
        </div>

        <!-- Career Recommendation -->
        <div
            class="bg-white rounded-2xl shadow-sm border p-6 md:p-7 mb-6 fade-up"
            style="animation-delay: 0.15s"
        >
            <h2 class="text-base font-semibold text-gray-800 mb-5">
                Career Recommendation
            </h2>
            <div class="space-y-4">
                <div
                    v-for="(c, i) in displayResult.careers"
                    :key="c.title"
                    class="flex items-center gap-4"
                >
                    <span
                        class="shrink-0 h-8 w-8 rounded-full flex items-center justify-center text-xs font-bold"
                        :class="
                            i === 0
                                ? 'bg-blue-600 text-white'
                                : 'bg-gray-100 text-gray-500'
                        "
                        >{{ i + 1 }}</span
                    >
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium text-gray-800 truncate">{{
                                c.title
                            }}</span>
                            <span class="text-gray-500 shrink-0"
                                >{{ c.score }}%</span
                            >
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-1.5">
                            <div
                                class="h-1.5 rounded-full transition-all duration-700"
                                :class="i === 0 ? 'bg-blue-600' : 'bg-gray-300'"
                                :style="{ width: c.score + '%' }"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Internship Recommendation -->
        <div
            class="bg-white rounded-2xl shadow-sm border p-6 md:p-7 mb-6 fade-up"
            style="animation-delay: 0.2s"
        >
            <h2 class="text-base font-semibold text-gray-800 mb-5">
                Internship Recommendation
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div
                    v-for="internship in displayResult.internships"
                    :key="internship"
                    class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 bg-gray-50/50"
                >
                    <div
                        class="h-9 w-9 rounded-lg bg-white border flex items-center justify-center shrink-0"
                    >
                        <svg
                            class="h-4 w-4 text-purple-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                            />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-800 truncate">{{
                        internship
                    }}</span>
                </div>
            </div>
        </div>

        <!-- Roadmap AI -->
        <div
            class="bg-white rounded-2xl shadow-sm border p-6 md:p-7 mb-8 fade-up"
            style="animation-delay: 0.25s"
        >
            <h2 class="text-base font-semibold text-gray-800 mb-6">
                Roadmap AI
            </h2>
            <div class="relative pl-8">
                <div
                    class="absolute left-3 top-1 bottom-1 w-px bg-gray-100"
                ></div>
                <div
                    v-for="(step, i) in displayResult.roadmap"
                    :key="step"
                    class="relative pb-6 last:pb-0"
                >
                    <span
                        class="absolute -left-8 top-0 h-6 w-6 rounded-full bg-blue-600 text-white text-xs font-bold flex items-center justify-center"
                    >
                        {{ i + 1 }}
                    </span>
                    <p
                        class="text-xs font-medium text-gray-400 uppercase tracking-wide"
                    >
                        Step {{ i + 1 }}
                    </p>
                    <p class="text-sm font-medium text-gray-800 mt-0.5">
                        {{ step }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div
            class="grid grid-cols-1 sm:grid-cols-2 gap-4 fade-up"
            style="animation-delay: 0.3s"
        >
            <button
                class="flex items-center justify-center gap-2 px-5 py-3 rounded-lg border border-gray-200 text-gray-700 font-medium hover:bg-gray-50 transition"
            >
                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3"
                    />
                </svg>
                Download PDF
            </button>
            <button
                class="flex items-center justify-center gap-2 px-5 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium transition"
            >
                Upload CV Baru
            </button>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
    result: { type: Object, default: null },
    showBackButton: { type: Boolean, default: true },
});

defineEmits(["back"]);

// Data dummy untuk keperluan preview UI jika props.result tidak di-pass
const dummyResult = {
    score: 85,
    date: "14 OKTOBER 2025",
    role: "Frontend Web Developer",
    skills: [
        "Vue.js",
        "Tailwind CSS",
        "JavaScript ES6+",
        "Git & GitHub",
        "HTML5 & CSS3",
        "REST API Integration",
    ],
    gaps: [
        "TypeScript",
        "State Management (Pinia)",
        "Unit Testing (Jest/Vitest)",
        "Web Performance Optimization",
    ],
    careers: [
        { title: "Frontend Web Developer", score: 85 },
        { title: "Fullstack Developer (Node/Vue)", score: 72 },
        { title: "UI/UX Engineer", score: 68 },
    ],
    internships: [
        "Frontend Developer Intern - PT Tech Innovation",
        "Web Developer Trainee - Digital Creative Studio",
        "UI Engineer Intern - StartUp Nusantara",
    ],
    roadmap: [
        "Perdalam TypeScript untuk meningkatkan standar penulisan kode komponen Vue.",
        "Pelajari State Management menggunakan Pinia untuk mengelola state aplikasi skala besar.",
        "Implementasikan Unit Testing menggunakan Vitest pada komponen-komponen kritis.",
        "Bangun 2 portofolio proyek kompleks menggunakan Vue 3 + Tailwind CSS + API Integration.",
    ],
};

// Menggunakan data prop jika ada, jika tidak ada/null gunakan dummy
const displayResult = computed(() => props.result || dummyResult);
</script>

<style scoped>
.fade-up {
    animation: fadeUp 0.5s ease-out both;
}
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(10px);
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
