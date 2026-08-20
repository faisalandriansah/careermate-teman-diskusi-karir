<template>
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
        <!-- Search Section -->
        <div class="border-b border-slate-100 p-4">
            <div class="w-full">
                <StudentSearch @search-changed="handleSearchChange" />
            </div>
        </div>

        <!-- Loading Skeleton -->
        <div v-if="loading" class="p-4">
            <StudentSkeleton :rows="6" />
        </div>

        <!-- error State -->
        <div
            v-else-if="errorMessage"
            class="flex flex-col items-center justify-center px-6 py-12 text-center"
        >
            <p class="text-sm font-semibold text-red-600">Gagal memuat data</p>
            <p class="mt-1 text-xs text-slate-500">{{ errorMessage }}</p>
            <button
                @click="fetchStudents"
                class="mt-3 rounded-xl border border-slate-300 bg-white px-3 py-1.5 text-sm font-semibold text-slate-600 hover:bg-slate-50"
            >
                Coba lagi
            </button>
        </div>

        <!-- Empty State -->
        <div
            v-else-if="filteredStudents.length === 0"
            class="flex flex-col items-center justify-center px-6 py-12 text-center"
        >
            <div
                class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400"
            >
                <svg
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"
                    ></path>
                </svg>
            </div>
            <h3 class="text-sm font-semibold text-slate-900">
                Data Mahasiswa Tidak Ditemukan
            </h3>
            <p class="mt-1 text-xs text-slate-500">
                Coba ubah kata kunci pencarian Anda
            </p>
        </div>

        <!-- Card Grid -->
        <div v-else class="p-4">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-2">
                <div>
                    <h3 class="text-sm font-semibold text-slate-900">
                        Daftar Mahasiswa
                    </h3>
                    <p class="text-xs text-slate-500">
                        Kelola dan pantau aktivitas mahasiswa di platform
                    </p>
                </div>
                <span
                    class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-600"
                >
                    {{ filteredStudents.length }} mahasiswa
                </span>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div
                    v-for="student in paginatedStudents"
                    :key="student.id"
                    class="group flex flex-col justify-between overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md"
                >
                    <div>
                        <div class="flex items-start gap-3">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center overflow-hidden rounded-full bg-gradient-to-br from-indigo-500 to-blue-600 text-base font-semibold text-white ring-2 ring-blue-50"
                            >
                                <img
                                    v-if="student.photo_url"
                                    :src="student.photo_url"
                                    alt=""
                                    class="h-full w-full object-cover"
                                    @error="
                                        $event.target.style.display = 'none'
                                    "
                                />
                                <span
                                    v-if="!student.photo_url"
                                    class="flex h-full w-full items-center justify-center"
                                >
                                    {{ student.name.charAt(0).toUpperCase() }}
                                </span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p
                                    class="truncate text-sm font-semibold text-slate-900"
                                >
                                    {{ student.name }}
                                </p>
                                <p
                                    class="truncate text-xs text-slate-500"
                                    :title="student.email"
                                >
                                    {{ student.email }}
                                </p>
                                <div class="mt-1.5 flex flex-wrap gap-1.5">
                                    <span
                                        v-if="student.cv_file"
                                        class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-0.5 text-[10px] font-semibold text-emerald-700"
                                    >
                                        <svg
                                            class="h-3 w-3"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            stroke-width="2.5"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 13l4 4L19 7"
                                            />
                                        </svg>
                                        CV Terlampir
                                    </span>
                                    <span
                                        v-else
                                        class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-500"
                                    >
                                        <svg
                                            class="h-3 w-3"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                            />
                                        </svg>
                                        Belum CV
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div
                            class="my-3 border-t border-dashed border-slate-100"
                        ></div>

                        <div class="space-y-1.5 text-xs text-slate-500">
                            <p
                                v-if="student.university"
                                class="flex items-center gap-1.5 truncate"
                            >
                                <svg
                                    class="h-3.5 w-3.5 shrink-0 text-slate-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 21h18M5 21V7l7-4 7 4v14M9 9h.01M9 12h.01M9 15h.01M15 9h.01M15 12h.01M15 15h.01"
                                    />
                                </svg>
                                {{ student.university }}
                            </p>
                            <p
                                v-if="student.major"
                                class="flex items-center gap-1.5 truncate"
                            >
                                <svg
                                    class="h-3.5 w-3.5 shrink-0 text-slate-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                                    />
                                </svg>
                                {{ student.major }}
                                <span v-if="student.semester">
                                    · Semester {{ student.semester }}</span
                                >
                            </p>
                        </div>

                        <div
                            v-if="student.last_analysis"
                            class="mt-3 rounded-xl bg-slate-50 px-3 py-2.5 ring-1 ring-slate-100"
                        >
                            <div
                                class="flex items-center justify-between gap-2"
                            >
                                <p
                                    class="text-[10px] font-semibold uppercase tracking-wide text-slate-400"
                                >
                                    Rekomendasi Karier
                                </p>
                                <span
                                    class="shrink-0 rounded-full px-2 py-0.5 text-[10px] font-bold"
                                    :class="
                                        scoreClass(
                                            student.last_analysis
                                                .match_percentage,
                                        )
                                    "
                                >
                                    {{
                                        Math.round(
                                            student.last_analysis
                                                .match_percentage,
                                        )
                                    }}%
                                </span>
                            </div>
                            <p
                                class="mt-1 truncate text-sm font-semibold text-slate-800"
                            >
                                {{
                                    student.last_analysis.recommended_career ??
                                    "-"
                                }}
                            </p>
                            <p
                                class="mt-1 flex items-center gap-1 text-[11px] text-slate-400"
                            >
                                <svg
                                    class="h-3 w-3"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                </svg>
                                {{
                                    formatDate(
                                        student.last_analysis.analysis_date,
                                    )
                                }}
                            </p>
                        </div>
                        <div
                            v-else
                            class="mt-3 rounded-xl bg-slate-50 px-3 py-3 ring-1 ring-slate-100"
                        >
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2 py-1 text-[11px] font-semibold text-amber-700"
                            >
                                <svg
                                    class="h-3 w-3"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                                Belum Analisis
                            </span>
                        </div>
                    </div>

                    <button
                        @click="openDetailModal(student)"
                        class="mt-4 inline-flex w-full items-center justify-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-blue-600 transition hover:border-blue-200 hover:bg-blue-50 active:scale-[0.98]"
                    >
                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                            ></path>
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                            ></path>
                        </svg>
                        Detail
                    </button>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div
            v-if="!loading && !errorMessage && filteredStudents.length > 0"
            class="flex flex-col items-center justify-between gap-3 border-t border-slate-100 px-4 py-4 sm:flex-row sm:gap-4"
        >
            <!-- Info jumlah data (kiri di desktop, di atas di mobile) -->
            <div class="text-center text-sm text-slate-600 sm:text-left">
                Menampilkan
                <span class="font-semibold text-slate-900">{{ shownFrom }}</span
                >–<span class="font-semibold text-slate-900">{{
                    shownTo
                }}</span>
                dari
                <span class="font-semibold text-slate-900">{{
                    filteredStudents.length
                }}</span>
                mahasiswa
            </div>

            <!-- Kontrol navigasi: 3 kolom sejajar di mobile, satu group di desktop -->
            <div
                class="grid w-full grid-cols-3 items-stretch overflow-hidden rounded-xl border border-slate-300 bg-white shadow-sm sm:w-auto sm:inline-flex"
            >
                <button
                    @click="prevPage"
                    :disabled="currentPage === 1"
                    class="inline-flex items-center justify-center gap-1 border-r border-slate-200 px-3 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-40"
                >
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 19l-7-7 7-7"
                        ></path>
                    </svg>
                    <span class="sm:inline">Sebelumnya</span>
                </button>

                <span
                    class="flex items-center justify-center border-r border-slate-200 bg-slate-50 px-1 py-2.5 text-sm font-semibold text-slate-700"
                >
                    {{ currentPage }}
                    <span class="text-slate-400">/ {{ totalPages }}</span>
                </span>

                <button
                    @click="nextPage"
                    :disabled="currentPage === totalPages"
                    class="inline-flex items-center justify-center gap-1 px-3 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-40"
                >
                    <span class="sm:inline">Berikutnya</span>
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 5l7 7-7 7"
                        ></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Student Detail Modal -->
        <StudentDetailModal
            v-if="showDetailModal"
            :student="selectedStudent"
            @close="closeDetailModal"
            @viewCV="openCV"
        />
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { studentService } from "@/services/admin/studentService";
import apiClient from "@/services/api";
import { push } from "notivue";
import StudentSearch from "@/components/admin/StudentSearch.vue";
import StudentSkeleton from "@/components/admin/StudentSkeleton.vue";
import StudentDetailModal from "@/components/admin/StudentDetailModal.vue";

