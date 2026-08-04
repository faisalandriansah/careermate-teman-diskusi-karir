<template>
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
        <!-- Search and Filter Section -->
        <div class="border-b border-slate-100 p-4">
            <div
                class="flex flex-col items-start justify-between gap-4 md:flex-row md:items-center"
            >
                <div class="w-full md:w-auto md:flex-1">
                    <StudentSearch @search-changed="handleSearchChange" />
                </div>
            </div>
        </div>

        <!-- Loading Skeleton -->
        <div v-if="loading" class="p-4">
            <StudentSkeleton :rows="5" />
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
                class="mt-3 rounded-x1 border border-slate-300 bg-white px-3 py-1.5 text-sm fony-semibold text-slate-600 hover:bg-slate-50"
            >
                coba lagi
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
                Coba ubah kata kunci pencarian atau filter yang Anda gunakan
            </p>
        </div>

        <!-- Card Grid -->
        <div v-else class="p-4">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div
                    v-for="student in paginatedStudents"
                    :key="student.id"
                    class="group flex flex-col justify-between rounded-xl bg-slate-50 p-4 transition hover:bg-slate-100"
                >
                    <div>
                        <div class="flex items-start justify-between gap-2">
                            <div class="flex min-w-0 items-center gap-3">
                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-sm font-semibold text-white"
                                >
                                    {{ student.name.charAt(0).toUpperCase() }}
                                </div>
                                <div class="min-w-0">
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
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 text-xs text-slate-500">
                            <p v-if="student.university">
                                {{ student.university }}
                            </p>
                            <p v-if="student.major">
                                {{ student.major }}
                                <span v-if="student.semester">
                                    · Semester {{ student.semester }}</span
                                >
                            </p>
                        </div>

                        <div
                            v-if="student.last_analysis"
                            class="mt-3 rounded-lg bg-white px-3 py-2 text-xs"
                        >
                            <p class="font-semibold text-slate-700">
                                {{
                                    student.last_analysis.recommended_career ??
                                    "-"
                                }}
                            </p>
                            <p class="text-slate-500">
                                Match:
                                {{ student.last_analysis.match_percentage }}%
                            </p>
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
            class="flex flex-col items-center justify-between gap-3 border-t border-slate-100 px-4 py-3 sm:flex-row"
        >
            <div class="text-sm text-slate-600">
                Menampilkan
                <span class="font-medium text-slate-900">{{
                    Math.min(
                        currentPage * itemsPerPage,
                        filteredStudents.length,
                    )
                }}</span>
                dari
                <span class="font-medium text-slate-900">{{
                    filteredStudents.length
                }}</span>
                data
            </div>
            <div class="flex items-center gap-2">
                <button
                    @click="prevPage"
                    :disabled="currentPage === 1"
                    class="inline-flex items-center gap-1 rounded-xl border border-slate-300 bg-white px-3 py-1.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:bg-slate-50 active:scale-[0.98] disabled:cursor-not-allowed disabled:opacity-50"
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
                    Sebelumnya
                </button>

                <span
                    class="rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-sm font-semibold text-slate-700 shadow-sm"
                >
                    {{ currentPage }} dari {{ totalPages }}
                </span>

                <button
                    @click="nextPage"
                    :disabled="currentPage === totalPages"
                    class="inline-flex items-center gap-1 rounded-xl border border-slate-300 bg-white px-3 py-1.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:bg-slate-50 active:scale-[0.98] disabled:cursor-not-allowed disabled:opacity-50"
                >
                    Berikutnya
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
        />
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { studentService } from "@/services/studentService";
import StudentSearch from "@/components/student/StudentSearch.vue";
import StudentSkeleton from "@/components/student/StudentSkeleton.vue";
import StudentDetailModal from "@/components/student/StudentDetailModal.vue";

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
        registration_date: raw.created_at,
        cv_file: latestCv?.file_name ?? null,
        cv_file_url: latestCv?.file_path ?? null,
        detected_skills: latestAnalysis?.skills_json
            ? typeof latestAnalysis.skills_json === "string"
                ? JSON.parse(latestAnalysis.skills_json)
                : latestAnalysis.skills_json
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
        const { data } = await studentService.getAll({ per_Page: 1000 });
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
</script>
