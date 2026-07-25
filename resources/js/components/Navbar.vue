<template>
  <header class="sticky top-0 z-99 flex w-full bg-white drop-shadow-1 dark:bg-boxdark">
    <div class="flex flex-grow items-center justify-between py-4 px-4 shadow-2 md:px-6 2xl:px-11">
      <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
        <!-- Mobile menu button -->
        <button 
          class="flex items-center justify-center rounded-md p-2 text-gray-700 hover:bg-gray-100 focus:outline-none"
          @click="$emit('toggle-sidebar')"
        >
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
        
        <div class="flex items-center gap-2">
          <router-link to="/admin/dashboard" class="flex items-center gap-2">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
            <span class="text-xl font-bold text-slate-800">CareerMate</span>
          </router-link>
        </div>
      </div>
      
      <div class="flex items-center gap-3 2xsm:gap-7">
        <ul class="flex items-center gap-2 2xsm:gap-4">
          <!-- Notification -->
          <li>
            <div class="relative">
              <button class="relative flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 dark:bg-meta-4 dark:hover:bg-meta-5">
                <svg class="fill-current duration-200 ease-in-out" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M18 8C18 6.4087 17.3679 4.88258 16.2426 3.75736C15.1174 2.63214 13.5913 2 12 2C10.4087 2 8.88258 2.63214 7.75736 3.75736C6.63214 4.88258 6 6.4087 6 8C6 15 3 16 3 16H21C21 16 18 15 18 8Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M13.73 21C13.5542 21.3031 13.3019 21.5547 12.9982 21.7295C12.6946 21.9044 12.3504 21.9965 12 21.9965C11.6496 21.9965 11.3054 21.9044 11.0018 21.7295C10.6982 21.5547 10.4458 21.3031 10.27 21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="absolute right-0 top-0 z-10 inline-flex h-4 w-4 items-center justify-center rounded-full bg-danger text-[10px] text-white">
                  3
                </span>
              </button>
            </div>
          </li>
          
          <!-- User Profile Dropdown -->
          <li>
            <div class="relative">
              <button class="flex items-center gap-2.5 rounded-full border border-stroke bg-white p-0.5 dark:border-strokedark dark:bg-meta-4">
                <span class="hidden text-right lg:block">
                  <span class="block text-sm font-medium text-black dark:text-white">Admin User</span>
                  <span class="block text-xs font-medium">Administrator</span>
                </span>
                <span class="h-10 w-10 rounded-full">
                  <img 
                    src="https://ui-avatars.com/api/?name=Admin+User&background=0D8ABC&color=fff" 
                    alt="User"
                    class="rounded-full"
                  />
                </span>
              </button>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </header>
</template>

<script setup>
// Definisikan emit untuk komunikasi ke parent component
defineEmits(['toggle-sidebar']);
</script>