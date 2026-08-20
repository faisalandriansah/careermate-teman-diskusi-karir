<template>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <div
            v-for="n in rows"
            :key="n"
            class="rounded-xl bg-slate-50 p-4"
        >
            <div class="flex items-center gap-3">
                <div
                    class="h-11 w-11 shrink-0 animate-pulse rounded-full bg-slate-200"
                ></div>
                <div class="flex-1 space-y-2">
                    <div
                        class="h-3 w-2/3 animate-pulse rounded bg-slate-200"
                    ></div>
                    <div
                        class="h-3 w-1/2 animate-pulse rounded bg-slate-200"
                    ></div>
                </div>
            </div>
            <div class="mt-3 space-y-2">
                <div
                    class="h-3 w-3/4 animate-pulse rounded bg-slate-200"
                ></div>
                <div
                    class="h-3 w-2/3 animate-pulse rounded bg-slate-200"
                ></div>
            </div>
            <div
                class="mt-4 h-9 w-full animate-pulse rounded-xl bg-slate-200"
            ></div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    rows: {
        type: Number,
        default: 6,
    },
});
</script>