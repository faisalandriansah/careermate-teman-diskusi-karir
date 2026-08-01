<template>
    <div
        class="flex h-full flex-col rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6"
    >
        <div class="mb-4 flex items-center gap-2.5">
            <div
                class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-600/10 text-blue-600"
            >
                <svg
                    class="h-4.5 w-4.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-slate-900">
                    Select Career
                </h2>
                <p class="text-xs text-slate-500">Pilih career target</p>
            </div>
        </div>

        <div
            v-if="loading"
            class="h-11 w-full animate-pulse rounded-xl bg-slate-100"
        ></div>

        <!-- Custom dropdown -->
        <div v-else ref="dropdownRef" class="relative">
            <button
                type="button"
                @click="toggleOpen"
                class="flex w-full items-center justify-between rounded-xl border bg-white px-4 py-2.5 text-left text-sm transition focus:outline-none focus:ring-4 focus:ring-blue-500/10"
                :class="
                    open
                        ? 'border-blue-500 ring-4 ring-blue-500/10'
                        : 'border-slate-300 hover:border-slate-400'
                "
            >
                <span
                    :class="activeCareer ? 'text-slate-800' : 'text-slate-400'"
                >
                    {{ activeCareer ? activeCareer.title : "Choose a career" }}
                </span>
                <svg
                    class="h-4 w-4 shrink-0 text-slate-400 transition-transform duration-150"
                    :class="open ? 'rotate-180' : ''"
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
                    v-if="open"
                    class="absolute z-30 mt-2 w-full origin-top rounded-xl border border-slate-200 bg-white shadow-lg shadow-slate-900/10"
                    :class="openUpward ? 'bottom-full mb-2 origin-bottom' : ''"
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
                                ref="searchInput"
                                v-model="query"
                                type="text"
                                placeholder="Cari career..."
                                class="w-full bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400"
                                @keydown.esc="closeDropdown"
                            />
                        </div>
                    </div>

                    <!-- Options -->
                    <ul class="max-h-64 overflow-y-auto p-1.5" role="listbox">
                        <li>
                            <button
                                type="button"
                                @click="choose('')"
                                class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-left text-sm transition"
                                :class="
                                    selectedCareer === ''
                                        ? 'bg-blue-50 font-medium text-blue-700'
                                        : 'text-slate-400 hover:bg-slate-50'
                                "
                            >
                                Choose a career
                                <svg
                                    v-if="selectedCareer === ''"
                                    class="h-4 w-4 text-blue-600"
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
                        <li v-for="career in filteredCareers" :key="career.id">
                            <button
                                type="button"
                                @click="choose(career.id)"
                                class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-left text-sm transition"
                                :class="
                                    selectedCareer === career.id
                                        ? 'bg-blue-50 font-medium text-blue-700'
                                        : 'text-slate-700 hover:bg-slate-50'
                                "
                            >
                                {{ career.title }}
                                <svg
                                    v-if="selectedCareer === career.id"
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

        <div v-if="activeCareer" class="mt-5 flex flex-1 flex-col">
            <div
                class="rounded-xl border border-blue-100 bg-gradient-to-br from-blue-50 to-blue-50/40 p-4"
            >
                <div class="flex items-center gap-2">
                    <svg
                        class="h-4 w-4 shrink-0 text-blue-600"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    <h3 class="text-sm font-semibold text-blue-900">
                        {{ activeCareer.title }}
                    </h3>
                </div>
                <p
                    v-if="activeCareer.description"
                    class="mt-2 text-xs leading-relaxed text-blue-700/90"
                >
                    {{ activeCareer.description }}
                </p>
            </div>

            <div class="mt-4 grid grid-cols-2 gap-3">
                <div
                    class="rounded-xl border border-slate-200 bg-slate-50 p-3.5 text-center"
                >
                    <p class="text-lg font-bold text-slate-900">
                        {{ requiredSkillsCount }}
                    </p>
                    <p
                        class="mt-0.5 text-[11px] font-medium uppercase tracking-wide text-slate-500"
                    >
                        Required Skills
                    </p>
                </div>
                <div
                    class="rounded-xl border border-slate-200 bg-slate-50 p-3.5 text-center"
                >
                    <p class="text-lg font-bold text-slate-900">
                        {{ averageWeight }}
                    </p>
                    <p
                        class="mt-0.5 text-[11px] font-medium uppercase tracking-wide text-slate-500"
                    >
                        Average Weight
                    </p>
                </div>
            </div>
        </div>

        <div
            v-else
            class="mt-5 flex flex-1 flex-col items-center justify-center rounded-xl border border-dashed border-slate-200 bg-slate-50/50 px-4 py-10 text-center"
        >
            <div
                class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400"
            >
                <svg
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
            </div>
            <p class="text-sm font-medium text-slate-500">
                Pilih career untuk mulai melakukan skill mapping
            </p>
        </div>
    </div>
</template>

<script setup>
import { computed, ref, nextTick, onMounted, onBeforeUnmount } from "vue";

const props = defineProps({
    careers: { type: Array, required: true },
    selectedCareer: { type: [String, Number], default: "" },
    skills: { type: Array, default: () => [] },
    loading: { type: Boolean, default: false },
});

const emit = defineEmits(["select"]);

const open = ref(false);
const openUpward = ref(false);
const query = ref("");
const dropdownRef = ref(null);
const searchInput = ref(null);

const filteredCareers = computed(() => {
    if (!query.value.trim()) return props.careers;
    const q = query.value.toLowerCase();
    return props.careers.filter((c) => c.title.toLowerCase().includes(q));
});

async function toggleOpen() {
    open.value = !open.value;
    if (open.value) {
        query.value = "";
        await nextTick();
        decideDirection();
        searchInput.value?.focus();
    }
}

function decideDirection() {
    const el = dropdownRef.value;
    if (!el) return;
    const rect = el.getBoundingClientRect();
    const spaceBelow = window.innerHeight - rect.bottom;
    openUpward.value = spaceBelow < 320 && rect.top > 320;
}

function choose(id) {
    emit("select", id === "" ? "" : Number(id));
    closeDropdown();
}

function closeDropdown() {
    open.value = false;
}

function handleClickOutside(e) {
    if (dropdownRef.value && !dropdownRef.value.contains(e.target)) {
        closeDropdown();
    }
}

onMounted(() => document.addEventListener("click", handleClickOutside));
onBeforeUnmount(() =>
    document.removeEventListener("click", handleClickOutside),
);

const activeCareer = computed(() =>
    props.careers.find((c) => c.id === props.selectedCareer),
);

const checkedSkills = computed(() => props.skills.filter((s) => s.checked));
const requiredSkillsCount = computed(() => checkedSkills.value.length);

const averageWeight = computed(() => {
    if (checkedSkills.value.length === 0) return "0.0";
    const total = checkedSkills.value.reduce(
        (sum, s) => sum + Number(s.weight || 0),
        0,
    );
    return (total / checkedSkills.value.length).toFixed(1);
});
</script>
