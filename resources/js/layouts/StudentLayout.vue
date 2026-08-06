<template>
    <div class="min-h-screen bg-slate-100">
        <!-- Simple header for student layout -->
        <header class="bg-white border-b border-slate-100 shadow-sm relative z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <router-link
                            to="/student/dashboard"
                            class="flex items-center gap-2.5"
                        >
                            <img
                                :src="logo"
                                alt="CareerMateAI logo"
                                class="w-8 h-8 object-contain"
                            />
                            <span
                                class="text-lg font-bold text-slate-900 tracking-tight"
                                >CareerMate</span
                            >
                        </router-link>
                    </div>

                    <div class="flex items-center space-x-2 sm:space-x-3">
                        <!-- Desktop Nav -->
                        <nav class="hidden md:flex items-center space-x-1">
                            <router-link
                                to="/student/dashboard"
                                class="px-3 py-2 text-sm font-medium text-slate-600 rounded-lg hover:bg-slate-100 hover:text-slate-900 transition-colors"
                                active-class="bg-slate-100 text-slate-900 font-semibold"
                                >Dashboard</router-link
                            >
                            <router-link
                                to="/student/profile"
                                class="px-3 py-2 text-sm font-medium text-slate-600 rounded-lg hover:bg-slate-100 hover:text-slate-900 transition-colors"
                                active-class="bg-slate-100 text-slate-900 font-semibold"
                                >Profile</router-link
                            >
                            <router-link
                                to="/student/cv"
                                class="px-3 py-2 text-sm font-medium text-slate-600 rounded-lg hover:bg-slate-100 hover:text-slate-900 transition-colors"
                                active-class="bg-slate-100 text-slate-900 font-semibold"
                                >Upload CV</router-link
                            >
                            <router-link
                                to="/student/HasilAnalisis"
                                class="px-3 py-2 text-sm font-medium text-slate-600 rounded-lg hover:bg-slate-100 hover:text-slate-900 transition-colors"
                                active-class="bg-slate-100 text-slate-900 font-semibold"
                                >Hasil Analisis</router-link
                            >
                            <router-link
                                to="/student/RiwayatAnalisis"
                                class="px-3 py-2 text-sm font-medium text-slate-600 rounded-lg hover:bg-slate-100 hover:text-slate-900 transition-colors"
                                active-class="bg-slate-100 text-slate-900 font-semibold"
                                >Riwayat Analisis</router-link
                            >
                            <router-link
                                to="/student/support"
                                class="px-3 py-2 text-sm font-medium text-slate-600 rounded-lg hover:bg-slate-100 hover:text-slate-900 transition-colors"
                                active-class="bg-slate-100 text-slate-900 font-semibold"
                                >Support</router-link
                            >
                        </nav>

                        <!-- Mobile Menu Button -->
                        <button
                            ref="mobBtnRef"
                            @click.stop="toggleMobile"
                            class="md:hidden flex items-center justify-center h-10 w-10 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition-colors"
                            :aria-label="mobileOpen ? 'Tutup menu' : 'Buka menu'"
                        >
                            <svg
                                v-if="!mobileOpen"
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                            </svg>
                            <svg
                                v-else
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

                        <!-- Account Dropdown -->
                        <div ref="stdRef" class="relative">
                            <button
                                @click="stdOpen = !stdOpen"
                                title="Menu akun"
                                :class="[
                                    'group flex items-center gap-2 rounded-full border bg-white py-1.5 pl-1.5 pr-2.5 transition-all duration-200',
                                    stdOpen
                                        ? 'border-slate-300 shadow-sm'
                                        : 'border-slate-200 hover:border-slate-300',
                                ]"
                            >
                                <div
                                    class="h-8 w-8 shrink-0 rounded-full bg-indigo-600 flex items-center justify-center text-white text-xs font-semibold"
                                >
                                    {{ shortInitial }}
                                </div>
                                <div class="hidden sm:block text-left">
                                    <div
                                        class="text-sm font-semibold text-slate-800 leading-tight"
                                    >
                                        {{ displayName }}
                                    </div>
                                    <div
                                        class="text-[11px] text-slate-500 leading-tight"
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

                            <!-- Dropdown Panel -->
                            <transition name="dropdown">
                                <div
                                    v-if="stdOpen"
                                    class="dropdown-panel absolute right-0 z-50 mt-3 w-64 rounded-xl border border-slate-100 bg-white shadow-xl shadow-slate-200/60"
                                >
                                    <!-- Profile Summary -->
                                    <div
                                        class="px-4 py-4 border-b border-slate-100"
                                    >
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="h-10 w-10 shrink-0 rounded-full bg-indigo-600 flex items-center justify-center text-white text-sm font-semibold"
                                            >
                                                {{ shortInitial }}
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p
                                                    class="text-sm font-semibold text-slate-800 truncate"
                                                >
                                                    {{ displayName }}
                                                </p>
                                                <p
                                                    class="text-xs text-slate-400 truncate"
                                                >
                                                    {{ displayEmail }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Status badge -->
                                        <div class="mt-3">
                                            <span
                                                v-if="auth.isProfileComplete"
                                                class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-medium text-emerald-700 border border-emerald-100"
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
                                                class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2.5 py-1 text-[11px] font-medium text-amber-700 border border-amber-100"
                                            >
                                                <span
                                                    class="h-1.5 w-1.5 rounded-full bg-amber-500"
                                                ></span>
                                                Lengkapi Profil
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Menu -->
                                    <div class="p-1.5">
                                        <button
                                            @click="gotoProfile"
                                            class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors"
                                        >
                                            <svg
                                                class="h-4 w-4 text-slate-400"
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
                                            <span class="flex-1 text-left"
                                                >Edit Profil</span
                                            >
                                        </button>

                                        <button
                                            @click="gotoRiwayat"
                                            class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors"
                                        >
                                            <svg
                                                class="h-4 w-4 text-slate-400"
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
                                            <span class="flex-1 text-left"
                                                >Riwayat Analisis</span
                                            >
                                        </button>

                                        <button
                                            @click="gotoSupport"
                                            class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors"
                                        >
                                            <svg
                                                class="h-4 w-4 text-slate-400"
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
                                            <span class="flex-1 text-left"
                                                >Pusat Bantuan</span
                                            >
                                        </button>
                                    </div>

                                    <div
                                        class="mx-3 border-t border-slate-100"
                                    ></div>

                                    <!-- Logout -->
                                    <div class="p-1.5">
                                        <button
                                            @click="signOut"
                                            class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-rose-600 hover:bg-rose-50 transition-colors"
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

                <!-- Mobile Nav Panel -->
                <transition name="mobile-nav">
                    <nav
                        v-if="mobileOpen"
                        ref="mobRef"
                        class="md:hidden pb-3 pt-1 border-t border-slate-100 space-y-0.5"
                    >
                        <router-link
                            to="/student/dashboard"
                            @click="mobileOpen = false"
                            class="block px-3 py-2.5 text-sm font-medium text-slate-600 rounded-lg hover:bg-slate-100 hover:text-slate-900 transition-colors"
                            active-class="bg-slate-100 text-slate-900 font-semibold"
                            >Dashboard</router-link
                        >
                        <router-link
                            to="/student/profile"
                            @click="mobileOpen = false"
                            class="block px-3 py-2.5 text-sm font-medium text-slate-600 rounded-lg hover:bg-slate-100 hover:text-slate-900 transition-colors"
                            active-class="bg-slate-100 text-slate-900 font-semibold"
                            >Profile</router-link
                        >
                        <router-link
                            to="/student/cv"
                            @click="mobileOpen = false"
                            class="block px-3 py-2.5 text-sm font-medium text-slate-600 rounded-lg hover:bg-slate-100 hover:text-slate-900 transition-colors"
                            active-class="bg-slate-100 text-slate-900 font-semibold"
                            >Upload CV</router-link
                        >
                        <router-link
                            to="/student/HasilAnalisis"
                            @click="mobileOpen = false"
                            class="block px-3 py-2.5 text-sm font-medium text-slate-600 rounded-lg hover:bg-slate-100 hover:text-slate-900 transition-colors"
                            active-class="bg-slate-100 text-slate-900 font-semibold"
                            >Hasil Analisis</router-link
                        >
                        <router-link
                            to="/student/RiwayatAnalisis"
                            @click="mobileOpen = false"
                            class="block px-3 py-2.5 text-sm font-medium text-slate-600 rounded-lg hover:bg-slate-100 hover:text-slate-900 transition-colors"
                            active-class="bg-slate-100 text-slate-900 font-semibold"
                            >Riwayat Analisis</router-link
                        >
                        <router-link
                            to="/student/support"
                            @click="mobileOpen = false"
                            class="block px-3 py-2.5 text-sm font-medium text-slate-600 rounded-lg hover:bg-slate-100 hover:text-slate-900 transition-colors"
                            active-class="bg-slate-100 text-slate-900 font-semibold"
                            >Support</router-link
                        >
                    </nav>
                </transition>
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
const mobileOpen = ref(false);
const stdRef = ref(null);
const mobRef = ref(null);
const mobBtnRef = ref(null);
const lastMobileToggle = ref(0);
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

function toggleMobile() {
    const now = Date.now();
    if (now - lastMobileToggle.value < 400) return;
    lastMobileToggle.value = now;
    mobileOpen.value = !mobileOpen.value;
}

function onClickOutside(e) {
    const stdEl = stdRef.value;
    const mobEl = mobRef.value;
    if (stdEl && !stdEl.contains(e.target)) stdOpen.value = false;
    if (mobEl && !mobEl.contains(e.target)) mobileOpen.value = false;
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
/* Dropdown Panel */
.dropdown-panel {
    transform-origin: top right;
}

.dropdown-enter-active,
.dropdown-leave-active {
    transition:
        transform 0.18s cubic-bezier(0.16, 1, 0.3, 1),
        opacity 0.16s ease;
}
.dropdown-enter-from,
.dropdown-leave-to {
    opacity: 0;
    transform: translateY(6px) scale(0.98);
}

/* Mobile nav panel */
.mobile-nav-enter-active,
.mobile-nav-leave-active {
    transition:
        transform 0.2s cubic-bezier(0.16, 1, 0.3, 1),
        opacity 0.18s ease;
}
.mobile-nav-enter-from,
.mobile-nav-leave-to {
    opacity: 0;
    transform: translateY(-6px);
}

@media (prefers-reduced-motion: reduce) {
    .dropdown-enter-active,
    .dropdown-leave-active,
    .mobile-nav-enter-active,
    .mobile-nav-leave-active {
        transition: none;
    }
    .dropdown-enter-from,
    .dropdown-leave-to,
    .mobile-nav-enter-from,
    .mobile-nav-leave-to {
        transform: none;
        opacity: 0;
    }
}
</style>
