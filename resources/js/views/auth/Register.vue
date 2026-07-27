<template>
    <div class="min-h-screen flex bg-white">
        <div
            class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 lg:px-24 py-10 relative"
        >
            <div class="max-w-md w-full mx-auto lg:mx-0">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Sign Up</h1>
                <p class="text-gray-500 mb-6">
                    Create your account and start using CareerMateAI
                </p>

                <form @submit.prevent="handleSubmit" class="space-y-5">
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-1.5"
                            >Full name<span class="text-red-500">*</span></label
                        >
                        <input
                            v-model="form.name"
                            type="text"
                            required
                            placeholder="John Doe"
                            class="w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800"
                        />
                    </div>

                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-1.5"
                            >Email<span class="text-red-500">*</span></label
                        >
                        <input
                            v-model="form.email"
                            type="email"
                            required
                            placeholder="you@example.com"
                            class="w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800"
                        />
                    </div>

                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-1.5"
                            >Password<span class="text-red-500">*</span></label
                        >
                        <input
                            v-model="form.password"
                            type="password"
                            required
                            placeholder="Enter a password"
                            class="w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800"
                        />
                    </div>

                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-1.5"
                            >Confirm Password<span class="text-red-500"
                                >*</span
                            ></label
                        >
                        <input
                            v-model="form.password_confirmation"
                            type="password"
                            required
                            placeholder="Confirm password"
                            class="w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800"
                        />
                    </div>

                    <button
                        :disabled="loading"
                        type="submit"
                        class="w-full rounded-lg bg-indigo-600 hover:bg-indigo-700 transition py-3 text-sm font-semibold text-white disabled:opacity-60"
                    >
                        {{ loading ? "Creating..." : "Create account" }}
                    </button>
                </form>

                <p v-if="errorMessage" class="mt-4 text-sm text-red-500">
                    {{ errorMessage }}
                </p>

                <p class="mt-6 text-sm text-gray-500">
                    Already have an account?
                    <router-link
                        to="/login"
                        class="font-medium text-indigo-600 hover:text-indigo-700"
                        >Sign in</router-link
                    >
                </p>
            </div>
        </div>

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

            <!-- Decorative floating squares -->
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

const authStore = useAuthStore();
const router = useRouter();

const form = reactive({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const loading = ref(false);
const errorMessage = ref("");

async function handleSubmit() {
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
                err.response?.data?.message ?? "Gagal membuat akun";
        }
    } finally {
        loading.value = false;
    }
}
</script>
<style scoped>
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

.icon-float {
    animation: iconFloat 4s ease-in-out infinite;
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
