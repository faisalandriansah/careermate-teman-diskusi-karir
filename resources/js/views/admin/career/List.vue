<template>
  <div class="space-y-6">
    <div class="flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)] sm:flex-row sm:items-center sm:justify-between">
      <div>
        <h2 class="text-xl font-semibold text-slate-900">Careers Management</h2>
        <p class="mt-1 text-sm text-slate-500">Kelola daftar karier yang tersedia dalam sistem.</p>
      </div>
      <button
        @click="$router.push('/admin/career/create')"
        class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
      >
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Add New Career
      </button>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
      <div class="mb-4 flex items-center justify-between">
        <h3 class="text-lg font-semibold text-slate-900">List of Careers</h3>
        <span class="rounded-full bg-slate-100 px-3 py-1 text-sm text-slate-600">3 items</span>
      </div>

      <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        <div v-for="career in careers" :key="career.id" class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
          <div class="flex items-start justify-between gap-3">
            <div>
              <h4 class="font-semibold text-slate-900">{{ career.title }}</h4>
              <p class="mt-1 text-sm text-slate-500">{{ career.description }}</p>
            </div>
            <div class="flex gap-2">
              <button class="rounded-full p-2 text-blue-600 transition hover:bg-blue-100" @click="$router.push(`/admin/career/${career.id}/edit`)">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
              </button>
              <button class="rounded-full p-2 text-rose-600 transition hover:bg-rose-100">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 01 16.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const careers = ref([
  { id: 1, title: 'Software Engineer', description: 'Develops software solutions' },
  { id: 2, title: 'Data Analyst', description: 'Analyzes complex datasets' },
  { id: 3, title: 'UX Designer', description: 'Designs user experience' },
]);
</script>