const students = ref([]);
const searchTerm = ref("");
const loading = ref(false);
const errorMessage = ref("");
const showDetailModal = ref(false);
const selectedStudent = ref(null);

// Pagination
const currentPage = ref(1);
const itemsPerPage = 6; // digenepin biar pas grid 3 kolom (2 baris) di desktop

// Mapping response API Laravel -> shape yang dipakai UI
const mapStudent = (raw) => {
    const latestCv = raw.cv_files?.[0] ?? null;
    const latestAnalysis = raw.analysis_results?.[0] ?? null;

    return {
        id: raw.id,
        name: raw.name,
        email: raw.email,
        university: raw.student_profile?.university ?? null,
        major: raw.student_profile?.major ?? null,
        semester: raw.student_profile?.semester ?? null,
        phone: raw.student_profile?.phone ?? null,
        github: raw.student_profile?.github_url ?? null,
        linkedin: raw.student_profile?.linkedin_url ?? null,
        portfolio: raw.student_profile?.portfolio_url ?? null,
        photo_url: raw.student_profile?.photo_url ?? null,
        registration_date: raw.created_at,
        cv_file: latestCv?.file_name ?? null,
        cv_file_id: latestCv?.id ?? null,
        cv_file_url: latestCv?.file_path ?? null,
        detected_skills: latestAnalysis?.skills_json
            ? (typeof latestAnalysis.skills_json === "string"
                  ? JSON.parse(latestAnalysis.skills_json)
                  : latestAnalysis.skills_json
              ).map((s) => (typeof s === "string" ? s : s?.name))
            : [],
        last_analysis: latestAnalysis
            ? {
                  recommended_career: latestAnalysis.career?.title ?? null,
                  match_percentage: latestAnalysis.match_score,
                  analysis_date: latestAnalysis.created_at,
              }
            : null,
    };
};

