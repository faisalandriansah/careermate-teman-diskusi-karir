<template>
    <div class="min-h-screen flex bg-white">
        <!-- LEFT: FORM -->
        <div
            class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 lg:px-24 py-10 relative"
        >
            <!-- <router-link to="/dashboard" class="inline-flex items-center gap-1 text-gray-500 text-sm mb-10 hover:text-gray-700 w-fit">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to dashboard
      </router-link> -->

            <div class="max-w-md w-full mx-auto lg:mx-0">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Sign In</h1>
                <p class="text-gray-500 mb-6">
                    Enter your email and password to sign in!
                </p>

                <!-- SOCIAL BUTTONS -->
                <div class="grid grid-cols-2 gap-3 mb-6">
                    <button
                        type="button"
                        @click="loginWithGoogle"
                        class="flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-gray-50 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 transition"
                    >
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
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
                        Sign in with Google
                    </button>
                    <button
                        type="button"
                        @click="loginWithX"
                        class="flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-gray-50 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 transition"
                    >
                        <svg
                            class="w-4 h-4"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                        >
                            <path
                                d="M18.9 1.6h3.7l-8 9.15L24 22.4h-7.4l-5.8-7.6-6.6 7.6H.5l8.6-9.85L0 1.6h7.6l5.25 6.95zm-1.3 18.6h2L6.5 3.7h-2.1z"
                            />
                        </svg>
                        Sign in with X
                    </button>
                </div>

                <!-- DIVIDER -->
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-sm text-gray-400">Or</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <form @submit.prevent="handleSubmit" class="space-y-5">
                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-700 mb-1.5"
                            >Email<span class="text-red-500">*</span></label
                        >
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            required
                            placeholder="info@gmail.com"
                            class="w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                        />
                    </div>

                    <div>
                        <label
                            for="password"
                            class="block text-sm font-medium text-gray-700 mb-1.5"
                            >Password<span class="text-red-500">*</span></label
                        >
                        <div class="relative">
                            <input
                                id="password"
                                v-model="form.password"
                                :type="showPassword ? 'text' : 'password'"
                                required
                                placeholder="Enter your password"
                                class="w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                            />
                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
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
                                        d="M3 3l18 18M10.58 10.58a2 2 0 002.83 2.83M9.88 5.09A9.77 9.77 0 0112 5c4.48 0 8.27 2.94 9.54 7a10.05 10.05 0 01-4.17 5.19M6.1 6.1A10.06 10.06 0 002.46 12c1.27 4.06 5.06 7 9.54 7 1.02 0 2-.15 2.9-.42"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <label
                            class="flex items-center gap-2 text-sm text-gray-600"
                        >
                            <input
                                type="checkbox"
                                v-model="form.remember"
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                            />
                            Keep me logged in
                        </label>
                        <router-link
                            to="/forgot-password"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-700"
                            >Forgot password?</router-link
                        >
                    </div>

                    <button
                        type="submit"
                        :disabled="loading"
                        class="w-full rounded-lg bg-indigo-600 hover:bg-indigo-700 transition py-3 text-sm font-semibold text-white disabled:opacity-60"
                    >
                        {{ loading ? "Signing in..." : "Sign In" }}
                    </button>
                </form>

                <p v-if="errorMessage" class="mt-4 text-sm text-red-500">
                    {{ errorMessage }}
                </p>

                <p class="mt-6 text-sm text-gray-500">
                    Don't have an account?
                    <router-link
                        to="/register"
                        class="font-medium text-indigo-600 hover:text-indigo-700"
                        >Sign Up</router-link
                    >
                </p>
            </div>
        </div>

        <!-- RIGHT: BRAND PANEL -->
        <div
            class="hidden lg:flex w-1/2 relative items-center justify-center overflow-hidden bg-indigo-600"
        >
            <!-- Animated gradient mesh -->
            <div class="absolute inset-0 gradient-mesh"></div>

            <!-- Grid pattern (slow pan) -->
            <div
                class="absolute inset-0 opacity-10 grid-pan"
                style="
                    background-image:
                        linear-gradient(
                            to right,
                            rgba(255, 255, 255, 0.5) 1px,
                            transparent 1px
                        ),
                        linear-gradient(
                            to bottom,
                            rgba(255, 255, 255, 0.5) 1px,
                            transparent 1px
                        );
                    background-size: 60px 60px;
                "
            ></div>

            <!-- Floating blurred orbs -->
            <div
                class="absolute -top-10 -right-10 w-72 h-72 bg-white/10 rounded-full blur-3xl orb-float-1"
            ></div>
            <div
                class="absolute bottom-0 -left-16 w-80 h-80 bg-indigo-400/20 rounded-full blur-3xl orb-float-2"
            ></div>
            <div
                class="absolute top-1/3 left-1/4 w-40 h-40 bg-white/5 rounded-full blur-2xl orb-float-3"
            ></div>

            <!-- Subtle floating squares (from original, now animated) -->
            <div
                class="absolute top-24 right-40 w-16 h-16 bg-white/10 rounded square-float"
                style="animation-delay: 0s"
            ></div>
            <div
                class="absolute bottom-32 left-24 w-16 h-16 bg-white/10 rounded square-float"
                style="animation-delay: -3s"
            ></div>

            <div class="relative z-10 text-center px-10">
                <div
                    class="flex items-center justify-center gap-3 mb-6 content-fade-in"
                >
                    <div
                        class="w-16 h-16 rounded-xl bg-white flex items-center justify-center icon-float overflow-hidden"
                    >
                        <img
                            :src="logo"
                            alt="CareerMateAI logo"
                            class="w-14 h-14 object-contain"
                        />
                    </div>
                    <span class="text-4xl font-bold text-white"
                        >CareerMateAI</span
                    >
                </div>
                <p
                    class="text-indigo-100 max-w-sm mx-auto content-fade-in"
                    style="animation-delay: 0.15s"
                >
                   Analisis Skill, Rekomendasi Karier, dan Roadmap Belajar dalam Satu Platform.
                </p>
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

