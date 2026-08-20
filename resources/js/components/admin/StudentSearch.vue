<template>
    <div class="relative w-full">
        <svg
            class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            stroke-width="2"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M21 21l-4.35-4.35M17 10.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z"
            />
        </svg>
        <input
            type="search"
            placeholder="Cari mahasiswa berdasarkan nama, email, universitas, atau prodi..."
            aria-label="Cari mahasiswa"
            class="block w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-10 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 [&::-webkit-search-cancel-button]:hidden [&::-webkit-search-decoration]:hidden"
            v-model="searchTerm"
            @input="emitSearch"
        />
        <button
            v-if="searchTerm"
            @click="clearSearch"
            aria-label="Hapus pencarian"
            class="absolute right-2.5 top-1/2 -translate-y-1/2 rounded-full p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
        >
            <svg
                class="h-4 w-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        </button>
    </div>
</template>

<script setup>
import { ref } from "vue";

const emit = defineEmits(["search-changed"]);
const searchTerm = ref("");

const emitSearch = () => {
    emit("search-changed", searchTerm.value);
};

const clearSearch = () => {
    searchTerm.value = "";
    emit("search-changed", "");
};
</script>
