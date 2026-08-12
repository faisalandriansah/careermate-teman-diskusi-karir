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
                                class="h-10 w-10 text-blue-200"
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
                            @click="triggerPhotoPicker"
                            class="absolute bottom-0 right-0 h-8 w-8 rounded-full bg-blue-600 hover:bg-blue-700 flex items-center justify-center border-2 border-slate-900 transition"
                            title="Ganti foto"
                        >
                            <svg
                                v-if="!uploadingPhoto"
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
                            <svg
                                v-else
                                class="h-4 w-4 text-white animate-spin"
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
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                                ></path>
                            </svg>
                        </button>
                        <input
                            ref="photoInput"
                            type="file"
                            accept="image/png, image/jpeg"
                            class="hidden"
                            @change="handlePhotoSelect"
                        />
                    </div>

                    <!-- Nama & Kampus -->
                    <div class="min-w-0">
                        <h1
                            class="text-xl md:text-2xl font-bold text-white truncate"
                        >
                            {{ profile.name || "Pengguna" }}
                        </h1>
                        <p class="text-sm text-blue-200/90 mt-1 truncate">
                            {{ profile.major || "Jurusan belum diisi" }} ·
                            {{
                                profile.university || "Universitas belum diisi"
                            }}
                        </p>
                        <div
                            class="mt-2 flex flex-wrap items-center justify-center sm:justify-start gap-2"
                        >
                            <span
                                class="inline-block text-xs font-medium text-blue-100 bg-white/10 backdrop-blur-md px-3 py-1 rounded-full border border-white/10"
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
                            class="w-5 h-5 text-blue-600"
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
                    <div v-if="isProfileLoading" class="col-span-full">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div v-for="n in 4" :key="n" class="space-y-2">
                                <div
                                    class="h-3 w-24 bg-slate-200 rounded animate-pulse"
                                ></div>
                                <div
                                    class="h-[42px] bg-slate-100 rounded-lg animate-pulse"
                                ></div>
                            </div>
                        </div>
                    </div>
                    <div
                        v-for="field in fields"
                        v-else
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
                                        : 'border-slate-300 focus:ring-blue-100 focus:border-blue-600 text-slate-800',
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
                        class="w-5 h-5 text-blue-600"
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
                    <div v-if="isProfileLoading">
                        <div
                            v-for="n in 3"
                            :key="n"
                            class="p-3.5 rounded-xl border border-slate-100 bg-slate-50/50 flex items-center gap-3"
                        >
                            <div
                                class="h-9 w-9 rounded-lg bg-slate-200 animate-pulse shrink-0"
                            ></div>
                            <div class="flex-1 space-y-2">
                                <div
                                    class="h-3 w-24 bg-slate-200 rounded animate-pulse"
                                ></div>
                                <div
                                    class="h-4 w-full bg-slate-100 rounded animate-pulse"
                                ></div>
                            </div>
                        </div>
                    </div>
                    <div
                        v-for="link in links"
                        v-else
                        :key="link.key"
                        class="p-3.5 rounded-xl border border-slate-100 bg-slate-50/50 flex flex-col justify-center"
                    >
                        <div class="flex items-center gap-3">
                            <div
                                class="h-9 w-9 rounded-lg bg-white border border-slate-200/60 flex items-center justify-center shrink-0 shadow-sm text-slate-600"
                            >
                                <svg
                                    class="w-5 h-5"
                                    :fill="
                                        link.filled ? 'currentColor' : 'none'
                                    "
                                    :stroke="
                                        link.filled ? 'none' : 'currentColor'
                                    "
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        v-if="!link.filled"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        :d="link.iconD"
                                    />
                                    <path v-else :d="link.iconD" />
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
                                        class="text-sm font-medium text-blue-600 hover:underline truncate block"
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
                                        class="w-full text-sm border border-slate-300 rounded-lg px-2.5 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-600 text-slate-800"
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

        <PhotoCropModal
            :open="photoCropOpen"
            :image-url="photoPreviewUrl"
            :saving="uploadingPhoto"
            @close="closeCropper"
            @save="handleCropSave"
        />
    </div>
</template>

<script setup>
import { reactive, ref, computed, onMounted } from "vue";
import studentProfileService from "@/services/student/studentProfileService";
import { useAuthStore } from "@/stores/auth";
import StudentHero from "@/components/student/StudentHero.vue";
import PageCard from "@/components/student/PageCard.vue";
import PhotoCropModal from "@/components/student/PhotoCropModal.vue";
import { notify } from "@/utils/toast";

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
const isProfileLoading = ref(!authStore.user?.student_profile);
const photoInput = ref(null);
const uploadingPhoto = ref(false);
const photoCropOpen = ref(false);
const photoPreviewUrl = ref("");

function triggerPhotoPicker() {
    photoInput.value?.click();
}

function handlePhotoSelect(e) {
    const file = e.target.files[0];
    if (!file) return;

    if (!["image/jpeg", "image/png"].includes(file.type)) {
        notify.warning("Foto harus berformat JPG atau PNG.");
        if (photoInput.value) photoInput.value.value = "";
        return;
    }
    if (file.size > 5 * 1024 * 1024) {
        notify.warning("Ukuran foto maksimal 5MB.");
        if (photoInput.value) photoInput.value.value = "";
        return;
    }

    photoPreviewUrl.value = URL.createObjectURL(file);
    photoCropOpen.value = true;
    if (photoInput.value) photoInput.value.value = "";
}

function closeCropper() {
    photoCropOpen.value = false;
    if (photoPreviewUrl.value) {
        URL.revokeObjectURL(photoPreviewUrl.value);
        photoPreviewUrl.value = "";
    }
}

async function handleCropSave(blob) {
    if (!blob) return;

    uploadingPhoto.value = true;
    photoCropOpen.value = false;
    try {
        const file = new File([blob], "photo.jpg", { type: blob.type || "image/jpeg" });
        const result = await studentProfileService.uploadPhoto(file);
        profile.photoUrl = result.photo_url;
        await authStore.fetchMe();
        notify.success("Foto profil berhasil diperbarui.");
    } catch (err) {
        notify.error(err.response?.data?.message ?? "Gagal mengunggah foto. Coba lagi.");
    } finally {
        uploadingPhoto.value = false;
        if (photoPreviewUrl.value) {
            URL.revokeObjectURL(photoPreviewUrl.value);
            photoPreviewUrl.value = "";
        }
    }
}

function applyProfileData(data) {
    if (!data) return;
    profile.photoUrl = data.photo_url ?? "";
    profile.university = data.university ?? "";
    profile.major = data.major ?? "";
    profile.semester = data.semester ?? "";
    profile.phone = data.phone ?? "";
    profile.github_url = data.github_url ?? "";
    profile.linkedin_url = data.linkedin_url ?? "";
    profile.portfolio_url = data.portfolio_url ?? "";
}

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

    // Pre-populate instan dari auth store (tanpa menunggu network)
    applyProfileData(authStore.user?.student_profile);

    try {
        const { profile: data } = await studentProfileService.getProfile();
        if (data) {
            applyProfileData(data);
        }
    } catch (err) {
        console.error("Gagal memuat profil", err);
    } finally {
        isProfileLoading.value = false;
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
        filled: true,
        iconD: "M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 11.001-4.124 2.062 2.062 0 01-.001 4.124zM7.114 20.452H3.558V9h3.556v11.452z",
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
