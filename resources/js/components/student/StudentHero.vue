<template>
    <div
        class="hero relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-950 via-blue-900 to-blue-800 p-6 md:p-8 mb-6 shadow-lg fade-up"
        :class="compact ? 'md:p-6' : 'md:p-8'"
    >
        <div class="orb orb-indigo"></div>

        <!-- Route Line Background -->
        <svg
            class="absolute right-0 top-0 h-full w-1/2 opacity-[0.08] pointer-events-none"
            viewBox="0 0 200 200"
            fill="none"
            aria-hidden="true"
        >
            <path
                d="M0 150 Q 60 20 120 100 T 200 40"
                stroke="white"
                stroke-width="3"
                stroke-dasharray="6 8"
            />
        </svg>

        <div class="relative z-10">
            <slot />
        </div>

        <!-- Elemen dekoratif yang "mengintip" dari luar batas hero -->
        <slot name="peek" />
    </div>
</template>

<script setup>
defineProps({
    compact: {
        type: Boolean,
        default: false,
    },
});
</script>

<style scoped>
.fade-up {
    animation: fadeUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) both;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(14px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.orb {
    position: absolute;
    border-radius: 9999px;
    filter: blur(48px);
    opacity: 0.25;
    pointer-events: none;
}

.orb-indigo {
    width: 220px;
    height: 220px;
    background: #2563eb;
    top: -80px;
    right: 20px;
}
</style>
