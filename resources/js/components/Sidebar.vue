<template>
  <aside 
    :class="[
      'fixed md:static left-0 top-0 z-999 h-screen w-72 border-r border-stroke bg-white duration-300 ease-linear dark:border-strokedark dark:bg-boxdark',
      sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'
    ]"
  >
    <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
      <router-link to="/admin/dashboard" class="flex items-center gap-2">
        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
        </svg>
        <span class="text-xl font-bold text-slate-800">CareerMateAI</span>
      </router-link>
    </div>
    
    <div class="flex flex-col overflow-y-auto duration-300 ease-linear h-[calc(100vh-74px)]">
      <nav class="px-4 py-2">
        <div class="mb-4">
          <h3 class="text-sm font-medium text-bodydark2 uppercase mb-2">Main Menu</h3>
          <ul class="space-y-1">
            <li>
              <router-link 
                to="/admin/dashboard" 
                class="flex items-center gap-2.5 rounded-lg px-4 py-2 text-bodymedium text-slate-700 hover:bg-primary hover:text-white transition-colors duration-200"
                active-class="bg-primary text-white"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                </svg>
                Dashboard
              </router-link>
            </li>
          </ul>
        </div>
        
        <div class="mb-4">
          <h3 class="text-sm font-medium text-bodydark2 uppercase mb-2">Data Management</h3>
          <ul class="space-y-1">
            <li>
              <router-link 
                to="/admin/skill" 
                class="flex items-center gap-2.5 rounded-lg px-4 py-2 text-bodymedium text-slate-700 hover:bg-primary hover:text-white transition-colors duration-200"
                active-class="bg-primary text-white"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Skills
              </router-link>
            </li>
            <li>
              <router-link 
                to="/admin/career" 
                class="flex items-center gap-2.5 rounded-lg px-4 py-2 text-bodymedium text-slate-700 hover:bg-primary hover:text-white transition-colors duration-200"
                active-class="bg-primary text-white"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Careers
              </router-link>
            </li>
            <li>
              <router-link 
                to="/admin/internship" 
                class="flex items-center gap-2.5 rounded-lg px-4 py-2 text-bodymedium text-slate-700 hover:bg-primary hover:text-white transition-colors duration-200"
                active-class="bg-primary text-white"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                </svg>
                Internships
              </router-link>
            </li>
            <li>
              <router-link 
                to="/admin/mapping" 
                class="flex items-center gap-2.5 rounded-lg px-4 py-2 text-bodymedium text-slate-700 hover:bg-primary hover:text-white transition-colors duration-200"
                active-class="bg-primary text-white"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                </svg>
                Career-Skill Mapping
              </router-link>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </aside>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

defineProps({
  sidebarOpen: {
    type: Boolean,
    default: false
  }
});

defineEmits(['toggle-sidebar']);
</script>