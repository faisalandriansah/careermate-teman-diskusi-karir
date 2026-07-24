<script setup>
import { RouterView } from 'vue-router';
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import AuthLayout from './layouts/AuthLayout.vue';
import AdminLayout from './layouts/AdminLayout.vue';
import StudentLayout from './layouts/StudentLayout.vue';

const route = useRoute();

const currentLayout = computed(() => {
  return route.meta.layout || 'div'; // Default ke div jika tidak ada layout
});

const layoutComponents = {
  AuthLayout,
  AdminLayout,
  StudentLayout
};
</script>

<template>
  <component :is="layoutComponents[currentLayout] || 'div'" v-if="currentLayout !== 'div'">
    <RouterView />
  </component>
  <div v-else>
    <RouterView />
  </div>
</template>