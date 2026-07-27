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
            <div class="relative z-10 text-center px-10">
                <div class="flex items-center justify-center gap-3 mb-6">
                    <div
                        class="w-12 h-12 rounded-xl bg-white flex items-center justify-center"
                    >
                        <svg
                            class="w-6 h-6 text-indigo-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 3v18m6-13v13M5 13v8"
                            />
                        </svg>
                    </div>
                    <span class="text-4xl font-bold text-white"
                        >CareerMateAI</span
                    >
                </div>
                <p class="text-indigo-100 max-w-sm mx-auto">
                    Free and Open-Source Career Recommendation Platform
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref } from "vue";
import { useRouter } from "vue-router";
import apiClient from "@/services/api";
import { useAuthStore } from '@/stores/auth'

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
            errorMessage.value = object.values(err.response.data.errors)[0][0];
        } else {
            errorMessage.value =
                err.response?.data?.message ?? "Gagal membuat akun";
        }
    } finally {
        loading.value = false;
    }
}
</script>
