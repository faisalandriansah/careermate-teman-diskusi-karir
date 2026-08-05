<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Simple header for student layout -->
        <header class="bg-white shadow relative z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <router-link
                            to="/student/dashboard"
                            class="flex items-center gap-2"
                        >
                            <img
                                :src="logo"
                                alt="CareerMateAI logo"
                                class="w-8 h-8 object-contain"
                            />
                            <span class="text-xl font-bold text-slate-800"
                                >CareerMate</span
                            >
                        </router-link>
                    </div>
                    <div class="flex items-center space-x-4">
                        <nav class="hidden sm:flex items-center space-x-2">
                            <router-link
                                to="/student/dashboard"
                                class="px-3 py-2 text-sm text-slate-600 rounded-md hover:bg-slate-50"
                                active-class="bg-slate-100 font-semibold"
                                >Dashboard</router-link
                            >
                            <router-link
                                to="/student/profile"
                                class="px-3 py-2 text-sm text-slate-600 rounded-md hover:bg-slate-50"
                                active-class="bg-slate-100 font-semibold"
                                >Profile</router-link
                            >
                            <router-link
                                to="/student/cv"
                                class="px-3 py-2 text-sm text-slate-600 rounded-md hover:bg-slate-50"
                                active-class="bg-slate-100 font-semibold"
                                >Upload CV</router-link
                            >
                            <router-link
                                to="/student/HasilAnalisis"
                                class="px-3 py-2 text-sm text-slate-600 rounded-md hover:bg-slate-50"
                                active-class="bg-slate-100 font-semibold"
                                >Hasil Analisis</router-link
                            >
                            <router-link
                                to="/student/RiwayatAnalisis"
                                class="px-3 py-2 text-sm text-slate-600 rounded-md hover:bg-slate-50"
                                active-class="bg-slate-100 font-semibold"
                                >Riwayat Analisis</router-link
                            >
                            <router-link
                                to="/student/support"
                                class="px-3 py-2 text-sm text-slate-600 rounded-md hover:bg-slate-50"
                                active-class="bg-slate-100 font-semibold"
                                >Support</router-link
                            >
                        </nav>

                        <div ref="stdRef" class="relative account-dropdown">
                            <button
                                @click="stdOpen = !stdOpen"
                                title="Menu akun"
                                :class="[
                                    'group flex items-center gap-3 rounded-full border bg-white py-1.5 pl-1.5 pr-3 transition-all duration-200',
                                    stdOpen
                                        ? 'border-indigo-200 shadow-lg shadow-indigo-500/10'
                                        : 'border-slate-200 shadow-sm hover:border-indigo-200 hover:shadow-md',
                                ]"
                            >
                                <div class="relative shrink-0">
                                    <div
                                        class="h-8 w-8 rounded-full bg-gradient-to-br from-indigo-500 via-violet-500 to-indigo-600 flex items-center justify-center text-white text-xs font-bold shadow-md shadow-indigo-500/30 group-hover:scale-105 transition-transform duration-200"
                                    >
                                        {{ shortInitial }}
                                    </div>
                                    <span
                                        class="absolute -bottom-0.5 -right-0.5 h-2.5 w-2.5 rounded-full bg-emerald-500 ring-2 ring-white"
                                    ></span>
                                </div>
                                <div class="hidden sm:block text-left">
                                    <div
                                        class="text-sm font-medium text-slate-800 leading-tight"
                                    >
                                        {{ displayName }}
                                    </div>
                                    <div
                                        class="text-[11px] text-slate-400 leading-tight"
                                    >
                                        {{ displayRole }}
                                    </div>
                                </div>
                                <svg
                                    class="h-3.5 w-3.5 text-slate-400 transition-transform duration-200"
                                    :class="stdOpen ? 'rotate-180' : ''"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>

                            <!-- 3D Dropdown Panel -->
                            <transition name="dropdown">
                                <div
                                    v-if="stdOpen"
                                    class="dropdown-panel absolute right-0 z-50 mt-3 w-64 overflow-hidden rounded-2xl border border-slate-100 bg-white text-slate-900 shadow-2xl shadow-slate-300/50"
                                >
                                    <!-- Header shine -->
                                    <div
                                        class="pointer-events-none absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-indigo-400/60 to-transparent"
                                    ></div>

                                    <!-- Profile Summary -->
                                    <div
                                        class="relative bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 px-5 py-4 overflow-hidden"
                                    >
                                        <div
                                            class="orb orb-dd-1"
                                        ></div>
                                        <div
                                            class="orb orb-dd-2"
                                        ></div>
                                        <div
                                            class="relative flex items-center gap-3"
                                        >
                                            <div
                                                class="h-11 w-11 shrink-0 rounded-full bg-gradient-to-br from-indigo-400 to-violet-500 flex items-center justify-center text-white text-sm font-bold shadow-lg shadow-indigo-500/40 ring-2 ring-white/20"
                                            >
                                                {{ shortInitial }}
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p
                                                    class="text-sm font-bold text-white truncate"
                                                >
                                                    {{ displayName }}
                                                </p>
                                                <p
                                                    class="text-[11px] text-indigo-200/80 truncate"
                                                >
                                                    {{ displayEmail }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Status badge -->
                                        <div
                                            class="relative mt-3 flex items-center gap-2"
                                        >
                                            <span
                                                v-if="auth.isProfileComplete"
                                                class="inline-flex items-center gap-1 rounded-full bg-emerald-500/20 px-2.5 py-1 text-[10px] font-bold text-emerald-300 border border-emerald-500/30"
                                            >
                                                <svg
                                                    class="h-3 w-3"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="3"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                >
                                                    <polyline
                                                        points="20 6 9 17 4 12"
                                                    ></polyline>
                                                </svg>
                                                Profil Lengkap
                                            </span>
                                            <span
                                                v-else
                                                class="inline-flex items-center gap-1 rounded-full bg-amber-500/20 px-2.5 py-1 text-[10px] font-bold text-amber-300 border border-amber-500/30"
                                            >
                                                <span
                                                    class="h-1.5 w-1.5 rounded-full bg-amber-400 animate-pulse"
                                                ></span>
                                                Lengkapi Profil
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Menu -->
                                    <div class="p-2">
                                        <button
                                            @click="gotoProfile"
                                            class="menu-item flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-slate-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors"
                                        >
                                            <span
                                                class="menu-icon flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600"
                                            >
                                                <svg
                                                    class="h-4 w-4"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                >
                                                    <path
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                    ></path>
                                                </svg>
                                            </span>
                                            <span class="flex-1 text-left font-medium"
                                                >Edit Profil</span
                                            >
                                            <svg
                                                class="h-3.5 w-3.5 text-slate-300 group-hover:translate-x-0.5 transition-transform"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2.5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            >
                                                <polyline
                                                    points="9 18 15 12 9 6"
                                                ></polyline>
                                            </svg>
                                        </button>

                                        <button
                                            @click="gotoRiwayat"
                                            class="menu-item flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-slate-700 hover:bg-violet-50 hover:text-violet-700 transition-colors"
                                        >
                                            <span
                                                class="menu-icon flex h-8 w-8 items-center justify-center rounded-lg bg-violet-50 text-violet-600"
                                            >
                                                <svg
                                                    class="h-4 w-4"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                >
                                                    <path
                                                        d="M3 12a9 9 0 109-9 9.75 9.75 0 00-6.74 2.74L3 8"
                                                    ></path>
                                                    <path
                                                        d="M3 3v5h5"
                                                    ></path>
                                                    <path
                                                        d="M12 7v5l4 2"
                                                    ></path>
                                                </svg>
                                            </span>
                                            <span class="flex-1 text-left font-medium"
                                                >Riwayat Analisis</span
                                            >
                                            <svg
                                                class="h-3.5 w-3.5 text-slate-300"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2.5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            >
                                                <polyline
                                                    points="9 18 15 12 9 6"
                                                ></polyline>
                                            </svg>
                                        </button>

                                        <button
                                            @click="gotoSupport"
                                            class="menu-item flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors"
                                        >
                                            <span
                                                class="menu-icon flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600"
                                            >
                                                <svg
                                                    class="h-4 w-4"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                >
                                                    <path
                                                        d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"
                                                    ></path>
                                                </svg>
                                            </span>
                                            <span class="flex-1 text-left font-medium"
                                                >Pusat Bantuan</span
                                            >
                                            <svg
                                                class="h-3.5 w-3.5 text-slate-300"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2.5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            >
                                                <polyline
                                                    points="9 18 15 12 9 6"
                                                ></polyline>
                                            </svg>
                                        </button>
                                    </div>

                                    <div
                                        class="mx-3 border-t border-slate-100"
                                    ></div>

                                    <!-- Logout -->
                                    <div class="p-2">
                                        <button
                                            @click="signOut"
                                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-rose-600 hover:bg-rose-50 transition-colors"
                                        >
                                            <span
                                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-50 text-rose-500"
                                            >
                                                <svg
                                                    class="h-4 w-4"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                >
                                                    <path
                                                        d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"
                                                    ></path>
                                                    <polyline
                                                        points="16 17 21 12 16 7"
                                                    ></polyline>
                                                    <line
                                                        x1="21"
                                                        y1="12"
                                                        x2="9"
                                                        y2="12"
                                                    ></line>
                                                </svg>
                                            </span>
                                            <span class="flex-1 text-left"
                                                >Keluar</span
                                            >
                                        </button>
                                    </div>
                                </div>
                            </transition>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main>
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <router-view />
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import apiClient from "@/services/api";
import logo from "@/assets/logo.png";

// Komponen layout student sederhana
const stdOpen = ref(false);
const stdRef = ref(null);
const router = useRouter();
const auth = useAuthStore();

const displayName = computed(() => auth.user?.name || "Student User");
const displayEmail = computed(() => auth.user?.email || "");
const displayRole = computed(() => auth.user?.role ?? "Mahasiswa");
const shortInitial = computed(() => {
    if (!auth.user?.name) return "S";

    return auth.user.name
        .split(" ")
        .map((n) => n[0])
        .join("")
        .substring(0, 2)
        .toUpperCase();
});
async function signOut() {
    try {
        await apiClient.post("/auth/logout");
    } catch (e) {
        console.log(e);
    }

    auth.logout();

    stdOpen.value = false;

    router.push("/login");
}
function gotoProfile() {
    stdOpen.value = false;
    router.push("/student/profile");
}
function gotoRiwayat() {
    stdOpen.value = false;
    router.push("/student/RiwayatAnalisis");
}
function gotoSupport() {
    stdOpen.value = false;
    router.push("/student/support");
}

function onClickOutside(e) {
    const el = stdRef.value;
    if (!el) return;
    if (!el.contains(e.target)) stdOpen.value = false;
}

onMounted(async () => {
    document.addEventListener("click", onClickOutside);

    if (auth.token) {
        try {
            await auth.fetchMe();
        } catch (e) {
            console.log("Auth me gagal", e);
        }
    }
});
onBeforeUnmount(() => {
    document.removeEventListener("click", onClickOutside);
});
</script>

<style scoped>
/* ===== 3D Dropdown Panel ===== */
.account-dropdown {
    perspective: 900px;
}

.dropdown-panel {
    transform-origin: top right;
    transform-style: preserve-3d;
}

/* Entrance / exit 3D animation */
.dropdown-enter-active,
.dropdown-leave-active {
    transition:
        transform 0.28s cubic-bezier(0.16, 1, 0.3, 1),
        opacity 0.22s ease;
}
.dropdown-enter-from,
.dropdown-leave-to {
    opacity: 0;
    transform: translateY(10px) rotateX(-14deg) scale(0.95);
}

/* Menu item micro-interaction */
.menu-item {
    position: relative;
}
.menu-item .menu-icon {
    transition: transform 0.2s cubic-bezier(0.16, 1, 0.3, 1);
}
.menu-item:hover .menu-icon {
    transform: translateX(3px) scale(1.08);
}

/* Orbs in profile header */
.orb-dd-1 {
    width: 120px;
    height: 120px;
    background: #6366f1;
    position: absolute;
    border-radius: 9999px;
    filter: blur(40px);
    opacity: 0.35;
    top: -50px;
    right: -30px;
    pointer-events: none;
}
.orb-dd-2 {
    width: 90px;
    height: 90px;
    background: #f59e0b;
    position: absolute;
    border-radius: 9999px;
    filter: blur(36px);
    opacity: 0.22;
    bottom: -40px;
    left: 30px;
    pointer-events: none;
}

@media (prefers-reduced-motion: reduce) {
    .dropdown-enter-active,
    .dropdown-leave-active {
        transition: none;
    }
    .dropdown-enter-from,
    .dropdown-leave-to {
        transform: none;
        opacity: 0;
    }
}
</style>
