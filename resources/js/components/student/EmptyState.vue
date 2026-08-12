<template>
    <div class="container mx-auto px-4 py-8 max-w-5xl">
        <div
            class="relative overflow-hidden rounded-3xl bg-white border border-slate-100 shadow-sm"
        >
            <!-- Dekorasi latar -->
            <div class="empty-blob empty-blob-a"></div>
            <div class="empty-blob empty-blob-b"></div>
            <div class="empty-grid"></div>

            <div
                class="relative z-10 px-6 py-12 sm:py-14 flex flex-col items-center text-center"
            >
                <!-- ============ SCENE ANIMASI ============ -->
                <div class="mb-8">
                    <!-- Scene: Riwayat / History -->
                    <div v-if="icon === 'history'" class="relative h-44 w-60 mx-auto">
                        <span class="empty-halo"></span>

                        <div class="empty-card empty-card-back">
                            <div class="flex items-center gap-1.5">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                <span class="h-1.5 w-10 bg-slate-200 rounded-full"></span>
                            </div>
                            <div class="mt-2 h-2 w-20 bg-slate-100 rounded-full"></div>
                            <div class="mt-2 h-1.5 bg-blue-100 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-300 rounded-full" style="width: 55%"></div>
                            </div>
                        </div>

                        <div class="empty-card empty-card-mid">
                            <div class="flex items-center justify-between">
                                <span class="h-1.5 w-12 bg-slate-200 rounded-full"></span>
                                <span class="h-3 w-9 bg-amber-100 rounded-md"></span>
                            </div>
                            <div class="mt-2 h-2 w-24 bg-slate-100 rounded-full"></div>
                            <div class="mt-2 h-1.5 bg-indigo-100 rounded-full overflow-hidden">
                                <div class="h-full bg-indigo-300 rounded-full" style="width: 68%"></div>
                            </div>
                        </div>

                        <div class="empty-card empty-card-front">
                            <div class="flex items-center justify-between">
                                <span class="text-[9px] font-bold text-blue-600 bg-blue-50 border border-blue-100 rounded-md px-1.5 py-0.5"
                                    >TERBARU</span
                                >
                                <svg
                                    class="h-3 w-3 text-slate-300"
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
                            </div>
                            <div class="mt-2 h-2 w-24 bg-slate-100 rounded-full"></div>
                            <div class="mt-2 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                <div class="empty-bar h-full bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full"></div>
                            </div>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-[9px] font-semibold text-emerald-600"
                                    >Sangat Tinggi</span
                                >
                                <span class="text-[9px] font-bold text-slate-400">82%</span>
                            </div>
                        </div>

                        <span class="empty-sparkle empty-sparkle-a"></span>
                        <span class="empty-sparkle empty-sparkle-b"></span>
                        <span class="empty-dot empty-dot-a"></span>
                        <span class="empty-dot empty-dot-b"></span>
                    </div>

                    <!-- Scene: Hasil Analisis -->
                    <div v-else-if="icon === 'analysis'" class="relative h-44 w-56 mx-auto">
                        <span class="empty-halo"></span>

                        <div class="empty-doc">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="h-6 w-6 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-sm"
                                    >
                                        <svg
                                            class="h-3.5 w-3.5 text-amber-300"
                                            fill="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"
                                            />
                                        </svg>
                                    </span>
                                    <span class="h-2 w-14 bg-slate-200 rounded-full"></span>
                                </div>
                                <span class="empty-percent text-[10px] font-bold text-blue-600 bg-blue-50 border border-blue-100 rounded-lg px-1.5 py-0.5"
                                    >87%</span
                                >
                            </div>
                            <div class="mt-3 space-y-2">
                                <div class="h-2 w-full bg-slate-100 rounded-full"></div>
                                <div class="h-2 w-5/6 bg-slate-100 rounded-full"></div>
                                <div class="h-2 w-2/3 bg-slate-100 rounded-full"></div>
                            </div>
                            <div class="mt-3.5 flex flex-wrap gap-1">
                                <span class="h-3.5 w-9 rounded-full bg-emerald-50 border border-emerald-100"></span>
                                <span class="h-3.5 w-7 rounded-full bg-emerald-50 border border-emerald-100"></span>
                                <span class="h-3.5 w-8 rounded-full bg-amber-50 border border-amber-100"></span>
                            </div>
                            <div class="empty-scan"></div>
                        </div>

                        <span class="empty-sparkle empty-sparkle-a"></span>
                        <span class="empty-sparkle empty-sparkle-b"></span>
                        <span class="empty-dot empty-dot-a"></span>
                        <span class="empty-dot empty-dot-b"></span>
                    </div>

                    <!-- Scene: Profil Belum Lengkap -->
                    <div v-else-if="icon === 'lock'" class="relative h-44 w-56 mx-auto flex items-center justify-center">
                        <span class="empty-halo empty-halo-amber"></span>
                        <div class="empty-lock">
                            <svg
                                class="h-10 w-10 text-amber-500"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                />
                            </svg>
                        </div>
                        <span class="empty-sparkle empty-sparkle-a"></span>
                        <span class="empty-sparkle empty-sparkle-b"></span>
                        <span class="empty-dot empty-dot-a"></span>
                        <span class="empty-dot empty-dot-b"></span>
                    </div>

                    <!-- Scene: Error -->
                    <div v-else class="relative h-44 w-56 mx-auto flex items-center justify-center">
                        <span class="empty-halo empty-halo-rose"></span>
                        <div class="empty-alert">
                            <svg
                                class="h-8 w-8 text-rose-500"
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
                        </div>
                        <span class="empty-sparkle empty-sparkle-a"></span>
                        <span class="empty-sparkle empty-sparkle-b"></span>
                    </div>
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
                        class="group flex items-center gap-3 sm:flex-col sm:text-center rounded-2xl border border-slate-100 bg-slate-50/70 px-4 py-3.5 transition-all duration-200 hover:-translate-y-1 hover:shadow-md hover:shadow-blue-600/5 hover:border-blue-200 hover:bg-blue-50/50"
                    >
                        <span
                            class="h-8 w-8 shrink-0 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white text-xs font-bold flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform duration-200"
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
                        class="group w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-xs font-semibold transition active:scale-95 shadow-md shadow-blue-600/25 hover:shadow-lg hover:shadow-blue-600/30"
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
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-xs font-semibold transition active:scale-95 shadow-md shadow-blue-600/25"
                    >
                        {{ primaryLabel }}
                    </button>

                    <router-link
                        v-if="secondaryTo"
                        :to="secondaryTo"
                        class="group w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs font-semibold hover:border-blue-200 hover:text-blue-600 hover:bg-blue-50/50 transition active:scale-95 shadow-sm"
                    >
                        {{ secondaryLabel }}
                        <svg
                            class="h-3.5 w-3.5 transition-transform duration-200 group-hover:translate-x-0.5"
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
        validator: (value) =>
            ["analysis", "history", "lock", "error"].includes(value),
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

