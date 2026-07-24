<template>
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Skill Gap Analysis</h3>
    
    <div class="mb-4">
      <div class="flex justify-between mb-1">
        <span class="text-sm font-medium text-gray-700">Matching Skills</span>
        <span class="text-sm font-medium text-gray-700">{{ matchedPercentage }}%</span>
      </div>
      <div class="w-full bg-gray-200 rounded-full h-2.5">
        <div 
          class="bg-green-600 h-2.5 rounded-full" 
          :style="{ width: matchedPercentage + '%' }"
        ></div>
      </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
      <div>
        <h4 class="text-md font-semibold text-green-700 mb-3 flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
          </svg>
          Your Skills Matched
        </h4>
        <ul class="mt-2 space-y-2">
          <li 
            v-for="skill in matchedSkills" 
            :key="skill.id"
            class="flex items-center text-sm text-gray-600 bg-green-50 px-3 py-2 rounded-md"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ skill.name }}
          </li>
        </ul>
      </div>
      
      <div>
        <h4 class="text-md font-semibold text-red-700 mb-3 flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
          </svg>
          Missing Skills
        </h4>
        <ul class="mt-2 space-y-2">
          <li 
            v-for="skill in missingSkills" 
            :key="skill.id"
            class="flex items-center text-sm text-gray-600 bg-red-50 px-3 py-2 rounded-md"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-red-500" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
            {{ skill.name }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  userSkills: {
    type: Array,
    default: () => []
  },
  requiredSkills: {
    type: Array,
    default: () => []
  }
});

const matchedSkills = computed(() => {
  if (!props.userSkills || !props.requiredSkills) return [];
  
  return props.requiredSkills.filter(requiredSkill => 
    props.userSkills.some(userSkill => 
      userSkill.id === requiredSkill.id || userSkill.name.toLowerCase() === requiredSkill.name.toLowerCase()
    )
  );
});

const missingSkills = computed(() => {
  if (!props.userSkills || !props.requiredSkills) return [];
  
  return props.requiredSkills.filter(requiredSkill => 
    !props.userSkills.some(userSkill => 
      userSkill.id === requiredSkill.id || userSkill.name.toLowerCase() === requiredSkill.name.toLowerCase()
    )
  );
});

const matchedPercentage = computed(() => {
  if (!props.requiredSkills || props.requiredSkills.length === 0) return 0;
  
  return Math.round((matchedSkills.value.length / props.requiredSkills.length) * 100);
});
</script>