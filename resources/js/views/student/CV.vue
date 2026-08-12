<template>
    <!-- Diperlebar ke max-w-4xl agar tidak meninggalkan ruang kosong lebar di monitor besar -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 max-w-4xl">
        <!-- Header -->
        <div class="text-center mb-8 fade-up">
            <div
                class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-50 border border-blue-100 mb-3 shadow-sm"
            >
                <svg
                    class="w-4 h-4 text-blue-600 animate-spin-slow"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M13 10V3L4 14h7v7l9-11h-7z"
                    />
                </svg>
                <span
                    class="text-xs font-semibold text-indigo-700 uppercase tracking-wider"
                    >AI-Powered Resume Scanner</span
                >
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                Upload CV & Analisis AI
            </h1>
            <p class="text-sm text-slate-500 mt-1.5 max-w-lg mx-auto">
                CareerMate AI akan menganalisis CV kamu secara komprehensif dan
                mencocokkannya dengan peta karier ideal.
            </p>
        </div>

        <!-- ============ ALERT: PROFIL BELUM LENGKAP ============ -->
        <div
            v-if="!isProfileLoading && !isProfileComplete"
            class="mb-12 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 rounded-2xl border border-amber-500/30 bg-amber-50 px-5 py-4 fade-up"
            role="alert"
        >            <div class="flex items-start gap-3">
                <div
                    class="h-10 w-10 shrink-0 rounded-xl bg-amber-100 border border-amber-200 flex items-center justify-center"
                >
                    <svg
                        class="h-5 w-5 text-amber-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                        />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-amber-800">
                        Profil Belum Lengkap
                    </p>
                    <p class="text-xs text-amber-700/80 mt-0.5 leading-relaxed">
                        Lengkapi profil kamu terlebih dahulu agar AI bisa
                        menganalisis CV secara akurat.
                    </p>
                </div>
            </div>
            <router-link
                :to="{ name: 'StudentProfile' }"
                class="shrink-0 inline-flex items-center gap-1.5 text-xs font-semibold text-white bg-amber-500 hover:bg-amber-600 px-4 py-2.5 rounded-xl transition active:scale-95 shadow-sm shadow-amber-500/30"
            >
                Lengkapi Profil
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
                        d="M13 7l5 5m0 0l-5 5m5-5H6"
                    />
                </svg>
            </router-link>
        </div>

        <!-- ============ STATE: IDLE / SELECTED ============ -->
        <div
            v-if="stage === 'idle' || stage === 'selected'"
            class="relative"
        >
            <!-- Konten (di-blur saat profil belum lengkap) -->
            <div
                class="grid grid-cols-1 lg:grid-cols-3 gap-6 fade-up"
                :class="
                    isBlocked
                        ? 'blur-md opacity-70 select-none pointer-events-none'
                        : ''
                "
            >
                <!-- Area Dropzone (Mengambil 2 Kolom di Desktop) -->
                <div
                    class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8 flex flex-col justify-between"
                >
                <!-- Drop zone -->
                <div
                    class="relative rounded-2xl border-2 border-dashed transition-all duration-200 px-6 py-10 md:py-12 text-center flex flex-col items-center justify-center cursor-pointer group"
                    :class="
                        isDragging
                            ? 'border-blue-500 bg-blue-50/60 scale-[0.99]'
                            : 'border-slate-200 hover:border-blue-400 hover:bg-slate-50/50'
                    "
                    @dragover.prevent="isDragging = true"
                    @dragleave.prevent="isDragging = false"
                    @drop.prevent="handleDrop"
                    @click="triggerPicker"
                >
                    <div
                        class="h-16 w-16 rounded-2xl bg-blue-50 group-hover:bg-blue-100/80 flex items-center justify-center mb-4 transition-colors shadow-sm"
                    >
                        <svg
                            class="h-8 w-8 text-blue-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                            />
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-slate-700">
                        Drag & Drop file CV (PDF) di sini
                    </p>
                    <p class="text-xs text-slate-400 mt-1 mb-4">
                        atau klik area ini untuk memilih file
                    </p>

                    <button
                        type="button"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold shadow-md transition active:scale-95"
                    >
                        Pilih File PDF
                    </button>
                    <input
                        ref="fileInput"
                        type="file"
                        accept="application/pdf"
                        class="hidden"
                        @change="handlePicked"
                    />
                    <p class="text-[11px] text-slate-400 mt-4">
                        Format PDF, Ukuran Maksimal 5MB
                    </p>
                </div>

                <p
                    v-if="errorMessage"
                    class="mt-4 text-sm text-rose-500 text-center"
                >
                    {{ errorMessage }}
                </p>

                <!-- File terpilih -->
                <div
                    v-if="stage === 'selected'"
                    class="mt-6 pt-5 border-t border-dashed border-slate-200"
                >
                    <label
                        class="text-[11px] font-bold text-slate-400 uppercase tracking-wider"
                        >File Siap Dianalisis</label
                    >
                    <div
                        class="mt-2 flex items-center gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-100"
                    >
                        <div
                            class="h-10 w-10 rounded-lg bg-rose-50 border border-rose-100 flex items-center justify-center shrink-0"
                        >
                            <svg
                                class="h-5 w-5 text-rose-500"
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
                        <div class="min-w-0 flex-1">
                            <p
                                class="text-sm font-semibold text-slate-800 truncate"
                            >
                                {{ fileName }}
                            </p>
                            <p class="text-xs text-slate-400">
                                {{ fileSizeLabel }}
                            </p>
                        </div>
                        <button
                            @click.stop="resetFile"
                            class="text-slate-400 hover:text-rose-500 p-1.5 rounded-lg hover:bg-white transition shrink-0"
                            title="Hapus file"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>

                    <button
                        @click="startAnalysis"
                        class="mt-4 w-full flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-semibold text-sm shadow-md transition-all hover:shadow-blue-600/25 active:scale-95"
                    >
                        <svg
                            class="w-4 h-4 text-amber-300 animate-pulse"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"
                            />
                        </svg>
                        Mulai Analisis AI
                    </button>
                </div>
            </div>

            <!-- Side Panel: Info Fitur AI (Mengisi Ruang Kanan agar Lebih Estetis) -->
            <div
                class="lg:col-span-1 bg-gradient-to-br from-blue-950 via-blue-900 to-blue-800 rounded-2xl p-6 text-white relative overflow-hidden shadow-sm flex flex-col justify-between"
            >
                <div class="orb orb-indigo"></div>

                <div class="relative z-10">
                    <div
                        class="flex items-center gap-2 text-blue-300 text-xs font-semibold tracking-wider uppercase mb-3"
                    >
                        <span>✨ Kemampuan AI</span>
                    </div>
                    <h3 class="text-base font-bold text-white mb-4">
                        Apa yang AI Lakukan pada CV Anda?
                    </h3>

                    <ul class="space-y-3.5 text-xs text-blue-100/80">
                        <li class="flex items-start gap-2.5">
                            <span
                                class="h-5 w-5 rounded-md bg-white/10 flex items-center justify-center shrink-0 text-amber-300 font-bold"
                                >1</span
                            >
                            <span
                                ><strong>Parsing Otomatis:</strong> Ekstraksi
                                skill, riwayat pendidikan, & pengalaman.</span
                            >
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span
                                class="h-5 w-5 rounded-md bg-white/10 flex items-center justify-center shrink-0 text-amber-300 font-bold"
                                >2</span
                            >
                            <span
                                ><strong>Career Matching:</strong> Menghitung
                                persentase skor kecocokan peran.</span
                            >
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span
                                class="h-5 w-5 rounded-md bg-white/10 flex items-center justify-center shrink-0 text-amber-300 font-bold"
                                >3</span
                            >
                            <span
                                ><strong>Rekomendasi Roadmap:</strong> Memberi
                                saran skill tambahan yang wajib
                                dipelajari.</span
                            >
                        </li>
                    </ul>
                </div>

                <div
                    class="relative z-10 mt-6 pt-4 border-t border-white/10 text-[11px] text-blue-200/60 flex items-center justify-between"
                >
                    <span>🔒 Data Anda Terenkripsi</span>
                    <span>PDF Only</span>
                </div>
            </div>
            </div>

            <!-- ============ OVERLAY: PROFIL BELUM LENGKAP ============ -->
            <div
                v-if="isBlocked"
                class="absolute inset-0 z-20 flex items-center justify-center px-4 sm:px-8 py-10 sm:py-12"
            >
                <div
                    class="lock-card relative overflow-hidden max-w-md w-full bg-white/95 backdrop-blur border border-amber-200 rounded-3xl p-6 sm:p-7 text-center shadow-2xl shadow-amber-500/10"
                >
                    <div class="lock-blob"></div>

                    <!-- State: sedang memeriksa profil -->
                    <div v-if="isProfileLoading" class="py-4">
                        <div
                            class="relative inline-flex mb-4"
                        >
                            <span class="lock-ping"></span>
                            <div
                                class="relative h-16 w-16 rounded-3xl bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center shadow-lg shadow-blue-600/30"
                            >
                                <svg
                                    class="h-7 w-7 text-white animate-spin"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <circle
                                        class="opacity-25"
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="currentColor"
                                        stroke-width="4"
                                    ></circle>
                                    <path
                                        class="opacity-90"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 018-8v3a5 5 0 00-5 5H4z"
                                    ></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">
                            Memeriksa Profil...
                        </h3>
                        <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                            Sebentar, kami memastikan profil kamu sudah lengkap
                            sebelum membuka fitur upload CV.
                        </p>
                    </div>

                    <!-- State: profil belum lengkap -->
                    <template v-else>
                    <div class="relative inline-flex mb-4">
                        <span class="lock-ping"></span>
                        <div
                            class="lock-wiggle relative h-16 w-16 rounded-3xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg shadow-amber-500/30"
                        >
                            <svg
                                class="h-7 w-7 text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                />
                            </svg>
                        </div>
                        <span class="lock-spark lock-spark-a"></span>
                        <span class="lock-spark lock-spark-b"></span>
                    </div>

                    <h3
                        class="text-lg font-bold text-slate-800"
                    >
                        Lengkapi Profil Dulu, Yuk!
                    </h3>
                    <p
                        class="mt-2 text-sm text-slate-500 leading-relaxed"
                    >
                        Fitur upload CV sementara dikunci. Lengkapi profil kamu
                        supaya AI bisa menganalisis CV dengan hasil yang akurat.
                    </p>

                    <ul
                        class="mt-4 space-y-2 text-left max-w-xs mx-auto"
                    >
                        <li
                            v-for="(hint, i) in lockedHints"
                            :key="hint"
                            class="flex items-center gap-2.5 text-xs text-slate-600"
                        >
                            <span
                                class="h-5 w-5 rounded-lg bg-amber-50 border border-amber-200 text-amber-600 font-bold flex items-center justify-center shrink-0"
                                >{{ i + 1 }}</span
                            >
                            {{ hint }}
                        </li>
                    </ul>

                    <router-link
                        :to="{ name: 'StudentProfile' }"
                        class="mt-5 w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white text-sm font-semibold transition active:scale-95 shadow-md shadow-amber-500/30"
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
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                            />
                        </svg>
                        Lengkapi Profil Sekarang
                    </router-link>
                    </template>
                </div>
            </div>
        </div>

        <!-- ============ STATE: LOADING AI ============ -->
        <div
            v-else-if="stage === 'loading'"
            class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 sm:p-12 fade-up text-center max-w-xl mx-auto"
        >
            <div
                class="mx-auto h-20 w-20 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center mb-4 relative"
            >
                <span
                    class="absolute inset-0 rounded-full border-2 border-blue-200 border-t-blue-600 animate-spin"
                ></span>
                <svg
                    class="h-9 w-9 text-blue-600 animate-pulse"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                    />
                </svg>
            </div>

            <div
                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 border border-amber-200 text-amber-700 text-xs font-semibold mb-2"
            >
                <span>✨ AI Processing</span>
            </div>
            <h2 class="text-lg font-bold text-slate-800">
                Sedang Menganalisis CV Kamu
            </h2>
            <p class="text-xs text-slate-500 mt-1 mb-8">
                CareerMate AI sedang mengekstrak informasi dan mencocokkan
                profilmu...
            </p>

            <!-- Stepper Progress AI -->
            <div
                class="space-y-3 text-left max-w-xs mx-auto bg-slate-50 p-4 rounded-xl border border-slate-100"
            >
                <div
                    v-for="(step, i) in steps"
                    :key="step"
                    class="flex items-center gap-3 text-xs transition-all duration-300"
                    :class="
                        i < activeStep
                            ? 'text-slate-800 font-medium'
                            : i === activeStep
                              ? 'text-blue-600 font-bold'
                              : 'text-slate-400'
                    "
                >
                    <span
                        class="h-5 w-5 rounded-full flex items-center justify-center shrink-0 transition-colors duration-300 text-[10px]"
                        :class="
                            i < activeStep
                                ? 'bg-emerald-500 text-white'
                                : i === activeStep
                                  ? 'bg-blue-600 text-white ring-4 ring-blue-100'
                                  : 'bg-slate-200 text-slate-500'
                        "
                    >
                        <svg
                            v-if="i < activeStep"
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
                    </span>
                    <span>{{ step }}</span>
                </div>
            </div>
        </div>

        <!-- ============ STATE: DONE ============ -->
        <div
            v-else-if="stage === 'done'"
            class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 sm:p-12 fade-up text-center max-w-xl mx-auto pop-in"
        >
            <div
                class="mx-auto h-20 w-20 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center mb-4 shadow-sm"
            >
                <span class="text-4xl">🎉</span>
            </div>
            <h2 class="text-xl font-bold text-slate-800">
                Analisis AI Selesai!
            </h2>
            <p class="text-xs text-slate-500 mt-1 mb-6">
                Model AI berhasil memproses CV Anda dan menyusun rekomendasi
                karir.
            </p>

            <button
                @click="goToResult"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-sm shadow-md transition active:scale-95"
            >
                Lihat Hasil Analisis & Roadmap
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
import cvService from "@/services/student/cvService";

