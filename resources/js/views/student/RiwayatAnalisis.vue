<template>
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <!-- List mode -->
        <div v-if="!selected">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6 fade-up">
                Riwayat Analisis
            </h1>

            <div
                class="bg-white rounded-2xl shadow-sm border divide-y divide-dashed divide-gray-200 fade-up"
                style="animation-delay: 0.05s"
            >
                <div
                    v-for="item in history"
                    :key="item.id"
                    class="p-5 flex items-center justify-between gap-4"
                >
                    <div class="min-w-0">
                        <p class="text-xs text-gray-400">{{ item.date }}</p>
                        <p
                            class="text-sm font-semibold text-gray-800 mt-0.5 truncate"
                        >
                            {{ item.role }}
                        </p>
                        <span
                            class="inline-block mt-1 text-xs font-medium text-blue-700 bg-blue-50 px-2 py-0.5 rounded-full"
                        >
                            {{ item.score }}% match
                        </span>
                    </div>
                    <button
                        @click="selected = item"
                        class="shrink-0 inline-flex items-center gap-1 px-4 py-2 rounded-lg border border-gray-200 text-sm font-medium text-gray-700 hover:bg-gray-50 transition"
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

        <!-- Detail mode -->
        <HasilAnalisis
            v-else
            :result="selected"
            :show-back-button="true"
            @back="selected = null"
        />
    </div>
</template>

<script setup>
import { ref } from "vue";
import HasilAnalisis from "./HasilAnalisis.vue";

const selected = ref(null);

// Ganti dengan data asli dari API/store nanti
const history = ref([
    {
        id: 1,
        date: "03 Agustus 2026",
        role: "Backend Developer",
        score: 95,
        skills: ["PHP", "Laravel", "MySQL", "Git", "Docker"],
        gaps: ["Vue.js", "REST API", "Testing"],
        careers: [
            { title: "Backend Developer", score: 95 },
            { title: "Fullstack Developer", score: 90 },
            { title: "Software Engineer", score: 87 },
        ],
        internships: ["PT Telkom", "PT GITS", "PT Astra Digital"],
        roadmap: [
            "Pelajari REST API",
            "Belajar Docker",
            "Bangun Portfolio",
            "Belajar Testing",
        ],
    },
    {
        id: 2,
        date: "20 Juli 2026",
        role: "Backend Developer",
        score: 90,
        skills: ["PHP", "Laravel", "MySQL"],
        gaps: ["Docker", "Testing"],
        careers: [
            { title: "Backend Developer", score: 90 },
            { title: "Fullstack Developer", score: 84 },
        ],
        internships: ["PT Telkom", "PT GITS"],
        roadmap: ["Belajar Docker", "Belajar Testing"],
    },
    {
        id: 3,
        date: "12 Juli 2026",
        role: "Frontend Developer",
        score: 82,
        skills: ["Vue.js", "JavaScript", "Tailwind"],
        gaps: ["TypeScript", "Testing"],
        careers: [
            { title: "Frontend Developer", score: 82 },
            { title: "UI Engineer", score: 75 },
        ],
        internships: ["PT Astra Digital"],
        roadmap: ["Belajar TypeScript", "Bangun Portfolio"],
    },
]);
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
</style>
