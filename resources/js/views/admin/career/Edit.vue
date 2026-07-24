<template>
  <div>
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Career</h1>
    
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="px-4 py-5 sm:px-6">
        <h2 class="text-lg leading-6 font-medium text-gray-900">Career Information</h2>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Update the details for the career</p>
      </div>
      <div class="border-t border-gray-200">
        <form @submit.prevent="updateCareer" class="p-6">
          <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
            <div class="sm:col-span-4">
              <label for="title" class="block text-sm font-medium text-gray-700">Career Title</label>
              <div class="mt-1">
                <input
                  type="text"
                  id="title"
                  v-model="careerForm.title"
                  required
                  class="py-2 px-3 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                />
              </div>
            </div>

            <div class="sm:col-span-2">
              <label for="level" class="block text-sm font-medium text-gray-700">Level</label>
              <div class="mt-1">
                <select
                  id="level"
                  v-model="careerForm.level"
                  required
                  class="py-2 px-3 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                >
                  <option value="">Select Level</option>
                  <option value="Entry">Entry</option>
                  <option value="Junior">Junior</option>
                  <option value="Mid">Mid</option>
                  <option value="Senior">Senior</option>
                  <option value="Lead">Lead</option>
                  <option value="Manager">Manager</option>
                </select>
              </div>
            </div>

            <div class="sm:col-span-3">
              <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
              <div class="mt-1">
                <input
                  type="text"
                  id="location"
                  v-model="careerForm.location"
                  class="py-2 px-3 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                />
              </div>
            </div>

            <div class="sm:col-span-3">
              <label for="salary_range" class="block text-sm font-medium text-gray-700">Salary Range</label>
              <div class="mt-1">
                <input
                  type="text"
                  id="salary_range"
                  v-model="careerForm.salary_range"
                  class="py-2 px-3 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                />
              </div>
            </div>

            <div class="sm:col-span-6">
              <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
              <div class="mt-1">
                <textarea
                  id="description"
                  v-model="careerForm.description"
                  rows="4"
                  class="py-2 px-3 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                ></textarea>
              </div>
            </div>

            <div class="sm:col-span-6">
              <label for="requirements" class="block text-sm font-medium text-gray-700">Requirements</label>
              <div class="mt-1">
                <textarea
                  id="requirements"
                  v-model="careerForm.requirements"
                  rows="4"
                  class="py-2 px-3 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                ></textarea>
              </div>
            </div>
          </div>

          <div class="mt-8 flex justify-end">
            <router-link
              to="/admin/careers"
              class="mr-3 inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none"
            >
              Cancel
            </router-link>
            <button
              type="submit"
              :disabled="loading"
              class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none disabled:opacity-50"
            >
              <span v-if="loading">
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Updating...
              </span>
              <span v-else>
                Update Career
              </span>
            </button>
          </div>
        </form>
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
import { reactive, ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { useCareerStore } from '../../../stores/career';

const router = useRouter();
const route = useRoute();
const careerStore = useCareerStore();

const careerForm = reactive({
  title: '',
  level: '',
  location: '',
  salary_range: '',
  description: '',
  requirements: ''
});

const loading = ref(false);
const error = ref('');
const careerId = ref(parseInt(route.params.id));

onMounted(async () => {
  await loadCareer();
});

const loadCareer = async () => {
  try {
    const career = await careerStore.getCareer(careerId.value);
    if (career) {
      careerForm.title = career.title;
      careerForm.level = career.level;
      careerForm.location = career.location || '';
      careerForm.salary_range = career.salary_range || '';
      careerForm.description = career.description || '';
      careerForm.requirements = career.requirements || '';
    } else {
      router.push('/admin/careers');
    }
  } catch (err) {
    console.error('Error loading career:', err);
    router.push('/admin/careers');
  }
};

const updateCareer = async () => {
  loading.value = true;
  error.value = '';
  
  try {
    await careerStore.updateCareer(careerId.value, careerForm);
    router.push('/admin/careers');
  } catch (err) {
    console.error('Error updating career:', err);
    if (err.response?.data?.message) {
      error.value = err.response.data.message;
    } else {
      error.value = 'An error occurred while updating the career. Please try again.';
    }
  } finally {
    loading.value = false;
  }
};
</script>