const router = useRouter();
const authStore = useAuthStore();
const stage = ref("idle"); // idle | selected | loading | done
const isDragging = ref(false);
const fileInput = ref(null);
const fileName = ref("");
const fileSizeLabel = ref("");
const selectedFile = ref(null);
const errorMessage = ref("");
const finalAnalysisResult = ref(null); // hasil akhir buat redirect
// const uploadedCvFile = ref(null); //hasil dari backend ketika sukses

const isProfileLoading = ref(true);
const isProfileComplete = computed(() => authStore.isProfileComplete);
const isBlocked = computed(
    () => isProfileLoading.value || !isProfileComplete.value,
);

const lockedHints = [
    "Lengkapi biodata & detail profil kamu",
    "Kembali ke halaman Upload CV ini",
    "Upload CV & dapatkan rekomendasi AI",
];

const MAX_SIZE_MB = 5; // Ukuran maksimal file dalam MB

const steps = [
    "Mengunggah Berkas CV",
    "AI Parsing & Ekstraksi Teks",
    "AI Deteksi Skill & Pengalaman",
    "Menghitung Match Score Karir",
    "Menyusun Rekomendasi Roadmap",
];
const activeStep = ref(0);

onMounted(async () => {
    if (authStore.token) {
        try {
            await authStore.fetchMe();
        } catch (e) {
            console.log("Auth me gagal", e);
        }
    }
    isProfileLoading.value = false;
});

