<template>
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Career Development Roadmap</h3>
    
    <div class="prose prose-sm max-w-none">
      <div v-if="roadmap && roadmap.weeks" class="space-y-6">
        <div 
          v-for="(week, index) in roadmap.weeks" 
          :key="index"
          class="relative pl-8 pb-6"
        >
          <!-- Vertical timeline line -->
          <div 
            v-if="index < roadmap.weeks.length - 1" 
            class="absolute left-4 top-8 bottom-0 w-0.5 bg-gray-200"
          ></div>
          
          <!-- Timeline marker -->
          <div class="absolute left-0 top-6 w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center">
            <span class="text-white text-sm font-bold">{{ index + 1 }}</span>
          </div>
          
          <!-- Week content -->
          <div class="bg-gray-50 rounded-lg p-4">
            <h4 class="font-semibold text-gray-900">Week {{ index + 1 }}: {{ week.week_title }}</h4>
            <p class="mt-2 text-gray-600">{{ week.description }}</p>
            
            <div class="mt-3">
              <h5 class="text-sm font-medium text-gray-700">Tasks:</h5>
              <ul class="mt-1 space-y-1">
                <li 
                  v-for="(task, taskIndex) in week.tasks" 
                  :key="taskIndex"
                  class="flex items-start"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mt-0.5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                  </svg>
                  <span class="text-sm text-gray-600">{{ task }}</span>
                </li>
              </ul>
            </div>
            
            <div class="mt-3">
              <h5 class="text-sm font-medium text-gray-700">Resources:</h5>
              <ul class="mt-1 space-y-1">
                <li 
                  v-for="(resource, resourceIndex) in week.resources" 
                  :key="resourceIndex"
                  class="flex items-start"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mt-0.5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                  </svg>
                  <span class="text-sm text-gray-600">{{ resource }}</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      
      <div v-else-if="summary" class="text-gray-600 whitespace-pre-line">
        {{ summary }}
      </div>
      
      <div v-else class="text-gray-500 italic">
        No roadmap available yet.
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  roadmap: {
    type: Object,
    default: null
  },
  summary: {
    type: String,
    default: ''
  }
});
</script>