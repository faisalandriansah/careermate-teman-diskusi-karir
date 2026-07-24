<template>
  <div>
    <h1 class="text-2xl font-bold text-gray-900 mb-6">My Profile</h1>
    
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="px-4 py-5 sm:px-6">
        <h2 class="text-lg leading-6 font-medium text-gray-900">Personal Information</h2>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Update your personal details</p>
      </div>
      <div class="border-t border-gray-200">
        <form @submit.prevent="updateProfile" class="p-6">
          <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label for="first-name" class="block text-sm font-medium text-gray-700">First name</label>
              <div class="mt-1">
                <input
                  type="text"
                  id="first-name"
                  v-model="profileForm.first_name"
                  required
                  class="py-2 px-3 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                />
              </div>
            </div>

            <div class="sm:col-span-3">
              <label for="last-name" class="block text-sm font-medium text-gray-700">Last name</label>
              <div class="mt-1">
                <input
                  type="text"
                  id="last-name"
                  v-model="profileForm.last_name"
                  required
                  class="py-2 px-3 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                />
              </div>
            </div>

            <div class="sm:col-span-4">
              <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
              <div class="mt-1">
                <input
                  id="email"
                  name="email"
                  type="email"
                  v-model="profileForm.email"
                  required
                  class="py-2 px-3 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                />
              </div>
            </div>

            <div class="sm:col-span-6">
              <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
              <div class="mt-1">
                <textarea
                  id="bio"
                  v-model="profileForm.bio"
                  rows="4"
                  class="py-2 px-3 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                ></textarea>
              </div>
              <p class="mt-2 text-sm text-gray-500">Tell us a little bit about yourself.</p>
            </div>

            <div class="sm:col-span-6">
              <label for="education" class="block text-sm font-medium text-gray-700">Education</label>
              <div class="mt-1">
                <input
                  type="text"
                  id="education"
                  v-model="profileForm.education"
                  class="py-2 px-3 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                />
              </div>
            </div>

            <div class="sm:col-span-6">
              <label for="experience" class="block text-sm font-medium text-gray-700">Work Experience</label>
              <div class="mt-1">
                <input
                  type="text"
                  id="experience"
                  v-model="profileForm.experience"
                  class="py-2 px-3 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                />
              </div>
            </div>
          </div>

          <div class="mt-8 flex justify-end">
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
                Saving...
              </span>
              <span v-else>
                Save Changes
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
    
    <div v-if="successMessage" class="mt-4 bg-green-50 border border-green-200 rounded-md p-4">
      <div class="flex">
        <div class="flex-shrink-0">
          <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
          </svg>
        </div>
        <div class="ml-3">
          <h3 class="text-sm font-medium text-green-800">{{ successMessage }}</h3>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, reactive } from 'vue';
import { useApi } from '@/services/api';
import { useAuthStore } from '@/stores/auth';

const authStore = useAuthStore();

const profileForm = reactive({
  first_name: '',
  last_name: '',
  email: '',
  bio: '',
  education: '',
  experience: ''
});

const loading = ref(false);
const error = ref('');
const successMessage = ref('');

onMounted(async () => {
  await loadProfile();
});

const loadProfile = async () => {
  try {
    const response = await useApi().get('/user');
    const user = response.data;
    
    // Populate form fields with user data
    profileForm.first_name = user.first_name || user.name.split(' ')[0] || '';
    profileForm.last_name = user.last_name || user.name.split(' ').slice(1).join(' ') || '';
    profileForm.email = user.email;
    profileForm.bio = user.bio || '';
    profileForm.education = user.education || '';
    profileForm.experience = user.experience || '';
  } catch (err) {
    console.error('Error loading profile:', err);
    error.value = 'Failed to load profile information';
  }
};

const updateProfile = async () => {
  loading.value = true;
  error.value = '';
  successMessage.value = '';
  
  try {
    const response = await useApi().put('/user', profileForm);
    
    // Update the user info in the auth store
    authStore.user = { ...authStore.user, ...response.data };
    
    successMessage.value = 'Profile updated successfully!';
  } catch (err) {
    console.error('Error updating profile:', err);
    let errorMessage = 'An error occurred while updating your profile.';
    
    if (err.response?.data?.message) {
      errorMessage = err.response.data.message;
    } else if (err.response?.data?.errors) {
      errorMessage = Object.values(err.response.data.errors)[0][0];
    }
    
    error.value = errorMessage;
  } finally {
    loading.value = false;
  }
};
</script>