const form = reactive({
    email: "",
    password: "",
    remember: false,
});

const authStore = useAuthStore();

const showPassword = ref(false);
const loading = ref(false);
const errorMessage = ref("");

function loginWithGoogle() {
    // TODO: hit OAuth endpoint, misal: window.location.href = '/auth/google/redirect'
}

function loginWithX() {
    // TODO: hit OAuth endpoint, misal: window.location.href = '/auth/x/redirect'
}

async function handleSubmit() {
    loading.value = true;

    errorMessage.value = "";

    try {
        const res = await apiClient.post("/auth/login", {
            email: form.email,

            password: form.password,
        });

        const { token, user } = res.data;

        authStore.login(token, user);

        if (user.role === "admin") {
            router.push("/admin/dashboard");
        } else {
            router.push("/student/dashboard");
        }
    } catch (err) {
        errorMessage.value =
            err.response?.data?.message ?? "Email atau password salah.";
    } finally {
        loading.value = false;
    }
}
</script>
<style scoped>
/* Animated gradient mesh background */
.gradient-mesh {
    background: linear-gradient(
        130deg,
        #4f46e5 0%,
        #6366f1 25%,
        #4338ca 50%,
        #6366f1 75%,
        #4f46e5 100%
    );
    background-size: 300% 300%;
    animation: meshMove 18s ease-in-out infinite;
}

@keyframes meshMove {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

/* Grid slow pan */
.grid-pan {
    animation: gridPan 25s linear infinite;
}

@keyframes gridPan {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 60px 60px;
    }
}

/* Floating orbs, staggered speeds */
.orb-float-1 {
    animation: floatSlow 12s ease-in-out infinite;
}
.orb-float-2 {
    animation: floatSlow 16s ease-in-out infinite reverse;
}
.orb-float-3 {
    animation: floatSlow 9s ease-in-out infinite;
    animation-delay: -4s;
}

@keyframes floatSlow {
    0%,
    100% {
        transform: translate(0, 0) scale(1);
    }
    50% {
        transform: translate(20px, -30px) scale(1.08);
    }
}

/* Small decorative squares */
.square-float {
    animation: squareFloat 8s ease-in-out infinite;
}

@keyframes squareFloat {
    0%,
    100% {
        transform: translateY(0) rotate(0deg);
        opacity: 0.6;
    }
    50% {
        transform: translateY(-14px) rotate(8deg);
        opacity: 1;
    }
}

/* Icon gentle float + glow */
.icon-float {
    animation: iconFloat 4s ease-in-out infinite;
    box-shadow: 0 0 0 rgba(255, 255, 255, 0.4);
}

@keyframes iconFloat {
    0%,
    100% {
        transform: translateY(0);
        box-shadow: 0 0 0 rgba(255, 255, 255, 0);
    }
    50% {
        transform: translateY(-6px);
        box-shadow: 0 8px 20px rgba(255, 255, 255, 0.25);
    }
}

/* Content fade in on mount */
.content-fade-in {
    animation: fadeInUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) both;
}

@keyframes fadeInUp {
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