const fetchStudents = async () => {
    loading.value = true;
    errorMessage.value = "";
    try {
        const { data } = await studentService.getAll({ per_page: 1000 });
        // laravel paginate() bungkus data asli di field "data"
        const rows = data.data ?? data;
        students.value = rows.map(mapStudent);
    } catch (err) {
        errorMessage.value =
            err.response?.data?.message ?? "Terjadi kesalahan pada server";
    } finally {
        loading.value = false;
    }
};

onMounted(fetchStudents);

// Computed properties
const filteredStudents = computed(() => {
    let result = students.value;

    if (searchTerm.value) {
        const term = searchTerm.value.toLowerCase();
        result = result.filter(
            (student) =>
                student.name.toLowerCase().includes(term) ||
                student.email.toLowerCase().includes(term) ||
                (student.university &&
                    student.university.toLowerCase().includes(term)) ||
                (student.major && student.major.toLowerCase().includes(term)),
        );
    }

    return result;
});

const totalPages = computed(() => {
    return Math.ceil(filteredStudents.value.length / itemsPerPage) || 1;
});

const paginatedStudents = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return filteredStudents.value.slice(start, end);
});

const shownFrom = computed(() =>
    filteredStudents.value.length === 0
        ? 0
        : (currentPage.value - 1) * itemsPerPage + 1,
);

const shownTo = computed(() =>
    Math.min(currentPage.value * itemsPerPage, filteredStudents.value.length),
);

// Methods
const handleSearchChange = (searchValue) => {
    searchTerm.value = searchValue;
    currentPage.value = 1;
};

const nextPage = () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
    }
};

const prevPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--;
    }
};

const openDetailModal = (student) => {
    selectedStudent.value = student;
    showDetailModal.value = true;
};

const closeDetailModal = () => {
    showDetailModal.value = false;
    selectedStudent.value = null;
};

const openCV = async (student) => {
    if (!student.cv_file_id) return;
    try {
        const response = await apiClient.get(
            `/admin/students/${student.id}/cv/${student.cv_file_id}`,
            { responseType: "blob", cache: false },
        );
        const url = window.URL.createObjectURL(response.data);
        window.open(url, "_blank");
    } catch (err) {
        push.error({
            title: "Gagal membuka CV",
            message: "File mungkin tidak tersedia.",
        });
    }
};

function formatDate(dateString) {
    if (!dateString) return "-";
    const options = { day: "2-digit", month: "short", year: "numeric" };
    return new Date(dateString).toLocaleDateString("id-ID", options);
}

function scoreClass(score) {
    const s = score ?? 0;
    if (s >= 75) return "bg-emerald-50 text-emerald-700";
    if (s >= 50) return "bg-blue-50 text-blue-700";
    return "bg-amber-50 text-amber-700";
}
</script>
