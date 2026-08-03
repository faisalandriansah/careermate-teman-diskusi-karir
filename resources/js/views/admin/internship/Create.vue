<template>
    <div class="space-y-6">
        <div
            class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)] sm:flex-row sm:items-center sm:justify-between"
        >
            <div>
                <p class="text-sm font-medium text-blue-600">Data Management</p>
                <h2 class="mt-1 text-2xl font-semibold text-slate-900">
                    Add New Internship
                </h2>
                <p class="mt-2 text-sm text-slate-500">
                    Isi formulir untuk menambahkan magang baru dengan tampilan
                    yang lebih simpel.
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
                    <label class="mb-2 block text-sm font-medium">
                        Career
                    </label>

                    <select
                        v-model="internship.career_id"
                        class="w-full rounded-xl border p-3"
                    >
                        <option value="">Select Career</option>

                        <option
                            v-for="career in careers"
                            :key="career.id"
                            :value="career.id"
                        >
                            {{ career.title }}
                        </option>
                    </select>
                    <p v-if="errors.name" class="mt-1 text-sm text-red-500">
                        {{ errors.name[0] }}
                    </p>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700"
                        >Company Name</label
                    >
                    <input
                        type="text"
                        v-model="internship.company_name"
                        placeholder="Enter Company Name"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    />
                    <p v-if="errors.name" class="mt-1 text-sm text-red-500">
                        {{ errors.name[0] }}
                    </p>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700"
                        >Position</label
                    >
                    <input
                        type="text"
                        v-model="internship.position"
                        placeholder="Enter Position title"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    />
                    <p v-if="errors.name" class="mt-1 text-sm text-red-500">
                        {{ errors.name[0] }}
                    </p>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700"
                        >Location</label
                    >
                    <input
                        type="text"
                        v-model="internship.location"
                        placeholder="Enter location"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    />
                    <p v-if="errors.name" class="mt-1 text-sm text-red-500">
                        {{ errors.name[0] }}
                    </p>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700"
                        >Application Url</label
                    >
                    <input
                        type="url"
                        v-model="internship.application_url"
                        placeholder="Enter application url"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    />
                    <p v-if="errors.application_url" class="mt-1 text-sm text-red-500">
                        {{ errors.application_url[0] }}
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
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import { useInternshipStore } from "@/stores/useInternshipStore";
import { getCareers } from "@/services/careerService";
import { notify } from "@/utils/toast";

const router = useRouter();
const internshipStore = useInternshipStore();

const internship = ref({
    career_id: "",
    company_name: "",
    position: "",
    location: "",
    application_url: "",
});

const careers = ref([]);
const loading = ref(false);
const errors = ref({});

onMounted(async () => {
    const response = await getCareers();
    careers.value = response.data.data;
});

const handleSubmit = async () => {
    loading.value = true;
    errors.value = {};

    try {
        await internshipStore.createInternship(internship.value);
        notify.success("Magang berhasil ditambahkan.");
        router.push("/admin/internship");
    } catch (error) {
        if (error.response?.status === 422) {
            errors.value = error.response.data.errors;
            notify.warning("Periksa kembali data yang kamu isi.");
        } else {
            notify.error("Gagal menambahkan magang, coba lagi.");
        }
        console.error(error);
    } finally {
        loading.value = false;
    }
};
</script>
