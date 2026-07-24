<template>
  <div>
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Career Analysis Result</h1>
    
    <div v-if="loading" class="flex justify-center py-10">
      <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-500"></div>
    </div>
    
    <div v-else-if="analysisResult">
      <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
        <div class="px-4 py-5 sm:px-6">
          <h2 class="text-lg leading-6 font-medium text-gray-900">Analysis Summary</h2>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">Your career matching results</p>
        </div>
        <div class="border-t border-gray-200">
          <div class="px-4 py-5 sm:p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
              <div class="bg-indigo-50 rounded-lg p-4 text-center">
                <p class="text-sm font-medium text-indigo-700">Match Score</p>
                <p class="mt-2 text-3xl font-bold text-indigo-900">{{ analysisResult.match_score }}%</p>
              </div>
              <div class="bg-green-50 rounded-lg p-4 text-center">
                <p class="text-sm font-medium text-green-700">Recommended Career</p>
                <p class="mt-2 text-lg font-bold text-green-900">{{ analysisResult.career_title }}</p>
              </div>
              <div class="bg-blue-50 rounded-lg p-4 text-center">
                <p class="text-sm font-medium text-blue-700">Analysis Date</p>
                <p class="mt-2 text-lg font-bold text-blue-900">{{ formatDate(analysisResult.created_at) }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div>
          <SkillGap 
            :user-skills="analysisResult.user_skills || []" 
            :required-skills="analysisResult.required_skills || []" 
          />
          
          <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
              <h2 class="text-lg leading-6 font-medium text-gray-900">Career Details</h2>
            </div>
            <div class="border-t border-gray-200">
              <div class="px-4 py-5 sm:p-6">
                <h3 class="text-md font-semibold text-gray-900 mb-2">{{ analysisResult.career_title }}</h3>
                <p class="text-gray-600 mb-4">{{ analysisResult.career_description }}</p>
                
                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <p class="text-sm text-gray-500">Level</p>
                    <p class="text-sm font-medium">{{ analysisResult.career_level || 'N/A' }}</p>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500">Location</p>
                    <p class="text-sm font-medium">{{ analysisResult.career_location || 'N/A' }}</p>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500">Salary Range</p>
                    <p class="text-sm font-medium">{{ analysisResult.career_salary_range || 'N/A' }}</p>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500">Industry</p>
                    <p class="text-sm font-medium">{{ analysisResult.career_industry || 'N/A' }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div>
          <Roadmap 
            :roadmap="analysisResult.roadmap || null" 
            :summary="analysisResult.roadmap_summary || ''" 
          />
          
          <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
              <h2 class="text-lg leading-6 font-medium text-gray-900">Recommended Internships</h2>
            </div>
            <div class="border-t border-gray-200">
              <ul class="divide-y divide-gray-200">
                <li v-for="internship in analysisResult.internships || []" :key="internship.id" class="px-4 py-4 sm:px-6">
                  <div class="flex items-center justify-between">
                    <div class="text-sm font-medium text-gray-900">{{ internship.title }}</div>
                    <div class="text-sm text-gray-500">{{ internship.company }}</div>
                  </div>
                  <div class="mt-2 flex items-center text-sm text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    {{ internship.location || 'N/A' }}
                  </div>
                </li>
                <li v-if="(analysisResult.internships || []).length === 0" class="px-4 py-8 text-center text-gray-500">
                  No recommended internships available
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      
      <div class="mt-8 flex justify-end space-x-3">
        <router-link
          to="/student/upload"
          class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none"
        >
          Analyze Another CV
        </router-link>
        <button
          @click="generateNewRoadmap"
          :disabled="generatingRoadmap"
          class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none disabled:opacity-50"
        >
          <span v-if="generatingRoadmap">
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Regenerating...
          </span>
          <span v-else>
            Regenerate Roadmap
          </span>
        </button>
      </div>
    </div>
    
    <div v-else-if="error" class="bg-red-50 border border-red-200 rounded-md p-4">
      <div class="flex">
        <div class="flex-shrink-0">
          <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
          </svg>
        </div>
        <div class="ml-3">
          <h3 class="text-sm font-medium text-red-800">{{ error }}</h3>
          <div class="mt-2">
            <router-link 
              to="/student/upload"
              class="text-sm font-medium text-red-700 hover:text-red-900"
            >
              Try uploading another CV &rarr;
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import SkillGap from '../../components/career/SkillGap.vue';
import Roadmap from '../../components/career/Roadmap.vue';
import { analysisService } from '../../../services/analysisService';
import { useAnalysisStore } from '../../../stores/analysis';

const route = useRoute();
const analysisStore = useAnalysisStore();

const analysisResult = ref(null);
const loading = ref(true);
const error = ref('');
const generatingRoadmap = ref(false);

onMounted(async () => {
  await loadAnalysisResult();
});

const loadAnalysisResult = async () => {
  try {
    const resultId = route.params.id || route.query.resultId;
    if (!resultId) {
      error.value = 'No analysis result ID provided';
      return;
    }
    
    // First, try to get the analysis result from the store
    if (analysisStore.currentResult && analysisStore.currentResult.id == resultId) {
      analysisResult.value = analysisStore.currentResult;
    } else {
      // If not in store, fetch from API
      const result = await analysisService.getAnalysisResult(resultId);
      analysisResult.value = result;
    }
  } catch (err) {
    console.error('Error loading analysis result:', err);
    error.value = err.response?.data?.message || 'Failed to load analysis result';
  } finally {
    loading.value = false;
  }
};

const generateNewRoadmap = async () => {
  if (!analysisResult.value) return;
  
  generatingRoadmap.value = true;
  
  try {
    // Prepare data for roadmap generation
    const roadmapData = {
      careerTitle: analysisResult.value.career_title,
      ownedSkills: analysisResult.value.user_skills || [],
      skillGap: analysisResult.value.missing_skills || []
    };
    
    // Call the analysis store to generate roadmap
    const result = await analysisStore.generateRoadmap(roadmapData);
    
    // Update the analysis result with new roadmap
    analysisResult.value.roadmap = result.roadmap;
    analysisResult.value.roadmap_summary = result.summary;
  } catch (err) {
    console.error('Error generating roadmap:', err);
    error.value = 'Failed to regenerate roadmap';
  } finally {
    generatingRoadmap.value = false;
  }
};

const formatDate = (dateString) => {
  const options = { year: 'numeric', month: 'short', day: 'numeric' };
  return new Date(dateString).toLocaleDateString(undefined, options);
};
</script>