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
                <!-- Career (custom dropdown) -->
                <div>
                    <label
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Career
                    </label>

                    <div ref="careerDropdownRef" class="relative">
                        <button
                            type="button"
                            @click="toggleCareerOpen"
                            class="flex w-full items-center justify-between rounded-xl border bg-white px-4 py-2.5 text-left text-sm transition focus:outline-none focus:ring-4 focus:ring-blue-500/10"
                            :class="
                                careerOpen
                                    ? 'border-blue-500 ring-4 ring-blue-500/10'
                                    : 'border-slate-200 hover:border-slate-400'
                            "
                        >
                            <span
                                :class="
                                    selectedCareerTitle
                                        ? 'text-slate-700'
                                        : 'text-slate-400'
                                "
                            >
                                {{ selectedCareerTitle || "Select Career" }}
                            </span>
                            <svg
                                class="h-4 w-4 shrink-0 text-slate-400 transition-transform duration-150"
                                :class="careerOpen ? 'rotate-180' : ''"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </button>

                        <Transition
                            enter-active-class="transition duration-100 ease-out"
                            enter-from-class="opacity-0 scale-95"
                            enter-to-class="opacity-100 scale-100"
                            leave-active-class="transition duration-75 ease-in"
                            leave-from-class="opacity-100 scale-100"
                            leave-to-class="opacity-0 scale-95"
                        >
                            <div
                                v-if="careerOpen"
                                class="absolute z-30 mt-2 w-full origin-top rounded-xl border border-slate-200 bg-white shadow-lg shadow-slate-900/10"
                            >
                                <!-- Search -->
                                <div
                                    v-if="careers.length > 6"
                                    class="border-b border-slate-100 p-2"
                                >
                                    <div
                                        class="flex items-center gap-2 rounded-lg bg-slate-50 px-3 py-2"
                                    >
                                        <svg
                                            class="h-4 w-4 shrink-0 text-slate-400"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"
                                            />
                                        </svg>
                                        <input
                                            ref="careerSearchInput"
                                            v-model="careerQuery"
                                            type="text"
                                            placeholder="Cari career..."
                                            class="w-full bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400"
                                            @keydown.esc="closeCareerDropdown"
                                        />
                                    </div>
                                </div>

                                <!-- Options -->
                                <ul
                                    class="max-h-64 overflow-y-auto p-1.5"
                                    role="listbox"
                                >
                                    <li
                                        v-for="career in filteredCareers"
                                        :key="career.id"
                                    >
                                        <button
                                            type="button"
                                            @click="chooseCareer(career.id)"
                                            class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-left text-sm transition"
                                            :class="
                                                internship.career_id ===
                                                career.id
                                                    ? 'bg-blue-50 font-medium text-blue-700'
                                                    : 'text-slate-700 hover:bg-slate-50'
                                            "
                                        >
                                            {{ career.title }}
                                            <svg
                                                v-if="
                                                    internship.career_id ===
                                                    career.id
                                                "
                                                class="h-4 w-4 shrink-0 text-blue-600"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M5 13l4 4L19 7"
                                                />
                                            </svg>
                                        </button>
                                    </li>
                                    <li
                                        v-if="filteredCareers.length === 0"
                                        class="px-3 py-6 text-center text-sm text-slate-400"
                                    >
                                        Career tidak ditemukan
                                    </li>
                                </ul>
                            </div>
                        </Transition>
                    </div>

                    <p
                        v-if="errors.career_id"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ errors.career_id[0] }}
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
                    <p
                        v-if="errors.company_name"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ errors.company_name[0] }}
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
                    <p v-if="errors.position" class="mt-1 text-sm text-red-500">
                        {{ errors.position[0] }}
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
                    <p v-if="errors.location" class="mt-1 text-sm text-red-500">
                        {{ errors.location[0] }}
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
                    <p
                        v-if="errors.application_url"
                        class="mt-1 text-sm text-red-500"
                    >
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
import { ref, computed, nextTick, onMounted, onBeforeUnmount } from "vue";
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

/* ---------- Career dropdown state ---------- */
const careerOpen = ref(false);
const careerQuery = ref("");
const careerDropdownRef = ref(null);
const careerSearchInput = ref(null);

const filteredCareers = computed(() => {
    if (!careerQuery.value.trim()) return careers.value;
    const q = careerQuery.value.toLowerCase();
    return careers.value.filter((c) => c.title.toLowerCase().includes(q));
});

const selectedCareerTitle = computed(() => {
    const found = careers.value.find(
        (c) => c.id === internship.value.career_id,
    );
    return found ? found.title : "";
});

async function toggleCareerOpen() {
    careerOpen.value = !careerOpen.value;
    if (careerOpen.value) {
        careerQuery.value = "";
        await nextTick();
        careerSearchInput.value?.focus();
    }
}

function chooseCareer(id) {
    internship.value.career_id = id;
    closeCareerDropdown();
}

function closeCareerDropdown() {
    careerOpen.value = false;
}

function handleClickOutsideCareer(e) {
    if (
        careerDropdownRef.value &&
        !careerDropdownRef.value.contains(e.target)
    ) {
        closeCareerDropdown();
    }
}
/* ---------- end dropdown state ---------- */

onMounted(async () => {
    const response = await getCareers();
    careers.value = response.data.data;
    document.addEventListener("click", handleClickOutsideCareer);
});

onBeforeUnmount(() => {
    document.removeEventListener("click", handleClickOutsideCareer);
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
