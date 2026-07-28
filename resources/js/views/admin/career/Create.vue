<template>
    <div class="space-y-6">
        <div
            class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)] sm:flex-row sm:items-center sm:justify-between"
        >
            <div>
                <p class="text-sm font-medium text-blue-600">Data Management</p>
                <h2 class="mt-1 text-2xl font-semibold text-slate-900">
                    Add New Career
                </h2>
                <p class="mt-2 text-sm text-slate-500">
                    Isi formulir untuk menambahkan karier baru dengan tampilan
                    yang lebih rapi.
                </p>
            </div>
            <button
                @click="router.go(-1)"
                class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
            >
                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                    ></path>
                </svg>
                Back
            </button>
        </div>

        <div
            class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]"
        >
            <form @submit.prevent="handleSubmit" class="space-y-5">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700"
                        >Career Title</label
                    >
                    <input
                        type="text"
                        v-model="career.title"
                        placeholder="Enter career title"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    />
                    <p v-if="errors.title" class="mt-1 text-sm text-red-500">
                        {{ errors.title[0] }}
                    </p>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700"
                        >Description</label
                    >
                    <textarea
                        v-model="career.description"
                        placeholder="Enter career description"
                        rows="4"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    ></textarea>
                    <p
                        v-if="errors.description"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ errors.description[0] }}
                    </p>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button
                        type="button"
                        @click="router.go(-1)"
                        class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:from-blue-700 hover:to-cyan-600"
                    >
                        {{ loading ? "Saving..." : "Save" }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useCareerStore } from "@/stores/useCareerStore";

const router = useRouter();
const careerStore = useCareerStore();

const career = ref({
    title: "",
    description: "",
});

const loading = ref(false);
const errors = ref({});

const handleSubmit = async () => {
    loading.value = true;
    errors.value = {};

    try {
        await careerStore.createCareer(career.value);
        router.push("/admin/career");
    } catch (error) {
        if (error.response?.status === 422) {
            errors.value = error.response.data.errors;
        }
        console.error(error);
    } finally {
        loading.value = false;
    }
};
</script>
