<template>
    <div class="container mx-auto px-4 py-6 max-w-5xl">
        <!-- Header: score ring + mini stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
            <div class="sm:col-span-2 bg-gray-50 rounded-xl px-6 py-5 flex items-center gap-5">
                <div class="relative shrink-0 h-[76px] w-[76px]">
                    <svg viewBox="0 0 72 72" class="h-[76px] w-[76px] -rotate-90">
                        <circle cx="36" cy="36" r="30" fill="none" stroke="#E5E7EB" stroke-width="6" />
                        <circle
                            cx="36" cy="36" r="30" fill="none" stroke="#378ADD" stroke-width="6"
                            stroke-linecap="round" stroke-dasharray="188" stroke-dashoffset="9.4"
                        />
                    </svg>
                    <span class="absolute inset-0 flex items-center justify-center text-base font-semibold text-gray-800">
                        95%
                    </span>
                </div>
                <div>
                    <p class="text-xs text-gray-400">03 Agustus 2026</p>
                    <p class="text-xl font-semibold text-gray-800 mt-1 mb-2">Backend Developer</p>
                    <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-800">
                        Match sangat tinggi
                    </span>
                </div>
            </div>
            <div class="bg-gray-50 rounded-xl px-5 py-5 flex flex-col justify-center gap-2.5">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Skill dikuasai</span>
                    <span class="font-medium text-gray-800">5</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Skill perlu dipelajari</span>
                    <span class="font-medium text-gray-800">3</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Estimasi roadmap</span>
                    <span class="font-medium text-gray-800">4 langkah</span>
                </div>
            </div>
        </div>

        <!-- Skill Terdeteksi, Skill Gap, Career Recommendation -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div class="bg-white rounded-xl border p-4">
                <p class="text-sm font-medium text-gray-800 mb-3 flex items-center gap-1.5">
                    <svg class="h-4 w-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Skill Terdeteksi
                </p>
                <div class="flex flex-col gap-1.5">
                    <span v-for="s in ['PHP', 'Laravel', 'MySQL', 'Git', 'Docker']" :key="s" class="text-sm px-2.5 py-1.5 rounded-lg bg-emerald-50 text-emerald-800">
                        {{ s }}
                    </span>
                </div>
            </div>
            <div class="bg-white rounded-xl border p-4">
                <p class="text-sm font-medium text-gray-800 mb-3 flex items-center gap-1.5">
                    <svg class="h-4 w-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    Skill Gap
                </p>
                <div class="flex flex-col gap-1.5">
                    <span v-for="s in ['Vue.js', 'REST API', 'Testing']" :key="s" class="text-sm px-2.5 py-1.5 rounded-lg bg-amber-50 text-amber-800">
                        {{ s }}
                    </span>
                </div>
            </div>
            <div class="bg-white rounded-xl border p-4">
                <p class="text-sm font-medium text-gray-800 mb-3">Career Recommendation</p>
                <div class="space-y-3">
                    <div v-for="(c, i) in careers" :key="c.title" class="flex items-center gap-2.5">
                        <span
                            class="shrink-0 h-[22px] w-[22px] rounded-full text-[11px] font-semibold flex items-center justify-center"
                            :class="i === 0 ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-500'"
                        >{{ i + 1 }}</span>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-medium text-gray-800 truncate">{{ c.title }}</span>
                                <span class="text-gray-500 shrink-0">{{ c.score }}%</span>
                            </div>
                            <div class="h-1 bg-gray-100 rounded-full">
                                <div class="h-1 rounded-full" :class="i === 0 ? 'bg-blue-600' : 'bg-gray-300'" :style="{ width: c.score + '%' }"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Internship + Roadmap -->
        <div class="grid grid-cols-1 md:grid-cols-[1fr_1.4fr] gap-4 mb-6">
            <div class="bg-white rounded-xl border p-4">
                <p class="text-sm font-medium text-gray-800 mb-3">Internship Recommendation</p>
                <div class="flex flex-col gap-2">
                    <div v-for="i in ['PT Telkom', 'PT GITS', 'PT Astra Digital']" :key="i" class="flex items-center justify-between px-3 py-2 bg-gray-50 rounded-lg text-sm text-gray-700">
                        <span>{{ i }}</span>
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border p-4">
                <p class="text-sm font-medium text-gray-800 mb-3">Roadmap AI</p>
                <div class="grid grid-cols-2 gap-2.5">
                    <div v-for="(step, i) in ['Pelajari REST API', 'Belajar Docker', 'Bangun Portfolio', 'Belajar Testing']" :key="step" class="flex items-start gap-2 p-2.5 bg-gray-50 rounded-lg">
                        <span class="h-[18px] w-[18px] mt-0.5 rounded-full bg-blue-600 text-white text-[10px] font-semibold flex items-center justify-center shrink-0">
                            {{ i + 1 }}
                        </span>
                        <span class="text-sm text-gray-700">{{ step }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex gap-3">
            <button class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg border border-gray-200 text-gray-700 text-sm font-medium hover:bg-gray-50 transition">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" />
                </svg>
                Download PDF
            </button>
            <button class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition">
                Upload CV Baru
            </button>
        </div>
    </div>
</template>

<script setup>
// Statis dulu — belum ada props, data ditulis langsung di sini
const careers = [
    { title: 'Backend Developer', score: 95 },
    { title: 'Fullstack Developer', score: 90 },
    { title: 'Software Engineer', score: 87 },
]
</script>