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
import { ref, reactive } from "vue";

// Ganti dengan data asli dari API/store nanti
const profile = reactive({
    photoUrl: "",
    name: "Achmad Faisal",
    email: "faisal@example.com",
    universitas: "Politeknik Negeri Malang",
    jurusan: "Manajemen",
    semester: "5",
    github: "github.com/achmadfaisal",
    linkedin: "linkedin.com/in/achmadfaisal",
    portfolio: "achmadfaisal.dev",
});

const isEditing = ref(false);
function toggleEdit() {
    isEditing.value = !isEditing.value;
    // TODO: kalau isEditing berubah dari true -> false, panggil API simpan di sini
}

const fields = [
    { key: "email", label: "Email" },
    { key: "universitas", label: "Universitas" },
    { key: "jurusan", label: "Jurusan" },
    { key: "semester", label: "Semester" },
];

const links = [
    {
        key: "github",
        label: "Github",
        placeholder: "github.com/username",
        icon: '<svg class="h-5 w-5 text-gray-700" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.339-2.221-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.31.678.921.678 1.856 0 1.339-.012 2.419-.012 2.749 0 .268.18.58.688.482A10.02 10.02 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>',
    },
    {
        key: "linkedin",
        label: "LinkedIn",
        placeholder: "linkedin.com/in/username",
        icon: '<svg class="h-5 w-5 text-blue-700" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 11.001-4.124 2.062 2.062 0 010 4.124zM7.114 20.452H3.558V9h3.556v11.452z"/></svg>',
    },
    {
        key: "portfolio",
        label: "Portfolio",
        placeholder: "namamu.dev",
        icon: '<svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/></svg>',
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
