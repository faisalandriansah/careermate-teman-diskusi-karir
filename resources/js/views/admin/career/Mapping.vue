<template>
  <div>
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Career Skill Mapping</h1>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
          <h2 class="text-lg leading-6 font-medium text-gray-900">Select Career</h2>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">Choose a career to map skills to</p>
        </div>
        <div class="border-t border-gray-200 p-6">
          <div class="mb-4">
            <label for="career-select" class="block text-sm font-medium text-gray-700 mb-2">Select Career</label>
            <select
              id="career-select"
              v-model="selectedCareerId"
              @change="loadCareerSkills"
              class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
            >
              <option value="">-- Select a Career --</option>
              <option v-for="career in careers" :key="career.id" :value="career.id">
                {{ career.title }}
              </option>
            </select>
          </div>
        </div>
      </div>
      
      <div class="bg-white shadow overflow-hidden sm:rounded-lg" v-if="selectedCareerId">
        <div class="px-4 py-5 sm:px-6">
          <h2 class="text-lg leading-6 font-medium text-gray-900">Available Skills</h2>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">Select skills for the chosen career</p>
        </div>
        <div class="border-t border-gray-200 p-6">
          <div class="mb-4" v-if="loading">
            <div class="flex justify-center">
              <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-indigo-500"></div>
            </div>
          </div>
          
          <div v-else>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-2">Search Skills</label>
              <input
                type="text"
                v-model="searchTerm"
                placeholder="Search skills..."
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
              />
            </div>
            
            <div class="space-y-2 max-h-96 overflow-y-auto pr-2">
              <div 
                v-for="skill in filteredSkills" 
                :key="skill.id"
                class="flex items-center justify-between p-3 border border-gray-200 rounded-md"
              >
                <div class="flex items-center">
                  <input
                    :id="'skill-' + skill.id"
                    :value="skill.id"
                    type="checkbox"
                    v-model="selectedSkills"
                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                  />
                  <label :for="'skill-' + skill.id" class="ml-3 block text-sm text-gray-700">
                    {{ skill.name }}
                  </label>
                </div>
                <span class="text-xs px-2 py-1 bg-gray-100 rounded">{{ skill.category || 'General' }}</span>
              </div>
              
              <div v-if="filteredSkills.length === 0" class="text-center py-4 text-gray-500">
                No skills found
              </div>
            </div>
            
            <div class="mt-6 flex justify-end">
              <button
                @click="saveMapping"
                :disabled="saving || selectedSkills.length === 0"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none disabled:opacity-50"
              >
                <span v-if="saving">
                  <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  Saving...
                </span>
                <span v-else>
                  Save Mapping
                </span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Show current mappings if a career is selected -->
    <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg" v-if="selectedCareerId && careerSkills.length > 0">
      <div class="px-4 py-5 sm:px-6">
        <h2 class="text-lg leading-6 font-medium text-gray-900">Current Skill Mappings</h2>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Skills currently mapped to {{ selectedCareer.title }}</p>
      </div>
      <div class="border-t border-gray-200">
        <ul class="divide-y divide-gray-200">
          <li v-for="skill in careerSkills" :key="skill.id" class="px-6 py-4">
            <div class="flex items-center justify-between">
              <div class="text-sm font-medium text-gray-900">{{ skill.name }}</div>
              <button
                @click="removeSkillFromCareer(skill.id)"
                class="text-red-600 hover:text-red-900 text-sm"
              >
                Remove
              </button>
            </div>
            <div class="mt-1 text-sm text-gray-500">{{ skill.description }}</div>
          </li>
        </ul>
      </div>
    </div>
    
    <div v-if="error" class="mt-4 bg-red-50 border border-red-200 rounded-md p-4">
      <div class="flex">
        <div class="flex-shrink-0">
          <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
          </svg>
        </div>
        <div class="ml-3">
          <h3 class="text-sm font-medium text-red-800">{{ error }}</h3>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useCareerStore } from '../../../stores/career';

const careerStore = useCareerStore();

const selectedCareerId = ref('');
const selectedSkills = ref([]);
const searchTerm = ref('');
const saving = ref(false);
const loading = ref(false);
const error = ref('');

const careers = computed(() => careerStore.careers);
const skills = computed(() => careerStore.skills);
const careerSkills = computed(() => careerStore.careerSkills);

const selectedCareer = computed(() => {
  return careers.value.find(career => career.id === parseInt(selectedCareerId.value));
});

const filteredSkills = computed(() => {
  if (!searchTerm.value) {
    // Filter out skills that are already mapped to the selected career
    return skills.value.filter(skill => 
      !careerSkills.value.some(mappedSkill => mappedSkill.id === skill.id)
    );
  }
  
  const term = searchTerm.value.toLowerCase();
  return skills.value.filter(skill => 
    skill.name.toLowerCase().includes(term) &&
    !careerSkills.value.some(mappedSkill => mappedSkill.id === skill.id)
  );
});

onMounted(async () => {
  try {
    await Promise.all([
      careerStore.getCareers(),
      careerStore.getSkills()
    ]);
  } catch (err) {
    console.error('Error loading data:', err);
    error.value = 'Failed to load data. Please refresh the page.';
  }
});

const loadCareerSkills = async () => {
  if (selectedCareerId.value) {
    loading.value = true;
    try {
      await careerStore.getCareerSkills(selectedCareerId.value);
      // Pre-populate selectedSkills with already mapped skills
      selectedSkills.value = careerSkills.value.map(skill => skill.id);
    } catch (err) {
      console.error('Error loading career skills:', err);
      error.value = 'Failed to load career skills.';
    } finally {
      loading.value = false;
    }
  } else {
    // Reset if no career is selected
    selectedSkills.value = [];
  }
};

const saveMapping = async () => {
  if (!selectedCareerId.value || selectedSkills.value.length === 0) {
    error.value = 'Please select a career and at least one skill.';
    return;
  }

  saving.value = true;
  error.value = '';
  
  try {
    await careerStore.mapSkillsToCareer(selectedCareerId.value, selectedSkills.value);
    // Reload the career skills to reflect changes
    await loadCareerSkills();
  } catch (err) {
    console.error('Error saving mapping:', err);
    error.value = 'Failed to save skill mapping. Please try again.';
  } finally {
    saving.value = false;
  }
};

const removeSkillFromCareer = async (skillId) => {
  // In the actual implementation, you would call an API to remove the skill
  // For now, we'll just reload the career skills to update the display
  try {
    await careerStore.mapSkillsToCareer(selectedCareerId.value, 
      careerSkills.value.filter(skill => skill.id !== skillId).map(skill => skill.id)
    );
    await loadCareerSkills();
  } catch (err) {
    console.error('Error removing skill:', err);
    error.value = 'Failed to remove skill. Please try again.';
  }
};
</script>