.empty-grid {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
    background-size: 22px 22px;
    opacity: 0.18;
    mask-image: radial-gradient(ellipse at center, black 30%, transparent 75%);
    pointer-events: none;
}

/* Halo cahaya di belakang scene */
.empty-halo {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 170px;
    height: 170px;
    border-radius: 9999px;
    background: radial-gradient(circle, rgba(37, 99, 235, 0.22), transparent 70%);
    filter: blur(18px);
    animation: emptyPulse 3s ease-in-out infinite;
}

.empty-halo-rose {
    background: radial-gradient(circle, rgba(244, 63, 94, 0.22), transparent 70%);
}

.empty-halo-amber {
    background: radial-gradient(circle, rgba(245, 158, 11, 0.25), transparent 70%);
}

/* ===== Kartu riwayat (scene history) ===== */
.empty-card {
    position: absolute;
    left: 50%;
    border-radius: 16px;
    background: #fff;
    border: 1px solid #eef2f7;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
    padding: 14px 16px;
}

.empty-card-back {
    width: 64%;
    transform: translateX(-50%) rotate(-8deg) translateY(16px);
    z-index: 1;
    opacity: 0.6;
}

.empty-card-mid {
    width: 78%;
    transform: translateX(-50%) rotate(5deg) translateY(-2px);
    z-index: 2;
    opacity: 0.85;
}

.empty-card-front {
    width: 92%;
    transform: translateX(-50%) translateY(-22px);
    z-index: 3;
    animation: emptyCardBob 4.5s ease-in-out infinite;
}

