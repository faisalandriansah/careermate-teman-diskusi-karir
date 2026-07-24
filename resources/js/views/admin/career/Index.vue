<template>
  <div>
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-gray-900">Manage Careers</h1>
      <router-link
        to="/admin/careers/create"
        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none"
      >
        Add New Career
      </router-link>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="px-4 py-5 sm:px-6">
        <h2 class="text-lg leading-6 font-medium text-gray-900">Careers List</h2>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">List of all available careers</p>
      </div>
      <div class="border-t border-gray-200">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="career in careers" :key="career.id">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ career.id }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ career.title }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ career.level }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ career.location || 'N/A' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <router-link 
                    :to="`/admin/careers/${career.id}/edit`" 
                    class="text-indigo-600 hover:text-indigo-900 mr-3"
                  >
                    Edit
                  </router-link>
                  <button 
                    @click="deleteCareer(career.id)" 
                    class="text-red-600 hover:text-red-900"
                  >
                    Delete
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <!-- Loading indicator -->
    <div v-if="loading" class="flex justify-center py-10">
      <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-500"></div>
    </div>
    
    <!-- Empty state -->
    <div v-if="!loading && careers.length === 0" class="text-center py-10">
      <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
      </svg>
      <h3 class="mt-2 text-sm font-medium text-gray-900">No careers</h3>
      <p class="mt-1 text-sm text-gray-500">Get started by creating a new career.</p>
      <div class="mt-6">
        <router-link
          to="/admin/careers/create"
          class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none"
        >
          Add New Career
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useCareerStore } from '../../../stores/career';

const router = useRouter();
const careerStore = useCareerStore();

const careers = computed(() => careerStore.careers);
const loading = computed(() => careerStore.loading);

onMounted(() => {
  fetchCareers();
});

const fetchCareers = async () => {
  try {
    await careerStore.getCareers();
  } catch (error) {
    console.error('Error fetching careers:', error);
  }
};

const deleteCareer = async (id) => {
  if (confirm('Are you sure you want to delete this career? This action cannot be undone.')) {
    try {
      await careerStore.deleteCareer(id);
      // The career is automatically removed from the store after deletion
    } catch (error) {
      console.error('Error deleting career:', error);
      alert('Failed to delete career. Please try again.');
    }
  }
};
</script>