function triggerPicker() {
    if (!isProfileComplete.value) return;
    fileInput.value?.click();
}

function setFile(file) {
    if (!isProfileComplete.value) return;
    errorMessage.value = "";
    if (!file) return;

    if (file.type !== "application/pdf") {
        errorMessage.value = "Harap unggah file berformat PDF.";
        return;
    }
    if (file.size > MAX_SIZE_MB * 1024 * 1024) {
        errorMessage.value = `Ukuran file maksimal ${MAX_SIZE_MB}MB.`;
        return;
    }

    selectedFile.value = file;
    fileName.value = file.name;
    fileSizeLabel.value = (file.size / 1024 / 1024).toFixed(2) + " MB";
    stage.value = "selected";
}

function handlePicked(e) {
    setFile(e.target.files?.[0]);
}

function handleDrop(e) {
    isDragging.value = false;
    setFile(e.dataTransfer.files?.[0]);
}

function resetFile() {
    fileName.value = "";
    fileSizeLabel.value = "";
    selectedFile.value = null;
    errorMessage.value = "";
    stage.value = "idle";
    if (fileInput.value) fileInput.value.value = "";
}

async function startAnalysis() {
    if (!selectedFile.value) return;

    if (!isProfileComplete.value) {
        errorMessage.value =
            "Silakan lengkapi profil terlebih dahulu sebelum upload CV.";
        router.push({ name: "StudentProfile" });
        return;
    }

    stage.value = "loading";
    errorMessage.value = "";
    activeStep.value = 0;

    try {
        // Step 1: Upload
        const uploadResult = await cvService.uploadCV(selectedFile.value);
        const cvFileId = uploadResult.data.id;
        activeStep.value = 1;

        // Step 2: Extract PDF text
        await cvService.extract(cvFileId);
        activeStep.value = 2;

        // Step 3: Detect skills
        const detectResult = await cvService.detectSkills(cvFileId);
        const analysisResultId = detectResult.data.id;
        activeStep.value = 3;

        // Step 4: Career matching
        await cvService.matchCareer(analysisResultId);
        activeStep.value = 4;

        // Step 5: Generate roadmap
        const roadmapResult = await cvService.generateRoadmap(analysisResultId);
        activeStep.value = 5;

        finalAnalysisResult.value = roadmapResult.data;

        setTimeout(() => {
            stage.value = "done";
        }, 400);
    } catch (err) {
        stage.value = "selected";

        if (err.response?.status === 422) {
            errorMessage.value =
                err.response.data.message ??
                err.response.data.errors?.cv?.[0] ??
                "Validasi gagal.";
        } else if (err.response?.status === 403) {
            errorMessage.value =
                "Silakan lengkapi profil terlebih dahulu sebelum upload CV.";
        } else if (err.response?.status === 404) {
            errorMessage.value =
                err.response.data.message ??
                "Tidak ditemukan career yang cocok. Hubungi admin.";
        } else if (err.response?.status === 500) {
            errorMessage.value =
                err.response.data.message ??
                "Terjadi kesalahan pada server AI. Coba lagi.";
        } else {
            errorMessage.value = "Gagal menganalisis CV. Silakan coba lagi.";
        }
    }
}
function goToResult() {
    router.push({
        name: "StudentHasilAnalisis",
        params: { id: finalAnalysisResult.value.id },
    });
}
</script>

