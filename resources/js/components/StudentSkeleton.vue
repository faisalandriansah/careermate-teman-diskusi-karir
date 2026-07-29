<template>
  <div class="space-y-4">
    <div v-for="n in rows" :key="n" class="flex items-center space-x-4">
      <div class="h-4 bg-gray-200 rounded animate-pulse" style="width: 20px;"></div>
      <div class="h-4 bg-gray-200 rounded animate-pulse flex-1"></div>
      <div class="h-4 bg-gray-200 rounded animate-pulse flex-1"></div>
      <div class="h-4 bg-gray-200 rounded animate-pulse flex-1"></div>
      <div class="h-4 bg-gray-200 rounded animate-pulse flex-1"></div>
      <div class="h-4 bg-gray-200 rounded animate-pulse flex-1"></div>
      <div class="h-4 bg-gray-200 rounded animate-pulse flex-1"></div>
      <div class="h-4 bg-gray-200 rounded animate-pulse" style="width: 60px;"></div>
      <div class="h-4 bg-gray-200 rounded animate-pulse" style="width: 40px;"></div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  rows: {
    type: Number,
    default: 5
  }
});
</script>