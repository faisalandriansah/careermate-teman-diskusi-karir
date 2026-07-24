<template>
  <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <div class="p-6">
      <div class="flex justify-between items-start">
        <div>
          <h3 class="text-lg font-semibold text-gray-900">{{ career.title }}</h3>
          <p class="mt-1 text-sm text-gray-500">{{ career.description }}</p>
        </div>
        <div class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
          {{ career.level }}
        </div>
      </div>
      
      <div class="mt-4 flex flex-wrap gap-2">
        <span 
          v-for="skill in career.skills?.slice(0, 3)" 
          :key="skill.id"
          class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800"
        >
          {{ skill.name }}
        </span>
        <span 
          v-if="career.skills && career.skills.length > 3" 
          class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800"
        >
          +{{ career.skills.length - 3 }} others
        </span>
      </div>
      
      <div class="mt-4 pt-4 border-t border-gray-200">
        <div class="flex items-center text-sm text-gray-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          {{ career.location || 'Remote' }}
        </div>
        <div class="mt-1 flex items-center text-sm text-gray-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          {{ career.salary_range || 'Confidential' }}
        </div>
      </div>
    </div>
    
    <div class="bg-gray-50 px-6 py-3 flex justify-end">
      <slot name="actions"></slot>
    </div>
  </div>
</template>

<script setup>
defineProps({
  career: {
    type: Object,
    required: true
  }
});
</script>