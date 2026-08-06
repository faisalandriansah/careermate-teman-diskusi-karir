<template>
    <!-- Lebarkan container ke max-w-7xl agar tidak banyak area kosong di monitor lebar -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8 max-w-7xl">
        <!-- Banner Header Profil (Responsif Flex) -->
        <StudentHero>
            <div
                class="relative flex flex-col sm:flex-row items-center sm:items-start md:items-center justify-between gap-6"
            >
                <!-- Info Utama User -->
                <div
                    class="flex flex-col sm:flex-row items-center gap-5 text-center sm:text-left min-w-0 w-full sm:w-auto"
                >
                    <!-- Foto Profil -->
                    <div class="relative shrink-0">
                        <div
                            class="h-20 w-20 md:h-24 md:w-24 rounded-full bg-white/10 border-2 border-white/20 overflow-hidden flex items-center justify-center shadow-inner"
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
                            class="absolute bottom-0 right-0 h-8 w-8 rounded-full bg-indigo-600 hover:bg-indigo-700 active:scale-95 flex items-center justify-center border-2 border-slate-900 transition shadow"
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

                    <!-- Nama & Kampus -->
                    <div class="min-w-0">
                        <h1
                            class="text-xl md:text-2xl font-bold text-white truncate"
                        >
                            {{ profile.name || "Pengguna" }}
                        </h1>
                        <p class="text-sm text-indigo-200/90 mt-1 truncate">
                            {{ profile.major || "Jurusan belum diisi" }} ·
                            {{
                                profile.university || "Universitas belum diisi"
                            }}
                        </p>
                        <div
                            class="mt-2 flex flex-wrap items-center justify-center sm:justify-start gap-2"
                        >
                            <span
                                class="inline-block text-xs font-medium text-indigo-100 bg-white/10 backdrop-blur-md px-3 py-1 rounded-full border border-white/10"
                            >
                                Semester {{ profile.semester || "-" }}
                            </span>
                            <span
                                :class="
                                    isProfileComplete
                                        ? 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30'
                                        : 'bg-amber-500/20 text-amber-300 border-amber-500/30'
                                "
                                class="inline-block text-xs font-medium px-3 py-1 rounded-full border backdrop-blur-md"
                            >
                                {{
                                    isProfileComplete
                                        ? "✓ Profil Lengkap"
                                        : "⚠️ Profil Belum Lengkap"
                                }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <button
                    @click="toggleEdit"
                    :disabled="saving"
                    class="w-full sm:w-auto shrink-0 inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl font-medium text-sm transition-all shadow-md active:scale-95 disabled:opacity-50"
                    :class="
                        isEditing
                            ? 'bg-emerald-600 hover:bg-emerald-500 text-white'
                            : 'bg-white/10 hover:bg-white/20 text-white backdrop-blur-md border border-white/10'
                    "
                >
                    <svg
                        v-if="!isEditing && !saving"
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
                        v-else-if="isEditing && !saving"
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
                    <span>{{
                        saving
                            ? "Menyimpan..."
                            : isEditing
                              ? "Simpan Perubahan"
                              : "Edit Profil"
                    }}</span>
                </button>
            </div>
        </StudentHero>

        <!-- Layout Grid 2 Kolom di Desktop (lg:grid-cols-3) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kolom Kiri: Data Diri (Memakan 2 Kolom di Desktop) -->
            <PageCard
                class="lg:col-span-2 fade-up"
                padding="p-5 md:p-7"
                style="animation-delay: 0.05s"
            >
                <div class="flex items-center justify-between mb-5">
                    <h2
                        class="text-base font-semibold text-slate-800 flex items-center gap-2"
                    >
                        <svg
                            class="w-5 h-5 text-indigo-600"
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
                        Data Akademik & Kontak
                    </h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div
                        v-for="field in fields"
                        :key="field.key"
                        class="space-y-1"
                    >
                        <label
                            class="text-xs font-semibold text-slate-400 uppercase tracking-wider"
                        >
                            {{ field.label }}
                        </label>

                        <!-- Mode View -->
                        <div
                            v-if="!isEditing"
                            class="text-sm font-medium text-slate-800 bg-slate-50/60 rounded-lg p-3 border border-slate-100 min-h-[42px] flex items-center"
                        >
                            {{ profile[field.key] || "—" }}
                        </div>

                        <!-- Mode Edit -->
                        <div v-else>
                            <input
                                v-model="profile[field.key]"
                                type="text"
                                :disabled="field.readonly"
                                :class="[
                                    'w-full text-sm border rounded-lg px-3 py-2.5 transition focus:outline-none focus:ring-2',
                                    field.readonly
                                        ? 'bg-slate-100 text-slate-500 border-slate-200 cursor-not-allowed'
                                        : 'border-slate-300 focus:ring-indigo-100 focus:border-indigo-600 text-slate-800',
                                ]"
                            />
                            <span
                                v-if="errors[field.key]"
                                class="text-xs text-rose-500 mt-1 block"
                            >
                                {{ errors[field.key][0] }}
                            </span>
                        </div>
                    </div>
                </div>
            </PageCard>

            <!-- Kolom Kanan: Tautan Eksternal (Memakan 1 Kolom di Desktop) -->
            <PageCard
                class="lg:col-span-1 fade-up"
                padding="p-5 md:p-7"
                style="animation-delay: 0.1s"
            >
                <h2
                    class="text-base font-semibold text-slate-800 mb-5 flex items-center gap-2"
                >
                    <svg
                        class="w-5 h-5 text-indigo-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"
                        />
                    </svg>
                    Portofolio & Media Sosial
                </h2>

                <div class="space-y-4">
                    <div
                        v-for="link in links"
                        :key="link.key"
                        class="p-3.5 rounded-xl border border-slate-100 bg-slate-50/50 flex flex-col justify-center"
                    >
                        <div class="flex items-center gap-3">
                            <div
                                class="h-9 w-9 rounded-lg bg-white border border-slate-200/60 flex items-center justify-center shrink-0 shadow-sm text-slate-600"
                            >
                                <svg
                                    class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        :d="link.iconD"
                                    />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p
                                    class="text-xs font-semibold text-slate-400 uppercase tracking-wider"
                                >
                                    {{ link.label }}
                                </p>

                                <!-- Mode View -->
                                <div v-if="!isEditing" class="mt-0.5">
                                    <a
                                        v-if="profile[link.key]"
                                        :href="formatUrl(profile[link.key])"
                                        target="_blank"
                                        class="text-sm font-medium text-indigo-600 hover:underline truncate block"
                                    >
                                        {{ profile[link.key] }}
                                    </a>
                                    <span
                                        v-else
                                        class="text-sm text-slate-400 italic"
                                        >Belum diisi</span
                                    >
                                </div>

                                <!-- Mode Edit -->
                                <div v-else class="mt-1">
                                    <input
                                        v-model="profile[link.key]"
                                        type="text"
                                        :placeholder="link.placeholder"
                                        class="w-full text-sm border border-slate-300 rounded-lg px-2.5 py-1.5 focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-600 text-slate-800"
                                    />
                                </div>
                            </div>
                        </div>
                        <span
                            v-if="isEditing && errors[link.key]"
                            class="text-xs text-rose-500 mt-1 block"
                        >
                            {{ errors[link.key][0] }}
                        </span>
                    </div>
                </div>
            </PageCard>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref, computed, onMounted } from "vue";
