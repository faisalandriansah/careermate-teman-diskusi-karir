<template>
  <div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md">
      <div class="p-4 border-b">
        <h1 class="text-xl font-bold text-indigo-600">CareerMate AI</h1>
        <p class="text-xs text-gray-500">Admin Panel</p>
      </div>
      <nav class="mt-5 px-2">
        <router-link 
          to="/admin/dashboard" 
          class="flex items-center px-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-100 rounded-md mb-1"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
          Dashboard
        </router-link>
        
        <router-link 
          to="/admin/skills" 
          class="flex items-center px-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-100 rounded-md mb-1"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
          </svg>
          Skill
        </router-link>
        
        <router-link 
          to="/admin/careers" 
          class="flex items-center px-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-100 rounded-md mb-1"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg>
          Career
        </router-link>
        
        <router-link 
          to="/admin/careers/mapping" 
          class="flex items-center px-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-100 rounded-md mb-1"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
          </svg>
          Career Skill Mapping
        </router-link>
        
        <router-link 
          to="/admin/internships" 
          class="flex items-center px-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-100 rounded-md mb-1"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
          </svg>
          Internship
        </router-link>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
      <!-- Navbar -->
      <header class="bg-white shadow-sm z-10">
        <div class="flex items-center justify-between px-6 py-4">
          <div>
            <h2 class="text-xl font-semibold text-gray-800 capitalize">
              {{ $route.name.replace(/([A-Z])/g, ' $1').trim() }}
            </h2>
          </div>
          <div class="flex items-center space-x-4">
            <div class="relative">
              <button class="flex items-center space-x-2 focus:outline-none">
                <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center">
                  <span class="text-indigo-600 font-medium">{{ userInitial }}</span>
                </div>
                <span class="text-gray-700">{{ currentUser?.name }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
              </button>
            </div>
            <button @click="handleLogout" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200">
              Logout
            </button>
          </div>
        </div>
      </header>

      <!-- Content -->
      <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
        <slot />
      </main>

      <!-- Footer -->
      <footer class="bg-white border-t py-4 px-6 text-center text-sm text-gray-500">
        © {{ new Date().getFullYear() }} CareerMate AI. All rights reserved.
      </footer>
    </div>
  </div>
</template>

<script setup>
import { computed, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../stores/auth';

const router = useRouter();
const authStore = useAuthStore();

const currentUser = computed(() => authStore.user);

const userInitial = computed(() => {
  if (currentUser.value && currentUser.value.name) {
    return currentUser.value.name.charAt(0).toUpperCase();
  }
  return '?';
});

const handleLogout = async () => {
  await authStore.logout();
  router.push('/login');
};

onMounted(() => {
  if (!authStore.user) {
    authStore.getCurrentUser();
  }
});
</script>