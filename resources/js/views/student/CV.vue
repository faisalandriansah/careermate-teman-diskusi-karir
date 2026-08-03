<template>
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <div class="text-center mb-8 fade-up">
            <h1 class="text-2xl font-semibold text-gray-800">Upload CV</h1>
            <p class="text-sm text-gray-500 mt-1">
                CareerMate akan membaca CV kamu dan mencocokkannya dengan peluang karier.
            </p>
        </div>

        <!-- ============ STATE: idle / selected ============ -->
        <div v-if="stage === 'idle' || stage === 'selected'" class="bg-white rounded-2xl shadow-sm border p-6 md:p-8 fade-up">
            <!-- Drop zone -->
            <div
                class="relative rounded-xl border-2 border-dashed transition-colors duration-200 px-6 py-12 text-center"
                :class="isDragging ? 'border-blue-500 bg-blue-50/60' : 'border-gray-200 hover:border-gray-300'"
                @dragover.prevent="isDragging = true"
                @dragleave.prevent="isDragging = false"
                @drop.prevent="handleDrop"
            >
                <div class="mx-auto h-14 w-14 rounded-full bg-blue-50 flex items-center justify-center mb-4">
                    <svg class="h-7 w-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-700">
                    Drag & Drop PDF di sini
                </p>
                <p class="text-xs text-gray-400 mt-1 mb-4">atau</p>
                <button
                    @click="triggerPicker"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition"
                >
                    Pilih File
                </button>
                <input ref="fileInput" type="file" accept="application/pdf" class="hidden" @change="handlePicked" />
                <p class="text-xs text-gray-300 mt-4">Format PDF, maksimal 5MB</p>
            </div>

            <!-- File terpilih -->
            <div v-if="stage === 'selected'" class="mt-6">
                <div class="border-t border-dashed border-gray-200 pt-5">
                    <label class="text-xs font-medium text-gray-400 uppercase tracking-wide">Nama File</label>
                    <div class="mt-2 flex items-center gap-3 p-3 rounded-xl bg-gray-50 border border-gray-100">
                        <div class="h-10 w-10 rounded-lg bg-red-50 flex items-center justify-center shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-gray-800 truncate">{{ fileName }}</p>
                            <p class="text-xs text-gray-400">{{ fileSizeLabel }}</p>
                        </div>
                        <button @click="resetFile" class="text-gray-300 hover:text-gray-500 shrink-0" title="Hapus file">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <button
                    @click="startAnalysis"
                    class="mt-6 w-full flex items-center justify-center gap-2 px-5 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium transition hover:-translate-y-0.5 hover:shadow-lg"
                >
                    Analisis CV
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- ============ STATE: loading ============ -->
        <div v-else-if="stage === 'loading'" class="bg-white rounded-2xl shadow-sm border p-8 md:p-10 fade-up text-center">
            <div class="mx-auto h-14 w-14 rounded-full bg-indigo-50 flex items-center justify-center mb-2 relative">
                <span class="absolute inset-0 rounded-full border-2 border-indigo-200 border-t-indigo-600 animate-spin"></span>
                <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <h2 class="text-base font-semibold text-gray-800 mt-4">🤖 Loading Analisis</h2>
            <p class="text-sm text-gray-500 mt-1 mb-6">
                CareerMate sedang menganalisis CV Anda...
            </p>

            <ul class="space-y-3 text-left max-w-sm mx-auto">
                <li
                    v-for="(step, i) in steps"
                    :key="step"
                    class="flex items-center gap-3 text-sm transition-all duration-300"
                    :class="i < activeStep ? 'text-gray-700' : i === activeStep ? 'text-gray-800 font-medium' : 'text-gray-300'"
                >
                    <span
                        class="h-5 w-5 rounded-full flex items-center justify-center shrink-0 transition-colors duration-300"
                        :class="i < activeStep ? 'bg-emerald-500' : i === activeStep ? 'bg-indigo-100' : 'bg-gray-100'"
                    >
                        <svg v-if="i < activeStep" class="h-3 w-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                        </svg>
                        <span v-else-if="i === activeStep" class="h-2 w-2 rounded-full bg-indigo-500 animate-pulse"></span>
                    </span>
                    {{ step }}
                </li>
            </ul>
        </div>

        <!-- ============ STATE: done ============ -->
        <div v-else-if="stage === 'done'" class="bg-white rounded-2xl shadow-sm border p-8 md:p-10 fade-up text-center pop-in">
            <div class="mx-auto h-16 w-16 rounded-full bg-emerald-50 flex items-center justify-center mb-4">
                <span class="text-3xl">🎉</span>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Analisis Berhasil</h2>
            <p class="text-sm text-gray-500 mt-1 mb-6">CV berhasil dianalisis</p>

            <button
                class="inline-flex items-center gap-2 px-5 py-3 rounded-lg bg-emerald-500 hover:bg-emerald-600 text-white font-medium transition hover:-translate-y-0.5 hover:shadow-lg"
            >
                Lihat Hasil Analisis
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const stage = ref('idle') // idle | selected | loading | done
const isDragging = ref(false)
const fileInput = ref(null)
const fileName = ref('')
const fileSizeLabel = ref('')

const steps = [
    'Upload File',
    'Membaca PDF',
    'AI Mendeteksi Skill',
    'Career Matching',
    'AI Menyusun Roadmap',
]
const activeStep = ref(0)

function triggerPicker() {
    fileInput.value?.click()
}

function setFile(file) {
    if (!file) return
    fileName.value = file.name
    fileSizeLabel.value = (file.size / 1024 / 1024).toFixed(2) + ' MB'
    stage.value = 'selected'
}

function handlePicked(e) {
    setFile(e.target.files?.[0])
}

function handleDrop(e) {
    isDragging.value = false
    setFile(e.dataTransfer.files?.[0])
}

function resetFile() {
    fileName.value = ''
    fileSizeLabel.value = ''
    stage.value = 'idle'
    if (fileInput.value) fileInput.value.value = ''
}

function startAnalysis() {
    stage.value = 'loading'
    activeStep.value = 0

    // Simulasi progres step-by-step — ganti dengan progres real dari API nanti
    const interval = setInterval(() => {
        activeStep.value++
        if (activeStep.value >= steps.length) {
            clearInterval(interval)
            setTimeout(() => {
                stage.value = 'done'
            }, 400)
        }
    }, 800)
}
</script>

<style scoped>
.fade-up {
    animation: fadeUp 0.5s ease-out both;
}
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.pop-in {
    animation: popIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) both;
}
@keyframes popIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}
</style>