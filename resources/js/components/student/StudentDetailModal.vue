<template>
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div
            class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
        >
            <!-- Backdrop -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div
                    class="absolute inset-0 bg-gray-900 bg-opacity-50"
                    @click="$emit('close')"
                ></div>
            </div>

            <!-- Modal panel -->
            <div
                class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full"
            >
                <div class="bg-white px-4 pt-5 pb-4 sm:p-8 sm:pb-6">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="w-full mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"
                        >
                            <div class="flex justify-between items-center mb-6">
                                <h3
                                    class="text-2xl leading-6 font-bold text-gray-900"
                                >
                                    Detail Mahasiswa
                                </h3>
                                <button
                                    type="button"
                                    class="text-gray-400 hover:text-gray-600 focus:outline-none"
                                    @click="$emit('close')"
                                >
                                    <svg
                                        class="h-6 w-6"
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
                            </div>

                            <div class="border-b border-gray-200 mb-6">
                                <nav class="-mb-px flex space-x-8">
                                    <a
                                        href="#"
                                        class="whitespace-nowrap pb-4 px-1 border-b-2 border-blue-500 text-sm font-medium text-blue-600"
                                    >
                                        Informasi Mahasiswa
                                    </a>
                                </nav>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <!-- Informasi Mahasiswa -->
                                <div class="bg-gray-50 p-6 rounded-xl">
                                    <h4
                                        class="text-lg font-semibold text-gray-900 mb-5 flex items-center"
                                    >
                                        <svg
                                            class="w-5 h-5 mr-2 text-blue-600"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                            ></path>
                                        </svg>
                                        Informasi Pribadi
                                    </h4>

                                    <div class="space-y-4">
                                        <div class="flex items-start">
                                            <div
                                                class="w-32 text-sm font-medium text-gray-500 flex-shrink-0"
                                            >
                                                Nama
                                            </div>
                                            <p
                                                class="text-sm text-gray-900 ml-2"
                                            >
                                                {{ student.name }}
                                            </p>
                                        </div>

                                        <div class="flex items-start">
                                            <div
                                                class="w-32 text-sm font-medium text-gray-500 flex-shrink-0"
                                            >
                                                Email
                                            </div>
                                            <p
                                                class="text-sm text-gray-900 ml-2"
                                            >
                                                {{ student.email }}
                                            </p>
                                        </div>

                                        <div class="flex items-start">
                                            <div
                                                class="w-32 text-sm font-medium text-gray-500 flex-shrink-0"
                                            >
                                                Universitas
                                            </div>
                                            <p
                                                class="text-sm text-gray-900 ml-2"
                                            >
                                                {{ student.university || "-" }}
                                            </p>
                                        </div>

                                        <div class="flex items-start">
                                            <div
                                                class="w-32 text-sm font-medium text-gray-500 flex-shrink-0"
                                            >
                                                Program Studi
                                            </div>
                                            <p
                                                class="text-sm text-gray-900 ml-2"
                                            >
                                                {{ student.major || "-" }}
                                            </p>
                                        </div>

                                        <div class="flex items-start">
                                            <div
                                                class="w-32 text-sm font-medium text-gray-500 flex-shrink-0"
                                            >
                                                Semester
                                            </div>
                                            <p
                                                class="text-sm text-gray-900 ml-2"
                                            >
                                                {{ student.semester || "-" }}
                                            </p>
                                        </div>

                                        <div class="flex items-start">
                                            <div
                                                class="w-32 text-sm font-medium text-gray-500 flex-shrink-0"
                                            >
                                                Nomor Telepon
                                            </div>
                                            <p
                                                class="text-sm text-gray-900 ml-2"
                                            >
                                                {{ student.phone || "-" }}
                                            </p>
                                        </div>

                                        <div class="flex items-start">
                                            <div
                                                class="w-32 text-sm font-medium text-gray-500 flex-shrink-0"
                                            >
                                                GitHub
                                            </div>
                                            <p
                                                class="text-sm text-gray-900 ml-2"
                                            >
                                                <a
                                                    v-if="student.github"
                                                    :href="student.github"
                                                    target="_blank"
                                                    class="text-blue-600 hover:text-blue-800 underline"
                                                >
                                                    {{ student.github }}
                                                </a>
                                                <span v-else>-</span>
                                            </p>
                                        </div>

                                        <div class="flex items-start">
                                            <div
                                                class="w-32 text-sm font-medium text-gray-500 flex-shrink-0"
                                            >
                                                LinkedIn
                                            </div>
                                            <p
                                                class="text-sm text-gray-900 ml-2"
                                            >
                                                <a
                                                    v-if="student.linkedin"
                                                    :href="student.linkedin"
                                                    target="_blank"
                                                    class="text-blue-600 hover:text-blue-800 underline"
                                                >
                                                    {{ student.linkedin }}
                                                </a>
                                                <span v-else>-</span>
                                            </p>
                                        </div>

                                        <div class="flex items-start">
                                            <div
                                                class="w-32 text-sm font-medium text-gray-500 flex-shrink-0"
                                            >
                                                Portfolio
                                            </div>
                                            <p
                                                class="text-sm text-gray-900 ml-2"
                                            >
                                                <a
                                                    v-if="student.portfolio"
                                                    :href="student.portfolio"
                                                    target="_blank"
                                                    class="text-blue-600 hover:text-blue-800 underline"
                                                >
                                                    {{ student.portfolio }}
                                                </a>
                                                <span v-else>-</span>
                                            </p>
                                        </div>

                                        <div class="flex items-start">
                                            <div
                                                class="w-32 text-sm font-medium text-gray-500 flex-shrink-0"
                                            >
                                                Tanggal Registrasi
                                            </div>
                                            <p
                                                class="text-sm text-gray-900 ml-2"
                                            >
                                                {{
                                                    formatDate(
                                                        student.registration_date,
                                                    )
                                                }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi CV dan Analisis -->
                                <div class="bg-gray-50 p-6 rounded-xl">
                                    <h4
                                        class="text-lg font-semibold text-gray-900 mb-5 flex items-center"
                                    >
                                        <svg
                                            class="w-5 h-5 mr-2 text-blue-600"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                            ></path>
                                        </svg>
                                        Informasi CV & Analisis
                                    </h4>

                                    <!-- Informasi CV -->
                                    <div class="mb-6">
                                        <div
                                            class="text-sm font-medium text-gray-700 mb-3"
                                        >
                                            CV Mahasiswa
                                        </div>
                                        <div
                                            class="bg-white p-4 rounded-lg border border-gray-200"
                                        >
                                            <div
                                                class="flex items-center justify-between"
                                            >
                                                <div class="flex items-center">
                                                    <svg
                                                        class="w-5 h-5 text-gray-500 mr-2"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                                        ></path>
                                                    </svg>
                                                    <span
                                                        class="text-sm text-gray-900 truncate max-w-xs"
                                                        >{{
                                                            student.cv_file
                                                        }}</span
                                                    >
                                                </div>
                                                <button
                                                    class="ml-2 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                                                    @click="viewCV"
                                                >
                                                    <svg
                                                        class="w-4 h-4 mr-1"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                        ></path>
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                        ></path>
                                                    </svg>
                                                    Lihat CV
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Daftar Skill -->
                                    <div class="mb-6">
                                        <div
                                            class="text-sm font-medium text-gray-700 mb-3"
                                        >
                                            Skill Terdeteksi
                                        </div>
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                v-for="(
                                                    skill, index
                                                ) in student.detected_skills"
                                                :key="index"
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 border border-blue-200"
                                            >
                                                {{ skill }}
                                            </span>
                                            <span
                                                v-if="
                                                    !student.detected_skills ||
                                                    student.detected_skills
                                                        .length === 0
                                                "
                                                class="text-sm text-gray-500 italic"
                                                >Tidak ada skill
                                                terdeteksi</span
                                            >
                                        </div>
                                    </div>

                                    <!-- Hasil Analisis Terakhir -->
                                    <div>
                                        <div
                                            class="text-sm font-medium text-gray-700 mb-3"
                                        >
                                            Hasil Analisis Terakhir
                                        </div>
                                        <div
                                            v-if="student.last_analysis"
                                            class="bg-white p-4 rounded-lg border border-gray-200"
                                        >
                                            <div class="mb-3">
                                                <div
                                                    class="flex justify-between text-sm"
                                                >
                                                    <span
                                                        class="font-medium text-gray-900"
                                                        >Karier
                                                        Direkomendasikan:</span
                                                    >
                                                    <span
                                                        class="text-gray-700"
                                                        >{{
                                                            student
                                                                .last_analysis
                                                                .recommended_career
                                                        }}</span
                                                    >
                                                </div>
                                            </div>

                                            <div class="mb-2">
                                                <div
                                                    class="flex justify-between text-sm mb-1"
                                                >
                                                    <span
                                                        class="font-medium text-gray-900"
                                                        >Persentase
                                                        Kecocokan:</span
                                                    >
                                                    <span class="text-gray-700"
                                                        >{{
                                                            student
                                                                .last_analysis
                                                                .match_percentage
                                                        }}%</span
                                                    >
                                                </div>
                                                <div
                                                    class="w-full bg-gray-200 rounded-full h-2.5"
                                                >
                                                    <div
                                                        class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2.5 rounded-full"
                                                        :style="{
                                                            width: `${student.last_analysis.match_percentage}%`,
                                                        }"
                                                    ></div>
                                                </div>
                                            </div>

                                            <div
                                                class="mt-3 pt-3 border-t border-gray-100"
                                            >
                                                <div
                                                    class="flex justify-between text-sm"
                                                >
                                                    <span
                                                        class="font-medium text-gray-900"
                                                        >Tanggal Analisis:</span
                                                    >
                                                    <span
                                                        class="text-gray-700"
                                                        >{{
                                                            formatDate(
                                                                student
                                                                    .last_analysis
                                                                    .analysis_date,
                                                            )
                                                        }}</span
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-gray-50 px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse"
                >
                    <button
                        type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200"
                        @click="$emit('close')"
                    >
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    student: {
        type: Object,
        required: true,
    },
});

defineEmits(["close"]);

const formatDate = (dateString) => {
    if (!dateString) return "-";
    const options = { year: "numeric", month: "long", day: "numeric" };
    return new Date(dateString).toLocaleDateString("id-ID", options);
};
</script>
