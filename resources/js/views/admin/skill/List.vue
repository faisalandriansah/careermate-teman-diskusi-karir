<template>
    <div class="space-y-6">
        <div
            class="flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)] sm:flex-row sm:items-center sm:justify-between"
        >
            <div class="flex items-center gap-4">
                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-600/10 text-blue-600"
                >
                    <svg
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-slate-900">
                        Skills Management
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Kelola daftar skill yang tersedia untuk sistem
                        rekomendasi.
                    </p>
                </div>
            </div>
            <button
                @click="$router.push('/admin/skill/create')"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
            >
                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    />
                </svg>
                Add New Skill
            </button>
        </div>

        <div
            class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]"
        >
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-slate-900">
                    List of Skills
                </h3>
                <span
                    class="rounded-full bg-slate-100 px-3 py-1 text-sm text-slate-600"
                    >{{ pagination.total }} items</span
                >
            </div>

            <div v-if="loading" class="py-10 text-center text-slate-500">
                Loading...
            </div>

            <div v-else class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                <div
                    v-for="skill in skills"
                    :key="skill.id"
                    class="rounded-2xl border border-slate-200 bg-slate-50 p-5"
                >
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <h4 class="font-semibold text-slate-900">
                                {{ skill.name }}
                            </h4>
                            <p class="mt-1 text-sm text-slate-500">
                                {{ skill.description }}
                            </p>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="rounded-full p-2 text-blue-600 transition hover:bg-blue-100"
                                @click="
                                    $router.push(
                                        `/admin/skill/${skill.id}/edit`,
                                    )
                                "
                            >
                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                    />
                                </svg>
                            </button>
                            <button
                                @click="removeSkill(skill.id)"
                                class="rounded-full p-2 text-rose-600 transition hover:bg-rose-100"
                            >
                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        class="mt-6 flex items-center justify-between"
        v-if="pagination.last_page > 1"
    >
        <button
            class="rounded-lg border px-4 py-2 disabled:opacity-50"
            :disabled="pagination.current_page === 1"
            @click="loadSkills(pagination.current_page - 1)"
        >
            Previous
        </button>

        <div class="flex gap-2">
            <button
                v-for="page in pagination.last_page"
                :key="page"
                @click="loadSkills(page)"
                class="rounded-lg px-4 py-2"
                :class="
                    page === pagination.current_page
                        ? 'bg-blue-600 text-white'
                        : 'border'
                "
            >
                {{ page }}
            </button>
        </div>

        <button
            class="rounded-lg border px-4 py-2 disabled:opacity-50"
            :disabled="pagination.current_page === pagination.last_page"
            @click="loadSkills(pagination.current_page + 1)"
        >
            Next
        </button>
    </div>
    <ConfirmModal
        v-model="showConfirm"
        title="Hapus Skill Ini?"
        description="Skill yang sudah dihapus tidak bisa dikembalikan lagi."
        @cancel="showConfirm = false"
        @confirm="confirmDelete"
    />
</template>

<script setup>
import { ref, onMounted } from "vue";
import { getSkills, deleteSkill } from "@/services/skillService";
import ConfirmModal from "@/components/ConfirmModal.vue";

const skills = ref([]);
const loading = ref(false);
const showConfirm = ref(false);
const selectedId = ref(null);

const pagination = ref({
    current_page: 1,
    last_page: 1,
    total: 0,
});

async function loadSkills(page = 1) {
    loading.value = true;

    try {
        const response = await getSkills(page);

        skills.value = response.data.data;

        pagination.value = {
            current_page: response.data.current_page,
            last_page: response.data.last_page,
            total: response.data.total,
        };
    } finally {
        loading.value = false;
    }
}

onMounted(() => {
    loadSkills();
});

function removeSkill(id) {
    selectedId.value = id;
    showConfirm.value = true; // munculin modal
}

async function confirmDelete() {
    await deleteSkill(selectedId.value);
    showConfirm.value = false;
    loadSkills(); // refresh list
}
</script>
