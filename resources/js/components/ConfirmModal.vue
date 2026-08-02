<template>
    <Teleport to="body">
        <div
            v-if="modelValue"
            class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 p-4"
            @click.self="$emit('cancel')"
        >
            <div
                class="w-full max-w-sm rounded-2xl bg-white p-6 text-center shadow-xl"
            >
                <div
                    class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-red-100 text-red-600"
                >
                    <svg
                        class="h-7 w-7"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v3.75m0 3.75h.008v.008H12v-.008zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                </div>
                <h2 class="mt-4 text-xl font-bold text-slate-900">
                    {{ title }}
                </h2>
                <p class="mt-2 text-sm text-slate-500">{{ description }}</p>
                <div class="mt-6 flex gap-3">
                    <button
                        class="flex-1 rounded-xl bg-slate-100 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-200"
                        @click="$emit('cancel')"
                    >
                        {{ cancelText }}
                    </button>
                    <button
                        class="flex-1 rounded-xl bg-red-600 py-2.5 text-sm font-semibold text-white hover:bg-red-700"
                        @click="$emit('confirm')"
                    >
                        {{ confirmText }}
                    </button>
                </div>
            </div>
        </div>
    </Teleport>
</template>

<script setup>
defineProps({
    modelValue: { type: Boolean, default: false },
    title: { type: String, default: "Hapus Data Ini?" },
    description: {
        type: String,
        default: "Data yang sudah dihapus tidak bisa dikembalikan.",
    },
    cancelText: { type: String, default: "Batal" },
    confirmText: { type: String, default: "Hapus" },
});

defineEmits(["confirm", "cancel"]);
</script>
