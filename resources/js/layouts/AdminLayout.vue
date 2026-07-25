<template>
  <div class="min-h-screen bg-[#f8fafc] text-slate-800">
    <div class="flex min-h-screen">
      <aside
        :class="[
          'fixed inset-y-0 left-0 z-30 w-72 border-r border-slate-200 bg-white text-slate-700 shadow-[0_0_30px_rgba(15,23,42,0.06)] transition duration-200 lg:translate-x-0',
          sidebarOpen ? 'translate-x-0' : '-translate-x-full'
        ]"
      >
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">
          <router-link to="/admin/dashboard" class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-blue-600 to-cyan-500 text-white shadow-sm">
              <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
              </svg>
            </div>
            <span class="text-lg font-semibold tracking-wide">CareerMate</span>
          </router-link>
        </div>

        <div class="flex h-[calc(100vh-72px)] flex-col overflow-y-auto px-4 py-5">
          <div class="mb-6">
            <p class="mb-3 text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-400">Main Menu</p>
            <ul class="space-y-1">
              <li>
                <router-link
                  to="/admin/dashboard"
                  class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"
                  active-class="bg-blue-50 text-blue-700 shadow-sm"
                >
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                  </svg>
                  Dashboard
                </router-link>
              </li>
            </ul>
          </div>

          <div>
            <p class="mb-3 text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-400">Data Management</p>
            <ul class="space-y-1">
              <li>
                <router-link
                  to="/admin/skill"
                  class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"
                  active-class="bg-blue-50 text-blue-700 shadow-sm"
                >
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  Skills
                </router-link>
              </li>
              <li>
                <router-link
                  to="/admin/career"
                  class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"
                  active-class="bg-blue-50 text-blue-700 shadow-sm"
                >
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                  </svg>
                  Careers
                </router-link>
              </li>
              <li>
                <router-link
                  to="/admin/internship"
                  class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"
                  active-class="bg-blue-50 text-blue-700 shadow-sm"
                >
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                  </svg>
                  Internships
                </router-link>
              </li>
              <li>
                <router-link
                  to="/admin/mapping"
                  class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"
                  active-class="bg-blue-50 text-blue-700 shadow-sm"
                >
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                  </svg>
                  Mapping
                </router-link>
              </li>
            </ul>
          </div>
        </div>
      </aside>

      <div class="flex-1 lg:ml-72">
        <header class="sticky top-0 z-20 border-b border-slate-200 bg-white/90 backdrop-blur">
          <div class="flex items-center justify-between gap-3 px-4 py-4 sm:px-6 lg:px-8">
            <button
              class="rounded-xl border border-slate-200 p-2 text-slate-600 transition hover:bg-slate-100 lg:hidden"
              @click="toggleSidebar"
            >
              <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
            </button>

            <div class="flex flex-1 items-center gap-2 sm:gap-3">
              <div class="hidden flex-1 items-center rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 shadow-sm sm:flex">
                <svg class="mr-2 h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input
                  type="text"
                  placeholder="Search"
                  class="w-full border-0 bg-transparent text-sm text-slate-600 outline-none placeholder:text-slate-400"
                />
              </div>
              <div class="ml-auto flex items-center gap-2 sm:gap-3">
                <div class="rounded-full bg-blue-50 px-3 py-1 text-sm font-medium text-blue-700">Admin Panel</div>
                <div class="flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5 shadow-sm">
                  <div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-sm font-semibold text-white">A</div>
                  <div class="text-sm">
                    <p class="font-semibold text-slate-800">Administrator</p>
                    <p class="text-xs text-slate-500">CareerMate</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">
          <router-view />
        </main>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const sidebarOpen = ref(true);

const toggleSidebar = () => {
  sidebarOpen.value = !sidebarOpen.value;
};
</script>