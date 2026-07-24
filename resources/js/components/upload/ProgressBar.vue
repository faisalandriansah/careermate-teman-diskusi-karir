<template>
  <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
    <div 
      class="bg-indigo-600 h-2.5 rounded-full transition-all duration-300 ease-in-out" 
      :style="{ width: progress + '%' }"
    ></div>
  </div>
  <div class="text-center text-sm text-gray-600">
    {{ Math.round(progress) }}% - {{ status }}
  </div>
</template>

<script setup>
defineProps({
  progress: {
    type: Number,
    default: 0
  },
  status: {
    type: String,
    default: 'Ready'
  }
});
</script>