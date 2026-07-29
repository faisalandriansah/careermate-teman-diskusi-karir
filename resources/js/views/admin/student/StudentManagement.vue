<template>
  <div class="px-4 py-4 sm:px-6 lg:px-8">
    <!-- Page Header -->
    <div class="mb-6 flex items-center gap-3">
      <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600/10 text-blue-600">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4" />
        </svg>
      </div>
      <div>
        <h1 class="text-xl font-bold text-slate-900 sm:text-2xl">Manajemen Mahasiswa</h1>
        <p class="mt-0.5 text-sm text-slate-500">
          Kelola data mahasiswa dan pantau aktivitas mereka di platform CareerMate
        </p>
      </div>
    </div>

    <StudentTable />
  </div>
</template>

<script setup>
import StudentTable from '../../../components/StudentTable.vue';
</script>