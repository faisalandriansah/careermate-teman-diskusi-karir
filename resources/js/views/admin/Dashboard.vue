<template>
  <div class="space-y-6">
    <!-- Header -->
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
      <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
          <p class="text-sm font-medium text-blue-600">CareerMate Admin</p>
          <h1 class="mt-1 text-2xl font-semibold text-slate-900">Halo, Admin</h1>
          <p class="mt-2 text-sm text-slate-500">Selamat datang kembali di CareerMate. Ini ringkasan sistem hari ini.</p>
        </div>
        <div class="flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 text-sm font-medium text-slate-600">
          <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
          Live monitoring
        </div>
      </div>
    </div>

    <!-- Ringkasan Sistem -->
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
      <div v-for="item in summary" :key="item.title" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
        <div class="flex items-start justify-between">
          <div>
            <p class="text-sm font-medium text-slate-500">{{ item.title }}</p>
            <p class="mt-2 text-3xl font-semibold text-slate-900">{{ item.value }}</p>
            <p class="mt-1 text-xs font-medium" :class="item.trend >= 0 ? 'text-emerald-600' : 'text-red-500'">
              {{ item.trend >= 0 ? '+' : '' }}{{ item.trend }}% bulan ini
            </p>
          </div>
          <div :class="item.iconBg" class="rounded-2xl p-3">
            <svg class="h-6 w-6" :class="item.iconColor" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path v-for="path in item.paths" :key="path" :d="path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Statistik Penggunaan + Grafik Career Recommendation -->
    <div class="grid gap-6 xl:grid-cols-[1.15fr_0.85fr]">
      <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
        <div class="mb-4 flex items-center justify-between">
          <div>
            <h2 class="text-lg font-semibold text-slate-900">Statistik Penggunaan</h2>
            <p class="text-sm text-slate-500">Aktivitas upload CV dan analisis mahasiswa.</p>
          </div>
          <span class="rounded-full bg-blue-50 px-3 py-1 text-sm font-medium text-blue-700">This month</span>
        </div>
        <div class="space-y-4">
          <div v-for="item in usageStats" :key="item.label" class="rounded-xl border border-slate-100 bg-slate-50 p-4">
            <div class="mb-2 flex items-center justify-between text-sm">
              <span class="font-medium text-slate-700">{{ item.label }}</span>
              <span class="font-semibold text-slate-900">{{ item.value }} <span class="font-normal text-slate-400">({{ item.percent }}%)</span></span>
            </div>
            <div class="h-2.5 rounded-full bg-slate-200">
              <div class="h-2.5 rounded-full transition-all duration-300" :class="item.color" :style="{ width: `${item.percent}%` }"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
        <div class="mb-4 flex items-center justify-between">
          <div>
            <h2 class="text-lg font-semibold text-slate-900">Career Recommendation</h2>
            <p class="text-sm text-slate-500">Distribusi hasil rekomendasi.</p>
          </div>
          <span class="rounded-full bg-violet-50 px-3 py-1 text-sm font-medium text-violet-700">Summary</span>
        </div>
        <div class="flex flex-col items-center gap-6">
          <div
            class="relative h-40 w-40 rounded-full"
            :style="{ background: donutGradient }"
          >
            <div class="absolute inset-3 flex flex-col items-center justify-center rounded-full bg-white">
              <p class="text-2xl font-semibold text-slate-900">{{ totalRecommendation }}</p>
              <p class="text-xs text-slate-500">Total</p>
            </div>
          </div>
          <div class="w-full space-y-2">
            <div v-for="slice in careerDistribution" :key="slice.label" class="flex items-center justify-between text-sm">
              <div class="flex items-center gap-2">
                <span class="h-2.5 w-2.5 rounded-full" :style="{ backgroundColor: slice.color }"></span>
                <span class="font-medium text-slate-700">{{ slice.label }}</span>
              </div>
              <span class="text-slate-500">{{ slice.value }}%</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Skill Terpopuler + Aktivitas Terbaru -->
    <div class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
      <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
        <div class="mb-4 flex items-center justify-between">
          <h2 class="text-lg font-semibold text-slate-900">Skill Terpopuler</h2>
          <span class="rounded-full bg-emerald-50 px-3 py-1 text-sm font-medium text-emerald-700">Top 3</span>
        </div>
        <div class="space-y-4">
          <div v-for="skill in popularSkills" :key="skill.name" class="rounded-xl border border-slate-100 bg-slate-50 p-4">
            <div class="mb-2 flex items-center justify-between text-sm">
              <span class="font-medium text-slate-700">{{ skill.name }}</span>
              <span class="text-slate-500">{{ skill.count }} mahasiswa</span>
            </div>
            <div class="h-2.5 rounded-full bg-slate-200">
              <div class="h-2.5 rounded-full bg-blue-500" :style="{ width: `${skill.percent}%` }"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
        <div class="mb-4 flex items-center justify-between">
          <h2 class="text-lg font-semibold text-slate-900">Aktivitas Terbaru</h2>
          <span class="rounded-full bg-amber-50 px-3 py-1 text-sm font-medium text-amber-700">Fresh</span>
        </div>
        <div class="space-y-3">
          <div v-for="activity in recentActivities" :key="activity.title" class="rounded-xl border border-slate-100 bg-slate-50 px-4 py-3">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-slate-800">{{ activity.title }}</p>
              <span class="text-xs text-slate-400">{{ activity.time }}</span>
            </div>
            <p class="mt-1 text-sm text-slate-500">{{ activity.detail }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Akses Cepat -->
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
      <div class="mb-4">
        <h2 class="text-lg font-semibold text-slate-900">Akses Cepat</h2>
        <p class="text-sm text-slate-500">Tindakan yang sering digunakan.</p>
      </div>
      <div class="grid gap-3 md:grid-cols-2 xl:grid-cols-4">
        <button
          v-for="action in quickActions"
          :key="action.title"
          class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white p-4 text-left transition hover:border-blue-300 hover:shadow-[0_8px_30px_rgba(15,23,42,0.06)]"
        >
          <div :class="action.iconBg" class="rounded-xl p-2.5">
            <svg class="h-5 w-5" :class="action.iconColor" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path v-for="path in action.paths" :key="path" :d="path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
            </svg>
          </div>
          <span class="text-sm font-semibold text-slate-800">{{ action.title }}</span>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const summary = [
  { title: 'Mahasiswa', value: '412', trend: 6, iconBg: 'bg-blue-50', iconColor: 'text-blue-600', paths: ['M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'] },
  { title: 'Skill', value: '58', trend: 3, iconBg: 'bg-emerald-50', iconColor: 'text-emerald-600', paths: ['M13 10V3L4 14h7v7l9-11h-7z'] },
  { title: 'Karier', value: '76', trend: 4, iconBg: 'bg-violet-50', iconColor: 'text-violet-600', paths: ['M20 7h-3V5a2 2 0 00-2-2H9a2 2 0 00-2 2v2H4a1 1 0 00-1 1v3a2 2 0 002 2h14a2 2 0 002-2V8a1 1 0 00-1-1zM9 5h6v2H9V5zM3 13v6a2 2 0 002 2h14a2 2 0 002-2v-6H3z'] },
  { title: 'Magang', value: '134', trend: -2, iconBg: 'bg-amber-50', iconColor: 'text-amber-600', paths: ['M12 14l9-5-9-5-9 5 9 5zM12 14l6.16-3.42A12.083 12.083 0 0112 21a12.083 12.083 0 01-6.16-10.42L12 14z'] },
]

const usageStats = [
  { label: 'Sudah Upload CV', value: '287', percent: 84, color: 'bg-emerald-500' },
  { label: 'Belum Upload', value: '125', percent: 37, color: 'bg-amber-500' },
  { label: 'Total Analisis', value: '341', percent: 100, color: 'bg-blue-500' },
]

const careerDistribution = [
  { label: 'Frontend Developer', value: 42, color: '#3b82f6' },
  { label: 'Data Analyst', value: 28, color: '#10b981' },
  { label: 'UI/UX Designer', value: 30, color: '#8b5cf6' },
]

const totalRecommendation = '341'

const donutGradient = computed(() => {
  let cumulative = 0
  const stops = careerDistribution.map((slice) => {
    const start = cumulative
    cumulative += slice.value
    return `${slice.color} ${start}% ${cumulative}%`
  })
  return `conic-gradient(${stops.join(', ')})`
})

const popularSkills = [
  { name: 'Laravel', count: 186, percent: 90 },
  { name: 'PHP', count: 164, percent: 78 },
  { name: 'MySQL', count: 141, percent: 68 },
]

const recentActivities = [
  { title: 'Upload CV', detail: 'Ahmad Fauzi mengunggah CV baru', time: '12 menit lalu' },
  { title: 'Registrasi', detail: 'Mahasiswa baru mendaftar', time: '45 menit lalu' },
  { title: 'Analisis selesai', detail: 'Hasil rekomendasi karier telah dibuat', time: '1 jam lalu' },
]

const quickActions = [
  { title: 'Tambah Skill', iconBg: 'bg-blue-50', iconColor: 'text-blue-600', paths: ['M12 4v16m8-8H4'] },
  { title: 'Tambah Career', iconBg: 'bg-emerald-50', iconColor: 'text-emerald-600', paths: ['M20 7h-3V5a2 2 0 00-2-2H9a2 2 0 00-2 2v2H4a1 1 0 00-1 1v3a2 2 0 002 2h14a2 2 0 002-2V8a1 1 0 00-1-1z'] },
  { title: 'Tambah Magang', iconBg: 'bg-amber-50', iconColor: 'text-amber-600', paths: ['M12 14l9-5-9-5-9 5 9 5z'] },
  { title: 'Career Mapping', iconBg: 'bg-violet-50', iconColor: 'text-violet-600', paths: ['M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7'] },
]
</script>