import studentProfileService from "@/services/student/studentProfileService";
import { useAuthStore } from "@/stores/auth";
import StudentHero from "@/components/student/StudentHero.vue";
import PageCard from "@/components/student/PageCard.vue";

const authStore = useAuthStore();

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

// Cek kelengkapan profil secara otomatis
const isProfileComplete = computed(() => {
    return Boolean(
        profile.university &&
        profile.major &&
        profile.semester &&
        profile.phone,
    );
});

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
            await authStore.fetchMe();
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

const formatUrl = (url) => {
    if (!url) return "#";
    return url.startsWith("http://") || url.startsWith("https://")
        ? url
        : `https://${url}`;
};

const fields = [
    { key: "email", label: "Email", readonly: true },
    { key: "university", label: "Universitas", readonly: false },
    { key: "major", label: "Jurusan", readonly: false },
    { key: "semester", label: "Semester", readonly: false },
    { key: "phone", label: "Nomor HP", readonly: false },
];

const links = [
    {
        key: "github_url",
        label: "Github",
        placeholder: "github.com/username",
        iconD: "M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4",
    },
    {
        key: "linkedin_url",
        label: "LinkedIn",
        placeholder: "linkedin.com/in/username",
        iconD: "M21 13v10h-6v-8a2 2 0 00-2-2 2 2 0 00-2 2v8h-6v-10h6v1.8c.8-1.2 2.1-1.8 3.5-1.8 3.2 0 5.5 2.1 5.5 6.2zM3 9h4v14h-4zM5 3a2 2 0 100 4 2 2 0 000-4z",
    },
    {
        key: "portfolio_url",
        label: "Portfolio",
        placeholder: "namamu.dev",
        iconD: "M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9",
    },
];
</script>

<style scoped>
.fade-up {
    animation: fadeUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) both;
}
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(16px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
