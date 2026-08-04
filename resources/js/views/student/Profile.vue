<template>
    <div class="container mx-auto px-4 py-8 max-w-5xl">
        <!-- Header Profil -->
        <div
            class="hero relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 p-8 md:p-10 mb-6 fade-up"
        >
            <div class="orb orb-blue"></div>
            <div class="orb orb-amber"></div>

            <div
                class="relative flex flex-col sm:flex-row sm:items-center gap-6"
            >
                <!-- Foto -->
                <div class="relative shrink-0 mx-auto sm:mx-0">
                    <div
                        class="h-24 w-24 rounded-full bg-white/10 border-2 border-white/20 overflow-hidden flex items-center justify-center"
                    >
                        <img
                            v-if="profile.photoUrl"
                            :src="profile.photoUrl"
                            alt="Foto profil"
                            class="h-full w-full object-cover"
                        />
                        <svg
                            v-else
                            class="h-10 w-10 text-indigo-200"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                            />
                        </svg>
                    </div>
                    <button
                        class="absolute bottom-0 right-0 h-8 w-8 rounded-full bg-blue-600 hover:bg-blue-700 flex items-center justify-center border-2 border-slate-900 transition"
                        title="Ganti foto"
                    >
                        <svg
                            class="h-4 w-4 text-white"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"
                            />
                        </svg>
                    </button>
                </div>

                <!-- Nama + info singkat -->
                <div class="text-center sm:text-left flex-1 min-w-0">
                    <h1
                        class="text-xl md:text-2xl font-semibold text-white truncate"
                    >
                        {{ profile.name }}
                    </h1>
                    <p class="text-sm text-indigo-200/80 mt-0.5">
                        {{ profile.jurusan }} · {{ profile.universitas }}
                    </p>
                    <span
                        class="inline-block mt-2 text-xs font-medium text-indigo-100 bg-white/10 px-2.5 py-1 rounded-full"
                    >
                        Semester {{ profile.semester }}
                    </span>
                </div>

                <!-- Edit button -->
                <button
                    @click="toggleEdit"
                    class="shrink-0 inline-flex items-center gap-2 px-4 py-2 rounded-lg font-medium text-sm transition"
                    :class="
                        isEditing
                            ? 'bg-emerald-500 hover:bg-emerald-600 text-white'
                            : 'bg-white/10 hover:bg-white/20 text-white'
                    "
                >
                    <svg
                        v-if="!isEditing"
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                        />
                    </svg>
                    <svg
                        v-else
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>
                    {{ isEditing ? "Simpan" : "Edit Profil" }}
                </button>
            </div>
        </div>

        <!-- Data Diri -->
        <div
            class="bg-white rounded-2xl shadow-sm border p-6 md:p-7 mb-6 fade-up"
            style="animation-delay: 0.05s"
        >
            <h2 class="text-base font-semibold text-gray-800 mb-5">
                Data Diri
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div v-for="field in fields" :key="field.key">
                    <label
                        class="text-xs font-medium text-gray-400 uppercase tracking-wide"
                    >
                        {{ field.label }}
                    </label>
                    <div
                        v-if="!isEditing"
                        class="mt-1 text-sm font-medium text-gray-800"
                    >
                        {{ profile[field.key] || "—" }}
                    </div>
                    <input
                        v-else
                        v-model="profile[field.key]"
                        type="text"
                        class="mt-1 w-full text-sm border border-gray-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500"
                    />
                </div>
            </div>
        </div>

        <!-- Tautan Eksternal -->
        <div
            class="bg-white rounded-2xl shadow-sm border p-6 md:p-7 fade-up"
            style="animation-delay: 0.1s"
        >
            <h2 class="text-base font-semibold text-gray-800 mb-5">Tautan</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div
                    v-for="link in links"
                    :key="link.key"
                    class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 bg-gray-50/50"
                >
                    <div
                        class="h-9 w-9 rounded-lg bg-white border flex items-center justify-center shrink-0"
                        v-html="link.icon"
                    ></div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-gray-400">{{ link.label }}</p>
                        <div
                            v-if="!isEditing"
                            class="text-sm font-medium text-gray-800 truncate"
                        >
                            {{ profile[link.key] || "Belum diisi" }}
                        </div>
                        <input
                            v-else
                            v-model="profile[link.key]"
                            type="text"
                            :placeholder="link.placeholder"
                            class="mt-0.5 w-full text-sm border border-gray-200 rounded-lg px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref, onMounted } from "vue";
import studentProfileService from "@/services/student/studentProfileService";
import { useAuthStore } from "@/stores/auth";

const authStore = useAuthStore();

// Nama field HARUS sama persis dengan kolom backend
const profile = reactive({
    photoUrl: "",
    name: "",
    email: "",
    university: "",
    major: "",
    semester: "",
    phone: "",
    github_url: "",
    linkedin_url: "",
    portfolio_url: "",
});

const isEditing = ref(false);
const saving = ref(false);
const errors = ref({});

onMounted(async () => {
    profile.name = authStore.user?.name ?? "";
    profile.email = authStore.user?.email ?? "";

    try {
        const { profile: data } = await studentProfileService.getProfile();
        if (data) {
            profile.university = data.university ?? "";
            profile.major = data.major ?? "";
            profile.semester = data.semester ?? "";
            profile.phone = data.phone ?? "";
            profile.github_url = data.github_url ?? "";
            profile.linkedin_url = data.linkedin_url ?? "";
            profile.portfolio_url = data.portfolio_url ?? "";
        }
    } catch (err) {
        console.error("Gagal memuat profil", err);
    }
});

async function toggleEdit() {
    if (isEditing.value) {
        // lagi mode edit -> simpan
        saving.value = true;
        errors.value = {};
        try {
            await studentProfileService.updateProfile({
                university: profile.university,
                major: profile.major,
                semester: profile.semester,
                phone: profile.phone,
                github_url: profile.github_url,
                linkedin_url: profile.linkedin_url,
                portfolio_url: profile.portfolio_url,
            });
            await authStore.fetchMe(); // refresh is_profile_complete
            isEditing.value = false;
        } catch (err) {
            if (err.response?.status === 422) {
                errors.value = err.response.data.errors;
            }
        } finally {
            saving.value = false;
        }
    } else {
        isEditing.value = true;
    }
}

const fields = [
    { key: "email", label: "Email" },
    { key: "university", label: "Universitas" },
    { key: "major", label: "Jurusan" },
    { key: "semester", label: "Semester" },
    { key: "phone", label: "Nomor HP" },
];

const links = [
    {
        key: "github_url",
        label: "Github",
        placeholder: "github.com/username",
        icon: "...",
    },
    {
        key: "linkedin_url",
        label: "LinkedIn",
        placeholder: "linkedin.com/in/username",
        icon: "...",
    },
    {
        key: "portfolio_url",
        label: "Portfolio",
        placeholder: "namamu.dev",
        icon: "...",
    },
];
</script>

<style scoped>
.fade-up {
    animation: fadeUp 0.6s ease-out both;
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
.orb {
    position: absolute;
    border-radius: 9999px;
    filter: blur(40px);
    opacity: 0.25;
    pointer-events: none;
}
.orb-blue {
    width: 180px;
    height: 180px;
    background: #3b82f6;
    top: -60px;
    right: 40px;
}
.orb-amber {
    width: 140px;
    height: 140px;
    background: #f59e0b;
    bottom: -50px;
    right: 180px;
}
</style>
