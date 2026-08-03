<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Simple header for student layout -->
        <header class="bg-white shadow">
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

                        <div ref="stdRef" class="relative">
                            <button
                                @click="stdOpen = !stdOpen"
                                class="flex items-center gap-3 rounded-full border border-slate-200 bg-white px-3 py-1.5 shadow-sm hover:shadow-md transition-all duration-150"
                            >
                                <div
                                    class="h-8 w-8 rounded-full bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center text-white font-semibold"
                                >
                                    {{ shortInitial }}
                                </div>
                                <div class="hidden sm:block text-left">
                                    <div
                                        class="text-sm font-medium text-slate-800"
                                    >
                                        {{ displayName }}
                                    </div>
                                    <div class="text-xs text-slate-500">
                                        {{ displayRole }}
                                    </div>
                                </div>
                            </button>

                            <div
                                v-show="stdOpen"
                                class="absolute right-0 z-50 mt-2 w-56 rounded-lg border border-slate-100 bg-white py-3 shadow-lg text-slate-900"
                            >
                                <div class="px-4 pb-3">
                                    <div class="text-sm font-semibold">
                                        {{ displayName }}
                                    </div>
                                    <div class="text-xs text-slate-500">
                                        {{ displayEmail }}
                                    </div>
                                </div>
                                <hr class="my-2 border-t border-slate-100" />
                                <ul>
                                    <li>
                                        <button
                                            class="flex w-full items-center gap-3 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50"
                                            @click="gotoProfile"
                                        >
                                            Edit profile
                                        </button>
                                    </li>
                                    <li>
                                        <button
                                            class="flex w-full items-center gap-3 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50"
                                            @click="gotoSupport"
                                        >
                                            Support
                                        </button>
                                    </li>
                                </ul>
                                <hr class="my-2 border-t border-slate-100" />
                                <div class="px-3">
                                    <button
                                        @click="signOut"
                                        class="flex w-full items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50"
                                    >
                                        Sign out
                                    </button>
                                </div>
                            </div>
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
            const { data } = await apiClient.get("/auth/me");

            auth.setUser(data.data);
        } catch (e) {
            console.log("Auth me gagal", e);
        }
    }
});
onBeforeUnmount(() => {
    document.removeEventListener("click", onClickOutside);
});
</script>
