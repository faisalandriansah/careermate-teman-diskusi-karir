<template>
    <!-- Lebarkan container ke max-w-7xl agar tidak banyak area kosong di monitor lebar -->
    <div class="container mx-auto px-4 py-8 max-w-7xl">
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

        <!-- Kartu Data Profil (satu kartu, dua sub-bagian, responsive) -->
        <div
            class="bg-white rounded-2xl border border-slate-100 shadow-sm fade-up p-5 sm:p-8"
            style="animation-delay: 0.05s"
        >
            <!-- Header Kartu -->
            <div
                class="flex items-center gap-3 sm:gap-4 mb-6 pb-4 border-b border-slate-100"
            >
                <div
                    class="h-11 w-11 rounded-xl bg-blue-50 flex items-center justify-center shrink-0"
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
                </div>
                <div class="min-w-0">
                    <h2
                        class="text-base sm:text-lg font-semibold text-slate-800"
                    >
                        Data Profil
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-400 mt-0.5">
                        Data pribadi & kontak, serta tautan portofolio dan media
                        sosial kamu.
                    </p>
                </div>
            </div>

            <!-- Daftar data profil: grid tile responsif -->
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-4"
            >
                <template v-if="isProfileLoading">
                    <div
                        v-for="n in 8"
                        :key="n"
                        class="rounded-xl border border-slate-100 bg-slate-50/60 p-4 min-h-[88px] flex flex-col justify-between"
                    >
                        <div class="flex items-center gap-2">
                            <div
                                class="h-7 w-7 rounded-lg bg-slate-200 animate-pulse"
                            ></div>
                            <div
                                class="h-3 w-20 bg-slate-200 rounded animate-pulse"
                            ></div>
                        </div>
                        <div
                            class="mt-3 h-5 bg-slate-100 rounded-lg animate-pulse"
                        ></div>
                    </div>
                </template>

                <div
                    v-for="item in profileItems"
                    v-else
                    :key="item.key"
                    class="rounded-xl border border-slate-100 bg-slate-50/60 p-4 min-h-[88px] flex flex-col"
                    :class="isEditing ? 'bg-white border-slate-200' : ''"
                >
                    <div class="flex items-center gap-2">
                        <span
                            class="h-7 w-7 shrink-0 rounded-lg flex items-center justify-center"
                            :class="
                                item.isLink
                                    ? 'bg-blue-50 text-blue-600'
                                    : 'bg-slate-100 text-slate-500'
                            "
                        >
                            <svg
                                class="w-3.5 h-3.5"
                                :fill="item.filled ? 'currentColor' : 'none'"
                                :stroke="item.filled ? 'none' : 'currentColor'"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    v-if="!item.filled"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    :d="item.iconD"
                                />
                                <path v-else :d="item.iconD" />
                            </svg>
                        </span>
                        <span
                            class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider"
                        >
                            {{ item.label }}
                        </span>
                    </div>

                    <!-- Mode View -->
                    <div v-if="!isEditing" class="mt-2 min-w-0">
                        <a
                            v-if="item.isLink && profile[item.key]"
                            :href="formatUrl(profile[item.key])"
                            target="_blank"
                            :title="profile[item.key]"
                            class="block text-sm font-medium text-blue-600 hover:underline break-all w-full"
                        >
                            {{ profile[item.key] }}
                        </a>
                        <span
                            v-else
                            class="block text-sm font-medium text-slate-800 break-words"
                            :class="{ 'text-slate-400': !profile[item.key] }"
                        >
                            {{ profile[item.key] || "—" }}
                        </span>
                    </div>

                    <!-- Mode Edit -->
                    <div v-else class="mt-2">
                        <input
                            v-model="profile[item.key]"
                            type="text"
                            :disabled="item.readonly"
                            :placeholder="item.isLink ? item.placeholder : ''"
                            :class="[
                                'w-full text-sm border rounded-lg px-3 py-2 transition focus:outline-none focus:ring-2',
                                item.readonly
                                    ? 'bg-slate-100 text-slate-500 border-slate-200 cursor-not-allowed'
                                    : 'border-slate-300 focus:ring-blue-100 focus:border-blue-600 text-slate-800',
                            ]"
                        />
                        <span
                            v-if="errors[item.key]"
                            class="text-xs text-rose-500 mt-1 block"
                        >
                            {{ errors[item.key][0] }}
                        </span>
                    </div>
                </div>
            </div>
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

const profileItems = [
    {
        key: "email",
        label: "Email",
        readonly: true,
        iconD: "M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z",
    },
    {
        key: "university",
        label: "Universitas",
        readonly: false,
        iconD: "M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253",
    },
    {
        key: "major",
        label: "Jurusan",
        readonly: false,
        iconD: "M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222",
    },
    {
        key: "semester",
        label: "Semester",
        readonly: false,
        iconD: "M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z",
    },
    {
        key: "phone",
        label: "Nomor HP",
        readonly: false,
        iconD: "M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z",
    },
    {
        key: "github_url",
        label: "Github",
        isLink: true,
        filled: true,
        placeholder: "github.com/username",
        iconD: "M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z",
    },
    {
        key: "linkedin_url",
        label: "LinkedIn",
        isLink: true,
        filled: true,
        placeholder: "linkedin.com/in/username",
        iconD: "M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 11.001-4.124 2.062 2.062 0 01-.001 4.124zM7.114 20.452H3.558V9h3.556v11.452z",
    },
    {
        key: "portfolio_url",
        label: "Portfolio",
        isLink: true,
        filled: false,
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
