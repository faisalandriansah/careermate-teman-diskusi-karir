<template>
    <div
        class="bg-white rounded-2xl border border-slate-100 shadow-sm"
        :class="paddingClass"
    >
        <slot />
    </div>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
    padding: {
        type: String,
        default: "p-5 md:p-6",
    },
});

const paddingClass = computed(() => props.padding);
</script>
