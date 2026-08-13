<template>
    <div v-if="variant === 'cards'" class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        <div
            v-for="n in count"
            :key="n"
            class="rounded-2xl border border-slate-200 bg-slate-50 p-5"
        >
            <div class="flex items-start justify-between gap-3">
                <div class="flex-1 space-y-2">
                    <div
                        class="h-4 w-2/3 animate-pulse rounded bg-slate-200"
                    ></div>
                    <div
                        class="h-3 w-full animate-pulse rounded bg-slate-200"
                    ></div>
                    <div
                        class="h-3 w-4/5 animate-pulse rounded bg-slate-200"
                    ></div>
                </div>
                <div class="flex gap-2">
                    <div
                        class="h-8 w-8 animate-pulse rounded-full bg-slate-200"
                    ></div>
                    <div
                        class="h-8 w-8 animate-pulse rounded-full bg-slate-200"
                    ></div>
                </div>
            </div>
        </div>
    </div>

    <div v-else class="space-y-3">
        <div
            v-for="n in count"
            :key="n"
            class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-5"
        >
            <div class="h-10 w-10 animate-pulse rounded-xl bg-slate-200"></div>
            <div class="flex-1 space-y-2">
                <div class="h-3 w-1/3 animate-pulse rounded bg-slate-200"></div>
                <div class="h-3 w-2/3 animate-pulse rounded bg-slate-200"></div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    variant: {
        type: String,
        default: "cards",
        validator: (value) => ["cards", "rows"].includes(value),
    },
    count: {
        type: Number,
        default: 6,
    },
});
</script>
