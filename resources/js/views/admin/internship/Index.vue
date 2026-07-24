<template>
  <div>
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-gray-900">Manage Internships</h1>
      <router-link
        to="/admin/internships/create"
        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none"
      >
        Add New Internship
      </router-link>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="px-4 py-5 sm:px-6">
        <h2 class="text-lg leading-6 font-medium text-gray-900">Internships List</h2>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">List of all available internships</p>
      </div>
      <div class="border-t border-gray-200">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="internship in internships" :key="internship.id">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ internship.id }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ internship.title }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ internship.company }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ internship.location || 'N/A' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <router-link 
                    :to="`/admin/internships/${internship.id}/edit`" 
                    class="text-indigo-600 hover:text-indigo-900 mr-3"
                  >
                    Edit
                  </router-link>
                  <button 
                    @click="deleteInternship(internship.id)" 
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
    <div v-if="!loading && internships.length === 0" class="text-center py-10">
      <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
      </svg>
      <h3 class="mt-2 text-sm font-medium text-gray-900">No internships</h3>
      <p class="mt-1 text-sm text-gray-500">Get started by creating a new internship.</p>
      <div class="mt-6">
        <router-link
          to="/admin/internships/create"
          class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none"
        >
          Add New Internship
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useApi } from '../../../services/api';

const router = useRouter();
const internships = ref([]);
const loading = ref(false);

onMounted(() => {
  fetchInternships();
});

const fetchInternships = async () => {
  loading.value = true;
  try {
    const response = await useApi().get('/internships');
    internships.value = response.data.data || response.data;
  } catch (error) {
    console.error('Error fetching internships:', error);
  } finally {
    loading.value = false;
  }
};

const deleteInternship = async (id) => {
  if (confirm('Are you sure you want to delete this internship? This action cannot be undone.')) {
    try {
      await useApi().delete(`/internships/${id}`);
      // Remove the deleted internship from the list
      internships.value = internships.value.filter(internship => internship.id !== id);
    } catch (error) {
      console.error('Error deleting internship:', error);
      alert('Failed to delete internship. Please try again.');
    }
  }
};
</script>