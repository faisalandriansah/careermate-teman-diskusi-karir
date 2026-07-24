<template>
  <aside class="w-64 bg-white shadow-md h-full">
    <div class="p-4 border-b">
      <h1 class="text-xl font-bold text-indigo-600">CareerMate AI</h1>
      <p class="text-xs text-gray-500">{{ role }} Panel</p>
    </div>
    <nav class="mt-5 px-2">
      <slot name="menu-items"></slot>
    </nav>
  </aside>
</template>

<script setup>
import { computed } from 'vue';
import { useAuthStore } from '../../stores/auth';

const authStore = useAuthStore();

const role = computed(() => {
  return authStore.user?.role || 'Guest';
});
</script>