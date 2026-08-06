<template>
    <div
        class="min-h-screen flex items-center justify-center bg-slate-100 p-4 sm:p-6 lg:p-8 selection:bg-indigo-500 selection:text-white"
    >
        <!-- Outer Card Wrapper -->
        <div
            class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl shadow-indigo-100/50 border border-slate-100 overflow-hidden flex flex-col lg:flex-row min-h-[620px] relative"
        >
            <!-- LEFT PANEL: BRANDING & VALUE PROP (Desktop Only) -->
            <div
                class="hidden lg:flex lg:w-1/2 relative p-8 sm:p-12 flex-col justify-between overflow-hidden bg-indigo-600"
            >
                <!-- Animated Gradient Mesh Background -->
                <div class="absolute inset-0 gradient-mesh"></div>

                <!-- Floating Orbs Background Visual -->
                <div
                    class="absolute -top-12 -right-12 w-80 h-80 bg-white/10 rounded-full blur-3xl orb-float-1 pointer-events-none"
                ></div>
                <div
                    class="absolute bottom-0 -left-12 w-80 h-80 bg-indigo-400/20 rounded-full blur-3xl orb-float-2 pointer-events-none"
                ></div>

                <!-- Left Brand Logo Header -->
                <div class="relative z-10 flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-white/15 backdrop-blur-md flex items-center justify-center p-2 shadow-inner border border-white/20"
                    >
                        <img
                            :src="logo"
                            alt="CareerMateAI logo"
                            class="w-full h-full object-contain brightness-0 invert"
                        />
                    </div>
                    <span class="text-lg font-bold text-white tracking-tight"
                        >CareerMateAI</span
                    >
                </div>

                <!-- Brand Headline Text -->
                <div class="relative z-10 my-auto py-12">
                    <p
                        class="text-indigo-100 text-sm font-medium tracking-wide mb-3"
                    >
                        Mulai perjalanan kariermu
                    </p>
                    <h1
                        class="text-3xl sm:text-4xl font-bold text-white leading-tight tracking-tight"
                    >
                        Analisis skill, rekomendasi karier, dan roadmap belajar
                        dalam satu platform
                    </h1>
                </div>

                <!-- Hidden spacer to balance flex box -->
                <div class="relative z-10"></div>
            </div>

            <!-- RIGHT PANEL: REGISTER FORM -->
            <div
                class="w-full lg:w-1/2 p-6 sm:p-10 lg:p-12 flex flex-col justify-center bg-white relative"
            >
                <!-- LOGO BRANDING (Pojok Kanan Atas Form - Tampil & Rapi di Semua Ukuran Layar) -->
                <div
                    class="absolute top-6 right-6 sm:top-8 sm:right-8 flex items-center gap-2.5 z-20"
                >
                    <span
                        class="hidden sm:inline-block text-xs font-semibold text-slate-400 tracking-tight"
                        >CareerMateAI</span
                    >
                    <div
                        class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-indigo-50 border border-indigo-100/80 flex items-center justify-center p-2 shadow-sm hover:scale-105 transition-transform"
                    >
                        <img
                            :src="logo"
                            alt="CareerMateAI logo"
                            class="w-full h-full object-contain"
                        />
                    </div>
                </div>

                <div class="max-w-md w-full mx-auto pt-8 sm:pt-4">
                    <!-- Form Title & Subtitle -->
                    <div class="mb-8">
                        <h2
                            class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-2"
                        >
                            Buat akun baru
                        </h2>
                        <p
                            class="text-xs sm:text-sm text-slate-500 leading-relaxed"
                        >
                            Daftar untuk mengakses roadmap karier, analisis
                            skill, dan rekomendasi yang dipersonalisasi untukmu.
                        </p>
                    </div>

                    <!-- Form Fields -->
                    <form @submit.prevent="handleSubmit" class="space-y-4">
                        <!-- Nama Lengkap -->
                        <div>
                            <label
                                for="name"
                                class="block text-xs font-semibold text-slate-700 mb-1.5"
                            >
                                Nama lengkap
                            </label>
                            <input
                                id="name"
                                v-model="form.name"
                                type="text"
                                required
                                autocomplete="name"
                                placeholder="John Doe"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50/30 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 outline-none transition duration-200 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                            />
                        </div>

                        <!-- Email Input -->
                        <div>
                            <label
                                for="email"
                                class="block text-xs font-semibold text-slate-700 mb-1.5"
                            >
                                Alamat email
                            </label>
                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
                                required
                                autocomplete="username"
                                placeholder="nama@perusahaan.com"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50/30 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 outline-none transition duration-200 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                            />
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label
                                for="password"
                                class="block text-xs font-semibold text-slate-700 mb-1.5"
                            >
                                Kata sandi
                            </label>
                            <div class="relative">
                                <input
                                    id="password"
                                    v-model="form.password"
                                    :type="showPassword ? 'text' : 'password'"
                                    required
                                    autocomplete="new-password"
                                    placeholder="••••••••••••"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50/30 px-4 py-3 pr-11 text-sm text-slate-900 placeholder-slate-400 outline-none transition duration-200 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                                />
                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition p-1"
                                    aria-label="Tampilkan atau sembunyikan kata sandi"
                                >
                                    <svg
                                        v-if="!showPassword"
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                        />
                                    </svg>
                                    <svg
                                        v-else
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div>
                            <label
                                for="password_confirmation"
                                class="block text-xs font-semibold text-slate-700 mb-1.5"
                            >
                                Konfirmasi kata sandi
                            </label>
                            <div class="relative">
                                <input
                                    id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    :type="
                                        showConfirmPassword
                                            ? 'text'
                                            : 'password'
                                    "
                                    required
                                    autocomplete="new-password"
                                    placeholder="••••••••••••"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50/30 px-4 py-3 pr-11 text-sm text-slate-900 placeholder-slate-400 outline-none transition duration-200 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                                />
                                <button
                                    type="button"
                                    @click="
                                        showConfirmPassword =
                                            !showConfirmPassword
                                    "
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition p-1"
                                    aria-label="Tampilkan atau sembunyikan konfirmasi kata sandi"
                                >
                                    <svg
                                        v-if="!showConfirmPassword"
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                        />
                                    </svg>
                                    <svg
                                        v-else
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Error Message Alert -->
                        <div
                            v-if="errorMessage"
                            role="alert"
                            aria-live="assertive"
                            class="p-3.5 rounded-xl bg-red-50 border border-red-100 flex items-center gap-2.5 text-xs text-red-600 font-medium"
                        >
                            <svg
                                class="w-4 h-4 flex-shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                            <span>{{ errorMessage }}</span>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            :disabled="loading"
                            class="w-full rounded-xl bg-indigo-600 hover:bg-indigo-700 active:scale-[0.99] transition-all duration-200 py-3.5 px-4 text-sm font-semibold text-white shadow-lg shadow-indigo-600/30 disabled:opacity-60 disabled:cursor-not-allowed flex items-center justify-center gap-2 mt-2"
                        >
                            <svg
                                v-if="loading"
                                class="animate-spin h-4 w-4 text-white"
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
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                ></path>
                            </svg>
                            <span>{{
                                loading ? "Membuat akun..." : "Buat Akun"
                            }}</span>
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="flex items-center gap-4 my-6">
                        <div class="flex-1 h-px bg-slate-200"></div>
                        <span class="text-xs text-slate-400 font-normal"
                            >atau daftar dengan</span
                        >
                        <div class="flex-1 h-px bg-slate-200"></div>
                    </div>

                    <!-- Social Login Buttons Container -->
                    <div class="grid grid-cols-2 gap-3 mb-6">
                        <button
                            type="button"
                            @click="signUpWithGoogle"
                            class="flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl border border-slate-200 bg-slate-50/60 hover:bg-slate-100 text-slate-700 font-medium text-xs transition"
                        >
                            <svg
                                class="w-4 h-4 flex-shrink-0"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    fill="#4285F4"
                                    d="M23.52 12.27c0-.84-.07-1.46-.22-2.1H12v3.81h6.6c-.13 1.05-.85 2.63-2.45 3.7l-.02.15 3.56 2.76.25.02c2.27-2.1 3.58-5.18 3.58-8.34"
                                />
                                <path
                                    fill="#34A853"
                                    d="M12 24c3.24 0 5.95-1.07 7.93-2.91l-3.78-2.93c-1.02.71-2.4 1.21-4.15 1.21-3.17 0-5.86-2.1-6.82-5H1.28v3.03C3.25 21.3 7.31 24 12 24"
                                />
                                <path
                                    fill="#FBBC05"
                                    d="M5.18 14.37A7.2 7.2 0 0 1 4.8 12c0-.82.14-1.63.37-2.37V6.6H1.28A11.98 11.98 0 0 0 0 12c0 1.94.47 3.78 1.28 5.4z"
                                />
                                <path
                                    fill="#EA4335"
                                    d="M12 4.77c2.25 0 3.77.97 4.64 1.78l3.39-3.31C17.94 1.19 15.24 0 12 0 7.31 0 3.25 2.7 1.28 6.6l3.9 3.03c.95-2.9 3.65-4.86 6.82-4.86"
                                />
                            </svg>
                            <span>Google</span>
                        </button>

                        <button
                            type="button"
                            @click="signUpWithX"
                            class="flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl border border-slate-200 bg-slate-50/60 hover:bg-slate-100 text-slate-700 font-medium text-xs transition"
                        >
                            <svg
                                class="w-3.5 h-3.5 fill-current text-slate-900 flex-shrink-0"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M18.9 1.6h3.7l-8 9.15L24 22.4h-7.4l-5.8-7.6-6.6 7.6H.5l8.6-9.85L0 1.6h7.6l5.25 6.95zm-1.3 18.6h2L6.5 3.7h-2.1z"
                                />
                            </svg>
                            <span>Twitter / X</span>
                        </button>
                    </div>

                    <!-- Login Link -->
                    <p class="text-center text-xs text-slate-500">
                        Sudah punya akun?
                        <router-link
                            to="/login"
                            class="font-semibold text-indigo-600 hover:text-indigo-700 transition"
                        >
                            Masuk sekarang
                        </router-link>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref } from "vue";
