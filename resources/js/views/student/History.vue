<template>
  <div>
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Analysis History</h1>
    
    <div v-if="loading" class="flex justify-center py-10">
      <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-500"></div>
    </div>
    
    <div v-else-if="analysisResults.length > 0">
      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
          <h2 class="text-lg leading-6 font-medium text-gray-900">Your Analysis Results</h2>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">Browse your previous career matching analyses</p>
        </div>
        <div class="border-t border-gray-200">
          <ul class="divide-y divide-gray-200">
            <li v-for="result in analysisResults" :key="result.id" class="px-6 py-6">
              <div class="flex items-center justify-between">
                <div class="flex items-center">
                  <div class="bg-indigo-100 rounded-full p-2 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-sm font-medium text-gray-900">{{ result.career_title }}</h3>
                    <p class="text-sm text-gray-500">{{ formatDate(result.created_at) }}</p>
                  </div>
                </div>
                <div class="flex items-center">
                  <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 mr-4">
                    {{ result.match_score }}% match
                  </span>
                  <router-link 
                    :to="`/student/result/${result.id}`" 
                    class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none"
                  >
                    View Details
                  </router-link>
                </div>
              </div>
              
              <div class="mt-4 flex items-center text-sm text-gray-500">
                <div class="flex-1">
                  <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>{{ result.user_skills?.length || 0 }} skills analyzed</span>
                  </div>
                </div>
                <div class="flex-1">
                  <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>{{ result.career_level || 'N/A' }}</span>
                  </div>
                </div>
                <div class="flex-1">
                  <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span>{{ result.status || 'Completed' }}</span>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      
      <!-- Pagination -->
      <Pagination 
        :current-page="currentPage"
        :per-page="perPage"
        :total-items="totalResults"
        @update:currentPage="updatePage"
      />
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
              Start your first analysis &rarr;
            </router-link>
          </div>
        </div>
      </div>
    </div>
    
    <div v-else class="text-center py-12">
      <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
      </svg>
      <h3 class="mt-2 text-sm font-medium text-gray-900">No analysis history</h3>
      <p class="mt-1 text-sm text-gray-500">Get started by uploading your CV for career matching.</p>
      <div class="mt-6">
        <router-link
          to="/student/upload"
          class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none"
        >
          Upload CV
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Pagination from '../../components/common/Pagination.vue';
import { analysisService } from '../../services/analysisService';
import { useAnalysisStore } from '../../stores/analysis';

const analysisStore = useAnalysisStore();

const analysisResults = ref([]);
const loading = ref(true);
const error = ref('');
const currentPage = ref(1);
const perPage = ref(10);
const totalResults = ref(0);

onMounted(async () => {
  await loadAnalysisHistory();
});

const loadAnalysisHistory = async () => {
  try {
    const params = {
      page: currentPage.value,
      per_page: perPage.value
    };
    
    const response = await analysisService.getAnalysisHistory(params);
    
    // Handle both paginated and non-paginated responses
    if (response.data && response.data.data) {
      analysisResults.value = response.data.data;
      totalResults.value = response.data.total || response.data.data.length;
      currentPage.value = response.data.current_page || 1;
      perPage.value = response.data.per_page || 10;
    } else {
      analysisResults.value = response.data || [];
      totalResults.value = response.data?.length || 0;
    }
  } catch (err) {
    console.error('Error loading analysis history:', err);
    error.value = err.response?.data?.message || 'Failed to load analysis history';
  } finally {
    loading.value = false;
  }
};

const updatePage = async (page) => {
  currentPage.value = page;
  await loadAnalysisHistory();
};

const formatDate = (dateString) => {
  const options = { year: 'numeric', month: 'short', day: 'numeric' };
  return new Date(dateString).toLocaleDateString(undefined, options);
};
</script>