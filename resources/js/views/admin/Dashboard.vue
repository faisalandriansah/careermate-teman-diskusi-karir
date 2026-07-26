<template>
  <div class="space-y-6">
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
      <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
          <p class="text-sm font-medium text-blue-600">Admin Control Center</p>
          <h1 class="mt-1 text-2xl font-semibold text-slate-900">Dashboard Admin</h1>
          <p class="mt-2 text-sm text-slate-500">Pantau performa sistem, aktivitas terbaru, dan tugas prioritas dari satu tempat.</p>
        </div>
        <div class="flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 text-sm font-medium text-slate-600">
          <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
          Live monitoring
        </div>
      </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
      <div v-for="stat in stats" :key="stat.title" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
        <div class="flex items-start justify-between">
          <div>
            <p class="text-sm font-medium text-slate-500">{{ stat.title }}</p>
            <p class="mt-2 text-3xl font-semibold text-slate-900">{{ stat.value }}</p>
          </div>
          <div :class="stat.iconBg" class="rounded-2xl p-3">
            <svg class="h-6 w-6" :class="stat.iconColor" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path v-for="path in stat.paths" :key="path" :d="path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
            </svg>
          </div>
        </div>
      </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-[1.15fr_0.85fr]">
      <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
        <div class="mb-4 flex items-center justify-between">
          <div>
            <h2 class="text-lg font-semibold text-slate-900">Kinerja Sistem</h2>
            <p class="text-sm text-slate-500">Tren aktivitas utama dalam periode terakhir.</p>
          </div>
          <span class="rounded-full bg-blue-50 px-3 py-1 text-sm font-medium text-blue-700">This month</span>
        </div>
        <div class="space-y-4">
          <div v-for="item in performanceBars" :key="item.label" class="rounded-xl border border-slate-100 bg-slate-50 p-4">
            <div class="mb-2 flex items-center justify-between text-sm">
              <span class="font-medium text-slate-700">{{ item.label }}</span>
              <span class="font-semibold text-slate-900">{{ item.value }}%</span>
            </div>
            <div class="h-2.5 rounded-full bg-slate-200">
              <div class="h-2.5 rounded-full transition-all duration-300" :class="item.color" :style="{ width: `${item.value}%` }"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
        <div class="mb-4 flex items-center justify-between">
          <div>
            <h2 class="text-lg font-semibold text-slate-900">Aktivitas Terbaru</h2>
            <p class="text-sm text-slate-500">Riwayat tindakan yang paling baru dilakukan.</p>
          </div>
          <span class="rounded-full bg-emerald-50 px-3 py-1 text-sm font-medium text-emerald-700">Fresh</span>
        </div>
        <div class="space-y-3">
          <div v-for="activity in recentActivities" :key="activity.title" class="rounded-xl border border-slate-100 bg-slate-50 px-4 py-3">
            <p class="text-sm font-medium text-slate-800">{{ activity.title }}</p>
            <p class="mt-1 text-sm text-slate-500">{{ activity.detail }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-[1.15fr_0.85fr]">
      <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
        <div class="mb-4 flex items-center justify-between">
          <h2 class="text-lg font-semibold text-slate-900">Prioritas Tugas</h2>
          <span class="rounded-full bg-amber-50 px-3 py-1 text-sm font-medium text-amber-700">Needs review</span>
        </div>
        <div class="grid gap-3 md:grid-cols-3">
          <div v-for="task in priorityTasks" :key="task.title" class="rounded-xl border border-slate-200 bg-white p-4">
            <p class="text-sm font-semibold text-slate-800">{{ task.title }}</p>
            <p class="mt-2 text-sm text-slate-500">{{ task.description }}</p>
          </div>
        </div>
      </div>

      <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
        <div class="mb-4 flex items-center justify-between">
          <h2 class="text-lg font-semibold text-slate-900">Insight Singkat</h2>
          <span class="rounded-full bg-violet-50 px-3 py-1 text-sm font-medium text-violet-700">Summary</span>
        </div>
        <div class="space-y-3">
          <div v-for="insight in insights" :key="insight.title" class="rounded-xl border border-slate-100 bg-slate-50 p-4">
            <div class="flex items-center justify-between">
              <p class="text-sm font-semibold text-slate-800">{{ insight.title }}</p>
              <span class="text-sm font-medium text-slate-600">{{ insight.value }}</span>
            </div>
            <p class="mt-2 text-sm text-slate-500">{{ insight.description }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const stats = [
  {
    title: 'Total Users',
    value: '1.248',
    iconBg: 'bg-blue-50',
    iconColor: 'text-blue-600',
    paths: ['M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z']
  },
  {
    title: 'Active Matches',
    value: '326',
    iconBg: 'bg-emerald-50',
    iconColor: 'text-emerald-600',
    paths: ['M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z']
  },
  {
    title: 'Pending Review',
    value: '24',
    iconBg: 'bg-amber-50',
    iconColor: 'text-amber-600',
    paths: ['M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z']
  },
  {
    title: 'Completed Assessments',
    value: '89',
    iconBg: 'bg-violet-50',
    iconColor: 'text-violet-600',
    paths: ['M5 13l4 4L19 7', 'M5 7h14']
  }
]

const performanceBars = [
  { label: 'User Engagement', value: 84, color: 'bg-blue-500' },
  { label: 'Career Matching', value: 76, color: 'bg-emerald-500' },
  { label: 'Skill Completion', value: 71, color: 'bg-violet-500' },
  { label: 'Admin Response', value: 68, color: 'bg-amber-500' }
]

const recentActivities = [
  { title: 'Career list updated', detail: 'Frontend Developer diperbarui • 10 menit lalu' },
  { title: 'New skill mapping added', detail: '3 mapping baru disetujui • 1 jam lalu' },
  { title: 'Internship review completed', detail: '2 data internship ditinjau • 2 jam lalu' }
]

const priorityTasks = [
  { title: 'Tambah data karier', description: '8 entri masih perlu deskripsi yang lebih lengkap.' },
  { title: 'Validasi mapping skill', description: 'Beberapa mapping menunggu approval final.' },
  { title: 'Perbarui archive internship', description: 'Posting lama perlu disegarkan segera.' }
]

const insights = [
  { title: 'Kebutuhan skill tertinggi', value: 'Frontend', description: 'Topik paling sering dicari oleh pengguna.' },
  { title: 'Aktivitas hari ini', value: '+18%', description: 'Peningkatan interaksi dibandingkan hari sebelumnya.' },
  { title: 'Status review', value: 'Healthy', description: 'Proses review berjalan lancar dan konsisten.' }
]
</script>