<template>
  <div class="space-y-6">
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
      <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
        <div>
          <p class="text-sm font-medium text-blue-600">Overview</p>
          <h1 class="mt-1 text-2xl font-semibold text-slate-900">Dashboard</h1>
          <p class="mt-2 text-sm text-slate-500">Ringkasan data utama untuk manajemen karier dan skill.</p>
        </div>
        <div class="rounded-full bg-slate-100 px-3 py-1 text-sm font-medium text-slate-600">Live data</div>
      </div>
    </div>

    <div class="grid gap-4 md:grid-cols-3">
      <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
        <div class="flex items-start justify-between">
          <div>
            <p class="text-sm font-medium text-slate-500">Skills</p>
            <p class="mt-2 text-3xl font-semibold text-slate-900">12</p>
          </div>
          <div class="rounded-2xl bg-blue-50 p-3 text-blue-600">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          </div>
        </div>
      </div>

      <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
        <div class="flex items-start justify-between">
          <div>
            <p class="text-sm font-medium text-slate-500">Careers</p>
            <p class="mt-2 text-3xl font-semibold text-slate-900">8</p>
          </div>
          <div class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          </div>
        </div>
      </div>

      <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
        <div class="flex items-start justify-between">
          <div>
            <p class="text-sm font-medium text-slate-500">Internships</p>
            <p class="mt-2 text-3xl font-semibold text-slate-900">5</p>
          </div>
          <div class="rounded-2xl bg-violet-50 p-3 text-violet-600">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
          </div>
        </div>
      </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-[1.25fr_0.75fr]">
      <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
        <div class="mb-4 flex items-center justify-between">
          <h2 class="text-lg font-semibold text-slate-900">Top Skills</h2>
          <span class="rounded-full bg-slate-100 px-3 py-1 text-sm text-slate-600">Recommended</span>
        </div>
        <div class="space-y-3">
          <div class="flex items-center justify-between rounded-xl bg-slate-50 px-4 py-3">
            <div>
              <h3 class="font-medium text-slate-800">JavaScript</h3>
              <p class="text-sm text-slate-500">Popular for web development</p>
            </div>
            <span class="rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-700">85%</span>
          </div>
          <div class="flex items-center justify-between rounded-xl bg-slate-50 px-4 py-3">
            <div>
              <h3 class="font-medium text-slate-800">Python</h3>
              <p class="text-sm text-slate-500">Highly requested for AI/ML</p>
            </div>
            <span class="rounded-full bg-emerald-100 px-3 py-1 text-sm font-medium text-emerald-700">78%</span>
          </div>
          <div class="flex items-center justify-between rounded-xl bg-slate-50 px-4 py-3">
            <div>
              <h3 class="font-medium text-slate-800">Communication</h3>
              <p class="text-sm text-slate-500">Essential for teamwork</p>
            </div>
            <span class="rounded-full bg-violet-100 px-3 py-1 text-sm font-medium text-violet-700">72%</span>
          </div>
        </div>
      </div>

      <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
        <div class="mb-4 flex items-center justify-between">
          <h2 class="text-lg font-semibold text-slate-900">Recent Activity</h2>
          <span class="rounded-full bg-blue-50 px-3 py-1 text-sm font-medium text-blue-700">Today</span>
        </div>
        <div class="space-y-3">
          <div class="rounded-xl border border-slate-100 bg-slate-50 px-4 py-3">
            <p class="text-sm font-medium text-slate-800">New career added</p>
            <p class="mt-1 text-sm text-slate-500">Frontend Developer • 10 minutes ago</p>
          </div>
          <div class="rounded-xl border border-slate-100 bg-slate-50 px-4 py-3">
            <p class="text-sm font-medium text-slate-800">Skill mapping updated</p>
            <p class="mt-1 text-sm text-slate-500">3 skill links refreshed • 1 hour ago</p>
          </div>
          <div class="rounded-xl border border-slate-100 bg-slate-50 px-4 py-3">
            <p class="text-sm font-medium text-slate-800">Internship list reviewed</p>
            <p class="mt-1 text-sm text-slate-500">2 entries checked • 2 hours ago</p>
          </div>
        </div>
      </div>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
      <div class="mb-4 flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-900">Priority Updates</h2>
        <span class="rounded-full bg-amber-50 px-3 py-1 text-sm font-medium text-amber-700">Needs attention</span>
      </div>
      <div class="grid gap-3 md:grid-cols-3">
        <div class="rounded-xl border border-slate-200 bg-white p-4">
          <p class="text-sm font-semibold text-slate-800">Add more career data</p>
          <p class="mt-2 text-sm text-slate-500">8 entries still need richer descriptions.</p>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-4">
          <p class="text-sm font-semibold text-slate-800">Review skill mappings</p>
          <p class="mt-2 text-sm text-slate-500">Several mappings need final approval.</p>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-4">
          <p class="text-sm font-semibold text-slate-800">Refresh internship archive</p>
          <p class="mt-2 text-sm text-slate-500">Old postings should be updated soon.</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// Placeholder dashboard
</script>