.empty-bar {
    animation: emptyFill 2.2s cubic-bezier(0.22, 1, 0.36, 1) forwards;
}

@keyframes emptyFill {
    from {
        width: 0;
    }
    to {
        width: 74%;
    }
}

/* ===== Dokumen analisis (scene analysis) ===== */
.empty-doc {
    position: relative;
    width: 205px;
    height: 148px;
    border-radius: 18px;
    background: #fff;
    border: 1px solid #eef2f7;
    box-shadow: 0 12px 34px rgba(15, 23, 42, 0.1);
    padding: 16px;
    margin: 0 auto;
    overflow: hidden;
    animation: emptyCardBob 4.5s ease-in-out infinite;
}

.empty-scan {
    position: absolute;
    left: 10px;
    right: 10px;
    height: 2px;
    border-radius: 9999px;
    background: linear-gradient(90deg, transparent, #2563eb, transparent);
    box-shadow: 0 0 12px rgba(37, 99, 235, 0.6);
    animation: emptyScan 2.8s ease-in-out infinite;
}

@keyframes emptyScan {
    0% {
        top: 22px;
        opacity: 0;
    }
    15% {
        opacity: 1;
    }
    85% {
        opacity: 1;
    }
    100% {
        top: 126px;
        opacity: 0;
    }
}

.empty-percent {
    animation: emptyFloat 3.2s ease-in-out infinite;
}

/* ===== Alert error ===== */
.empty-alert {
    position: relative;
    height: 88px;
    width: 88px;
    border-radius: 2rem;
    background: #fff;
    border: 1px solid #fee2e2;
    box-shadow: 0 12px 30px rgba(244, 63, 94, 0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    animation: emptyWiggle 3.2s ease-in-out infinite;
}

/* ===== Gembok profil belum lengkap ===== */
.empty-lock {
    position: relative;
    height: 92px;
    width: 92px;
    border-radius: 2rem;
    background: #fff;
    border: 1px solid #fde68a;
    box-shadow: 0 12px 30px rgba(245, 158, 11, 0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    animation: emptyWiggle 3.2s ease-in-out infinite;
}

/* ===== Animasi umum ===== */
.empty-card-front,
.empty-doc {
    will-change: transform;
}

@keyframes emptyCardBob {
    0%,
    100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-6px) rotate(0deg);
    }
}

@keyframes emptyPulse {
    0%,
    100% {
        opacity: 0.55;
        transform: translate(-50%, -50%) scale(0.92);
    }
    50% {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1.08);
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

@keyframes emptyWiggle {
    0%,
    100% {
        transform: rotate(0deg);
    }
    92% {
        transform: rotate(0deg);
    }
    94% {
        transform: rotate(-5deg);
    }
    96% {
        transform: rotate(4deg);
    }
    98% {
        transform: rotate(-2deg);
    }
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
    top: 6px;
    right: 6px;
}

.empty-sparkle-b {
    width: 6px;
    height: 6px;
    bottom: 10px;
    left: 10px;
    animation-delay: 1.2s;
    background: #818cf8;
}

.empty-dot {
    position: absolute;
    border-radius: 9999px;
    animation: emptyTwinkle 3s ease-in-out infinite;
    will-change: transform, opacity;
}

.empty-dot-a {
    width: 10px;
    height: 10px;
    background: #60a5fa;
    opacity: 0.5;
    top: -4px;
    left: 18px;
    animation-delay: 0.5s;
}

.empty-dot-b {
    width: 7px;
    height: 7px;
    background: #a5b4fc;
    opacity: 0.5;
    bottom: 0;
    right: 22px;
    animation-delay: 1.8s;
}

@keyframes emptyTwinkle {
    0%,
    100% {
        opacity: 0.35;
        transform: scale(0.75);
    }
    50% {
        opacity: 1;
        transform: scale(1.15);
    }
}

@media (prefers-reduced-motion: reduce) {
    .empty-halo,
    .empty-card-front,
    .empty-doc,
    .empty-scan,
    .empty-percent,
    .empty-alert,
    .empty-lock,
    .empty-sparkle,
    .empty-dot {
        animation: none !important;
        transition: none !important;
    }
    .empty-bar {
        width: 74% !important;
    }
}
</style>