import { useRouter } from "vue-router";
import apiClient from "@/services/api";
import { useAuthStore } from "@/stores/auth";
import logo from "@/assets/logo.png";

const router = useRouter();
const authStore = useAuthStore();

const form = reactive({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const showPassword = ref(false);
const showConfirmPassword = ref(false);
const loading = ref(false);
const errorMessage = ref("");

function signUpWithGoogle() {
    // TODO: integrasi Google OAuth
}

function signUpWithX() {
    // TODO: integrasi X OAuth
}

async function handleSubmit() {
    if (form.password !== form.password_confirmation) {
        errorMessage.value = "Konfirmasi kata sandi tidak cocok.";
        return;
    }

    loading.value = true;
    errorMessage.value = "";

    try {
        const res = await apiClient.post("/auth/register", form);
        const { token, user } = res.data;
        authStore.login(token, user);
        router.push("/student/dashboard");
    } catch (err) {
        if (err.response?.data?.errors) {
            errorMessage.value = Object.values(err.response.data.errors)[0][0];
        } else {
            errorMessage.value =
                err.response?.data?.message ?? "Gagal membuat akun.";
        }
    } finally {
        loading.value = false;
    }
}
</script>

<style scoped>
.gradient-mesh {
    background: linear-gradient(
        135deg,
        #3b82f6 0%,
        #6366f1 35%,
        #8b5cf6 70%,
        #d8b4fe 100%
    );
    background-size: 200% 200%;
    animation: meshMove 12s ease-in-out infinite alternate;
}

@keyframes meshMove {
    0% {
        background-position: 0% 0%;
    }
    100% {
        background-position: 100% 100%;
    }
}

.orb-float-1 {
    animation: floatSlow 10s ease-in-out infinite alternate;
}
.orb-float-2 {
    animation: floatSlow 14s ease-in-out infinite alternate-reverse;
}

@keyframes floatSlow {
    0% {
        transform: translate(0, 0) scale(1);
    }
    100% {
        transform: translate(30px, -20px) scale(1.1);
    }
}
</style>