<style scoped>
.fade-up {
    animation: fadeUp 0.5s ease-out both;
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
.pop-in {
    animation: popIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) both;
}
@keyframes popIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
.animate-spin-slow {
    animation: spin 6s linear infinite;
}
@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
.orb {
    position: absolute;
    border-radius: 9999px;
    filter: blur(40px);
    opacity: 0.25;
    pointer-events: none;
}
.orb-indigo {
    width: 160px;
    height: 160px;
    background: #2563eb;
    top: -40px;
    right: -20px;
}

/* ===== Lock overlay animations ===== */
.lock-card {
    animation: lockCardIn 0.55s cubic-bezier(0.16, 1, 0.3, 1) backwards;
    will-change: transform, opacity;
}
@keyframes lockCardIn {
    from {
        opacity: 0;
        transform: translateY(16px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.lock-blob {
    position: absolute;
    width: 200px;
    height: 200px;
    border-radius: 9999px;
    background: #f59e0b;
    filter: blur(60px);
    opacity: 0.12;
    top: -70px;
    right: -50px;
    pointer-events: none;
}

.lock-wiggle {
    animation: lockWiggle 3.4s ease-in-out infinite;
    will-change: transform;
}
@keyframes lockWiggle {
    0%,
    100% {
        transform: rotate(0deg);
    }
    92% {
        transform: rotate(0deg);
    }
    94% {
        transform: rotate(-6deg);
    }
    96% {
        transform: rotate(5deg);
    }
    98% {
        transform: rotate(-3deg);
    }
}

.lock-ping {
    position: absolute;
    inset: -12px;
    border-radius: 2rem;
    background: rgba(245, 158, 11, 0.14);
    animation: lockPing 2.4s cubic-bezier(0.22, 1, 0.36, 1) infinite;
    will-change: transform, opacity;
}
@keyframes lockPing {
    0% {
        transform: scale(0.9);
        opacity: 0.8;
    }
    70%,
    100% {
        transform: scale(1.3);
        opacity: 0;
    }
}

.lock-spark {
    position: absolute;
    border-radius: 9999px;
    background: #fbbf24;
    animation: lockTwinkle 2.6s ease-in-out infinite;
    will-change: transform, opacity;
}
.lock-spark-a {
    width: 9px;
    height: 9px;
    top: 0;
    right: -4px;
}
.lock-spark-b {
    width: 6px;
    height: 6px;
    bottom: 4px;
    left: -6px;
    background: #f59e0b;
    animation-delay: 1.2s;
}
@keyframes lockTwinkle {
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
    .lock-card,
    .lock-wiggle,
    .lock-ping,
    .lock-spark {
        animation: none !important;
        transition: none !important;
    }
}
</style>
