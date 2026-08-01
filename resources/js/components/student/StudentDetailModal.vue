<template>
    <div
        class="fixed inset-0 z-50 flex items-end sm:items-center justify-center"
    >
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-900/50" @click="$emit('close')"></div>

        <!-- Modal panel -->
        <div
            class="relative bg-white w-full sm:max-w-3xl sm:rounded-2xl sm:shadow-xl sm:mx-4 max-h-[92vh] sm:max-h-[85vh] flex flex-col rounded-t-2xl sm:rounded-t-2xl overflow-hidden"
        >
            <!-- Header -->
            <div
                class="relative px-5 pt-5 pb-6 sm:px-6 sm:pt-6 sm:pb-8 bg-gradient-to-br from-blue-600 to-indigo-700 shrink-0"
            >
                <button
                    type="button"
                    class="absolute top-4 right-4 text-white/70 hover:text-white p-1 rounded-md focus:outline-none focus:ring-2 focus:ring-white/50"
                    @click="$emit('close')"
                >
                    <svg
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>

                <div class="flex items-center gap-4">
                    <div
                        class="flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-white/15 border-2 border-white/30 text-white text-lg sm:text-xl font-semibold shrink-0"
                    >
                        {{ initials }}
                    </div>
                    <div class="min-w-0">
                        <h3
                            class="text-white text-lg sm:text-xl font-semibold truncate"
                        >
                            {{ student.name }}
                        </h3>
                        <p class="text-blue-100 text-sm truncate">
                            {{ student.major || "Program studi belum diisi" }}
                        </p>
                        <div
                            v-if="student.last_analysis"
                            class="inline-flex items-center gap-1.5 mt-2 px-2.5 py-1 rounded-full bg-white/15 text-white text-xs font-medium"
                        >
                            <span
                                class="w-1.5 h-1.5 rounded-full bg-emerald-400"
                            ></span>
                            {{ student.last_analysis.match_percentage }}% cocok
                            dengan
                            {{ student.last_analysis.recommended_career }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Body (scrollable) -->
            <div class="overflow-y-auto px-5 py-5 sm:px-6 sm:py-6 space-y-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Informasi Pribadi -->
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div
                                class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center shrink-0"
                            >
                                <svg
                                    class="w-4 h-4 text-blue-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    />
                                </svg>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-900">
                                Informasi Pribadi
                            </h4>
                        </div>

                        <div
                            class="rounded-xl border border-gray-200 divide-y divide-gray-100 overflow-hidden"
                        >
                            <div
                                class="flex justify-between gap-4 px-4 py-3 text-sm"
                            >
                                <dt class="text-gray-500 shrink-0">Email</dt>
                                <dd class="text-gray-900 text-right break-all">
                                    {{ student.email }}
                                </dd>
                            </div>
                            <div
                                class="flex justify-between gap-4 px-4 py-3 text-sm"
                            >
                                <dt class="text-gray-500 shrink-0">
                                    Universitas
                                </dt>
                                <dd class="text-gray-900 text-right">
                                    {{ student.university || "-" }}
                                </dd>
                            </div>
                            <div
                                class="flex justify-between gap-4 px-4 py-3 text-sm"
                            >
                                <dt class="text-gray-500 shrink-0">Semester</dt>
                                <dd class="text-gray-900 text-right">
                                    {{ student.semester || "-" }}
                                </dd>
                            </div>
                            <div
                                class="flex justify-between gap-4 px-4 py-3 text-sm"
                            >
                                <dt class="text-gray-500 shrink-0">
                                    Nomor Telepon
                                </dt>
                                <dd class="text-gray-900 text-right">
                                    {{ student.phone || "-" }}
                                </dd>
                            </div>
                            <div
                                class="flex justify-between gap-4 px-4 py-3 text-sm"
                            >
                                <dt class="text-gray-500 shrink-0">
                                    Tgl Registrasi
                                </dt>
                                <dd class="text-gray-900 text-right">
                                    {{ formatDate(student.registration_date) }}
                                </dd>
                            </div>
                        </div>

                        <!-- Tautan sosial -->
                        <div class="flex flex-wrap gap-2 mt-3">
                            <a
                                v-if="student.github"
                                :href="student.github"
                                target="_blank"
                                rel="noopener"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-gray-200 text-xs font-medium text-gray-700 hover:border-gray-300 hover:bg-gray-50"
                            >
                                <svg
                                    class="w-3.5 h-3.5"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.221-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .268.18.58.688.482A10.02 10.02 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    />
                                </svg>
                                GitHub
                            </a>
                            <a
                                v-if="student.linkedin"
                                :href="student.linkedin"
                                target="_blank"
                                rel="noopener"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-gray-200 text-xs font-medium text-gray-700 hover:border-gray-300 hover:bg-gray-50"
                            >
                                <svg
                                    class="w-3.5 h-3.5"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 11.001-4.124 2.062 2.062 0 01-.001 4.124zM7.114 20.452H3.558V9h3.556v11.452z"
                                    />
                                </svg>
                                LinkedIn
                            </a>
                            <a
                                v-if="student.portfolio"
                                :href="student.portfolio"
                                target="_blank"
                                rel="noopener"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-gray-200 text-xs font-medium text-gray-700 hover:border-gray-300 hover:bg-gray-50"
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
                                        d="M13.828 10.172a4 4 0 010 5.656l-4 4a4 4 0 01-5.656-5.656l1.5-1.5M10.172 13.828a4 4 0 010-5.656l4-4a4 4 0 015.656 5.656l-1.5 1.5"
                                    />
                                </svg>
                                Portfolio
                            </a>
                        </div>
                    </div>

                    <!-- CV & Analisis -->
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div
                                class="w-7 h-7 rounded-lg bg-indigo-50 flex items-center justify-center shrink-0"
                            >
                                <svg
                                    class="w-4 h-4 text-indigo-600"
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
                            <h4 class="text-sm font-semibold text-gray-900">
                                CV & Analisis
                            </h4>
                        </div>

                        <!-- CV -->
                        <div
                            class="flex items-center justify-between gap-3 rounded-xl border border-gray-200 px-4 py-3 mb-4"
                        >
                            <div class="flex items-center gap-2.5 min-w-0">
                                <svg
                                    class="w-5 h-5 text-red-400 shrink-0"
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
                                <span class="text-sm text-gray-900 truncate">{{
                                    student.cv_file
                                }}</span>
                            </div>
                            <button
                                class="shrink-0 inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 hover:text-blue-700 px-3 py-1.5 rounded-lg hover:bg-blue-50"
                                @click="viewCV"
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
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    />
                                </svg>
                                Lihat CV
                            </button>
                        </div>

                        <!-- Skill -->
                        <div class="mb-4">
                            <div class="text-xs font-medium text-gray-500 mb-2">
                                Skill Terdeteksi
                            </div>
                            <div class="flex flex-wrap gap-1.5">
                                <span
                                    v-for="(
                                        skill, index
                                    ) in student.detected_skills"
                                    :key="index"
                                    class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium"
                                    :class="skillColor(index)"
                                >
                                    {{ skill }}
                                </span>
                                <span
                                    v-if="
                                        !student.detected_skills ||
                                        student.detected_skills.length === 0
                                    "
                                    class="text-sm text-gray-400 italic"
                                    >Tidak ada skill terdeteksi</span
                                >
                            </div>
                        </div>

                        <!-- Hasil Analisis -->
                        <div
                            v-if="student.last_analysis"
                            class="rounded-xl border border-gray-200 px-4 py-4"
                        >
                            <div class="flex items-center gap-4">
                                <div class="relative w-16 h-16 shrink-0">
                                    <svg
                                        class="w-16 h-16 -rotate-90"
                                        viewBox="0 0 36 36"
                                    >
                                        <circle
                                            cx="18"
                                            cy="18"
                                            r="15.5"
                                            fill="none"
                                            stroke="#e5e7eb"
                                            stroke-width="3"
                                        />
                                        <circle
                                            cx="18"
                                            cy="18"
                                            r="15.5"
                                            fill="none"
                                            :stroke="scoreColor"
                                            stroke-width="3"
                                            stroke-linecap="round"
                                            :stroke-dasharray="`${student.last_analysis.match_percentage * 0.974} 100`"
                                        />
                                    </svg>
                                    <span
                                        class="absolute inset-0 flex items-center justify-center text-sm font-semibold text-gray-900"
                                    >
                                        {{
                                            student.last_analysis
                                                .match_percentage
                                        }}%
                                    </span>
                                </div>
                                <div class="min-w-0">
                                    <div class="text-xs text-gray-500 mb-0.5">
                                        Karier Direkomendasikan
                                    </div>
                                    <div
                                        class="text-sm font-semibold text-gray-900 truncate"
                                    >
                                        {{
                                            student.last_analysis
                                                .recommended_career
                                        }}
                                    </div>
                                    <div class="text-xs text-gray-400 mt-1">
                                        {{
                                            formatDate(
                                                student.last_analysis
                                                    .analysis_date,
                                            )
                                        }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div
                class="px-5 py-3.5 sm:px-6 border-t border-gray-200 flex justify-end shrink-0"
            >
                <button
                    type="button"
                    class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300"
                    @click="$emit('close')"
                >
                    Tutup
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
    student: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(["close", "viewCV"]);

const formatDate = (dateString) => {
    if (!dateString) return "-";
    const options = { year: "numeric", month: "long", day: "numeric" };
    return new Date(dateString).toLocaleDateString("id-ID", options);
};

const viewCV = () => {
    emit("viewCV", props.student);
};

const initials = computed(() => {
    if (!props.student?.name) return "?";
    return props.student.name
        .split(" ")
        .filter(Boolean)
        .slice(0, 2)
        .map((w) => w[0].toUpperCase())
        .join("");
});

const skillPalette = [
    "bg-blue-50 text-blue-700",
    "bg-emerald-50 text-emerald-700",
    "bg-amber-50 text-amber-700",
    "bg-purple-50 text-purple-700",
    "bg-rose-50 text-rose-700",
    "bg-cyan-50 text-cyan-700",
];
const skillColor = (index) => skillPalette[index % skillPalette.length];

const scoreColor = computed(() => {
    const score = props.student?.last_analysis?.match_percentage ?? 0;
    if (score >= 75) return "#059669"; // emerald-600
    if (score >= 50) return "#2563eb"; // blue-600
    return "#d97706"; // amber-600
});
</script>
