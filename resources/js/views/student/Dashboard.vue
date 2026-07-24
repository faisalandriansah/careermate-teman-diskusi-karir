<template>
  <div>
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Student Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
          <div class="flex items-center">
            <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
            </div>
            <div class="ml-5 w-0 flex-1">
              <dl>
                <dt class="text-sm font-medium text-gray-500 truncate">CV Uploaded</dt>
                <dd class="flex items-baseline">
                  <div class="text-2xl font-semibold text-gray-900">{{ uploadedCvsCount }}</div>
                </dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
      
      <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
          <div class="flex items-center">
            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
              </svg>
            </div>
            <div class="ml-5 w-0 flex-1">
              <dl>
                <dt class="text-sm font-medium text-gray-500 truncate">Analyses Done</dt>
                <dd class="flex items-baseline">
                  <div class="text-2xl font-semibold text-gray-900">{{ analysesCount }}</div>
                </dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
      
      <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
          <div class="flex items-center">
            <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
            </div>
            <div class="ml-5 w-0 flex-1">
              <dl>
                <dt class="text-sm font-medium text-gray-500 truncate">Roadmaps Generated</dt>
                <dd class="flex items-baseline">
                  <div class="text-2xl font-semibold text-gray-900">{{ roadmapsCount }}</div>
                </dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
          <h2 class="text-lg leading-6 font-medium text-gray-900">Recent Analyses</h2>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">Your latest career matching results</p>
        </div>
        <div class="border-t border-gray-200">
          <ul class="divide-y divide-gray-200">
            <li v-for="analysis in recentAnalyses" :key="analysis.id" class="px-6 py-4">
              <div class="flex items-center justify-between">
                <div class="text-sm font-medium text-gray-900">{{ analysis.career_title }}</div>
                <div class="text-sm text-gray-500">{{ formatDate(analysis.created_at) }}</div>
              </div>
              <div class="mt-1 flex items-center">
                <div class="flex-1 bg-gray-200 rounded-full h-2">
                  <div 
                    class="bg-indigo-600 h-2 rounded-full" 
                    :style="{ width: `${analysis.match_score}%` }"
                  ></div>
                </div>
                <div class="ml-3 text-sm text-gray-500">{{ analysis.match_score }}% match</div>
              </div>
              <div class="mt-2 flex justify-end">
                <router-link 
                  :to="`/student/result/${analysis.id}`" 
                  class="text-indigo-600 hover:text-indigo-900 text-sm font-medium"
                >
                  View Details
                </router-link>
              </div>
            </li>
            <li v-if="recentAnalyses.length === 0" class="px-6 py-8 text-center">
              <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
              </svg>
              <h3 class="mt-2 text-sm font-medium text-gray-900">No analyses yet</h3>
              <p class="mt-1 text-sm text-gray-500">Upload your CV to get started with career matching.</p>
              <div class="mt-6">
                <router-link
                  to="/student/upload"
                  class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none"
                >
                  Upload CV
                </router-link>
              </div>
            </li>
          </ul>
        </div>
      </div>
      
      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
          <h2 class="text-lg leading-6 font-medium text-gray-900">Recommended Actions</h2>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">Steps to improve your career prospects</p>
        </div>
        <div class="border-t border-gray-200">
          <ul class="divide-y divide-gray-200">
            <li class="px-6 py-4">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-5 w-5 rounded-full bg-indigo-100 flex items-center justify-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-indigo-600" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                  </svg>
                </div>
                <div class="ml-3">
                  <p class="text-sm font-medium text-gray-900">Upload your CV</p>
                  <p class="text-sm text-gray-500">Analyze your skills against career requirements</p>
                </div>
              </div>
            </li>
            <li class="px-6 py-4">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-5 w-5 rounded-full bg-gray-100 flex items-center justify-center">
                  <div class="h-1 w-1 rounded-full bg-gray-400"></div>
                </div>
                <div class="ml-3">
                  <p class="text-sm font-medium text-gray-500">Complete Profile</p>
                  <p class="text-sm text-gray-500">Fill in your personal information</p>
                </div>
              </div>
            </li>
            <li class="px-6 py-4">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-5 w-5 rounded-full bg-gray-100 flex items-center justify-center">
                  <div class="h-1 w-1 rounded-full bg-gray-400"></div>
                </div>
                <div class="ml-3">
                  <p class="text-sm font-medium text-gray-500">Review Results</p>
                  <p class="text-sm text-gray-500">Check your career matching results</p>
                </div>
              </div>
            </li>
            <li class="px-6 py-4">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-5 w-5 rounded-full bg-gray-100 flex items-center justify-center">
                  <div class="h-1 w-1 rounded-full bg-gray-400"></div>
                </div>
                <div class="ml-3">
                  <p class="text-sm font-medium text-gray-500">Follow Roadmap</p>
                  <p class="text-sm text-gray-500">Follow personalized development plan</p>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useApi } from '@/services/api';

const uploadedCvsCount = ref(0);
const analysesCount = ref(0);
const roadmapsCount = ref(0);
const recentAnalyses = ref([]);

onMounted(async () => {
  await loadDashboardData();
});

const loadDashboardData = async () => {
  try {
    // Load analysis results
    const response = await useApi().get('/analysis-results');
    const results = response.data.data || response.data;
    
    recentAnalyses.value = results.slice(0, 3);
    analysesCount.value = results.length;
    
    // Calculate other metrics based on results
    roadmapsCount.value = results.filter(r => r.roadmap).length;
  } catch (error) {
    console.error('Error loading dashboard data:', error);
  }
};

const formatDate = (dateString) => {
  const options = { year: 'numeric', month: 'short', day: 'numeric' };
  return new Date(dateString).toLocaleDateString(undefined, options);
};
</script>