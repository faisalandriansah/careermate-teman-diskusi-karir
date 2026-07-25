<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Simple header for student layout -->
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <router-link to="/student/dashboard" class="flex items-center gap-2">
              <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
              </svg>
              <span class="text-xl font-bold text-slate-800">CareerMate</span>
            </router-link>
          </div>
          <div class="flex items-center">
            <div class="relative ml-3">
              <div class="flex items-center gap-2">
                <span class="text-sm font-medium text-gray-700">Student User</span>
                <span class="h-8 w-8 rounded-full">
                  <img 
                    src="https://ui-avatars.com/api/?name=Student+User&background=10B981&color=fff" 
                    alt="User"
                    class="rounded-full"
                  />
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Content -->
    <main>
      <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <router-view />
      </div>
    </main>
  </div>
</template>

<script setup>
// Komponen layout student sederhana
</script>