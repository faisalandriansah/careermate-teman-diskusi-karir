<template>
    <div class="container mx-auto px-4 py-8 max-w-5xl">
        <div
            class="relative overflow-hidden rounded-3xl bg-white border border-slate-100 shadow-sm"
        >
            <!-- Dekorasi latar -->
            <div class="empty-blob empty-blob-a"></div>
            <div class="empty-blob empty-blob-b"></div>
            <svg
                class="absolute -top-6 -right-6 w-40 h-40 opacity-[0.06] pointer-events-none"
                viewBox="0 0 200 200"
                fill="none"
                aria-hidden="true"
            >
                <circle cx="100" cy="100" r="70" stroke="#2563eb" stroke-width="3" />
                <circle cx="100" cy="100" r="45" stroke="#2563eb" stroke-width="3" stroke-dasharray="6 8" />
            </svg>

            <div
                class="relative z-10 px-6 py-14 sm:py-16 flex flex-col items-center text-center"
            >
                <!-- Ikon Animasi -->
                <div class="relative mb-7">
                    <span class="empty-ping"></span>
                    <div
                        class="relative h-24 w-24 rounded-3xl bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center shadow-xl shadow-blue-600/30 empty-pop"
                    >
                        <svg
                            class="h-11 w-11 text-white empty-float"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                v-if="icon === 'analysis'"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                            />
                            <path
                                v-else-if="icon === 'history'"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 6v6h4m6 0a10 10 0 11-20 0 10 10 0 0120 0zM4.93 4.93l1.414 1.414M19.07 4.93l-1.414 1.414"
                            />
                            <path
                                v-else
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 9v3.75m0 3.75h.008v.008H12v-.008zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                    </div>

                    <!-- Sparkle dekoratif -->
                    <span class="empty-sparkle empty-sparkle-a"></span>
                    <span class="empty-sparkle empty-sparkle-b"></span>
                </div>

                <!-- Judul & Deskripsi -->
                <h2 class="text-xl sm:text-2xl font-bold text-slate-800">
                    {{ title }}
                </h2>
                <p
                    class="mt-2.5 max-w-md text-sm text-slate-500 leading-relaxed"
                >
                    {{ description }}
                </p>

                <!-- Langkah Mulai (opsional) -->
                <div
                    v-if="steps.length"
                    class="mt-8 w-full max-w-2xl grid grid-cols-1 sm:grid-cols-3 gap-3"
                >
                    <div
                        v-for="(step, i) in steps"
                        :key="step"
                        class="flex items-center gap-3 sm:flex-col sm:text-center rounded-2xl border border-slate-100 bg-slate-50/70 px-4 py-3.5 transition-transform duration-200 hover:-translate-y-0.5 hover:bg-blue-50/60 hover:border-blue-100"
                    >
                        <span
                            class="h-8 w-8 shrink-0 rounded-xl bg-blue-600 text-white text-xs font-bold flex items-center justify-center shadow-sm"
                        >
                            {{ i + 1 }}
                        </span>
                        <span
                            class="text-xs font-semibold text-slate-600 leading-snug sm:mt-1"
                        >
                            {{ step }}
                        </span>
                    </div>
                </div>

                <!-- Aksi -->
                <div class="mt-8 flex flex-col sm:flex-row items-center gap-3">
                    <router-link
                        v-if="primaryTo"
                        :to="primaryTo"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold transition active:scale-95 shadow-md shadow-blue-600/25"
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
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
                            />
                        </svg>
                        {{ primaryLabel }}
                    </router-link>
                    <button
                        v-else
                        type="button"
                        @click="$emit('primary')"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold transition active:scale-95 shadow-md shadow-blue-600/25"
                    >
                        {{ primaryLabel }}
                    </button>

                    <router-link
                        v-if="secondaryTo"
                        :to="secondaryTo"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs font-semibold hover:bg-slate-50 transition active:scale-95 shadow-sm"
                    >
                        {{ secondaryLabel }}
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
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    icon: {
        type: String,
        default: "analysis",
        validator: (value) => ["analysis", "history", "error"].includes(value),
    },
    title: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        default: "",
    },
    steps: {
        type: Array,
        default: () => [],
    },
    primaryLabel: {
        type: String,
        default: "Mulai Sekarang",
    },
    primaryTo: {
        type: [String, Object],
        default: null,
    },
    secondaryLabel: {
        type: String,
        default: "Lihat Riwayat",
    },
    secondaryTo: {
        type: [String, Object],
        default: null,
    },
});

defineEmits(["primary"]);
</script>

<style scoped>
.empty-blob {
    position: absolute;
    border-radius: 9999px;
    filter: blur(56px);
    opacity: 0.18;
    pointer-events: none;
}

.empty-blob-a {
    width: 260px;
    height: 260px;
    background: #2563eb;
    top: -90px;
    right: -40px;
}

.empty-blob-b {
    width: 220px;
    height: 220px;
    background: #6366f1;
    bottom: -80px;
    left: -60px;
}

.empty-ping {
    position: absolute;
    inset: -14px;
    border-radius: 2rem;
    background: rgba(37, 99, 235, 0.12);
    animation: emptyPing 2.4s cubic-bezier(0.22, 1, 0.36, 1) infinite;
}

.empty-pop {
    animation: emptyPop 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) backwards;
}

.empty-float {
    animation: emptyFloat 3.2s ease-in-out infinite;
    will-change: transform;
}

.empty-sparkle {
    position: absolute;
    border-radius: 9999px;
    background: #fbbf24;
    animation: emptyTwinkle 2.6s ease-in-out infinite;
    will-change: transform, opacity;
}

.empty-sparkle-a {
    width: 8px;
    height: 8px;
    top: 2px;
    right: 0;
}

.empty-sparkle-b {
    width: 6px;
    height: 6px;
    bottom: 6px;
    left: -2px;
    animation-delay: 1.2s;
    background: #818cf8;
}

@keyframes emptyPing {
    0% {
        transform: scale(0.9);
        opacity: 0.7;
    }
    70%,
    100% {
        transform: scale(1.25);
        opacity: 0;
    }
}

@keyframes emptyPop {
    0% {
        opacity: 0;
        transform: scale(0.6);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes emptyFloat {
    0%,
    100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-5px);
    }
}

@keyframes emptyTwinkle {
    0%,
    100% {
        opacity: 0.4;
        transform: scale(0.8);
    }
    50% {
        opacity: 1;
        transform: scale(1.15);
    }
}

@media (prefers-reduced-motion: reduce) {
    .empty-ping,
    .empty-pop,
    .empty-float,
    .empty-sparkle {
        animation: none !important;
        transition: none !important;
    }
}
</style>
