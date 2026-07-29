<template>
  <div class="flex h-full flex-col rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
    <div class="mb-4 flex items-center gap-2.5">
      <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-600/10 text-blue-600">
        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>
      <div>
        <h2 class="text-sm font-semibold text-slate-900">Select Career</h2>
        <p class="text-xs text-slate-500">Pilih career target</p>
      </div>
    </div>

    <div v-if="loading" class="h-11 w-full animate-pulse rounded-xl bg-slate-100"></div>
    <select
      v-else
      :value="selectedCareer"
      @change="$emit('select', Number($event.target.value))"
      class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
    >
      <option value="">Choose a career</option>
      <option v-for="career in careers" :key="career.id" :value="career.id">
        {{ career.title }}
      </option>
    </select>

    <div v-if="activeCareer" class="mt-5 flex flex-1 flex-col">
      <div class="rounded-xl border border-blue-100 bg-gradient-to-br from-blue-50 to-blue-50/40 p-4">
        <div class="flex items-center gap-2">
          <svg class="h-4 w-4 shrink-0 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <h3 class="text-sm font-semibold text-blue-900">{{ activeCareer.title }}</h3>
        </div>
        <p v-if="activeCareer.description" class="mt-2 text-xs leading-relaxed text-blue-700/90">
          {{ activeCareer.description }}
        </p>
      </div>

      <div class="mt-4 grid grid-cols-2 gap-3">
        <div class="rounded-xl border border-slate-200 bg-slate-50 p-3.5 text-center">
          <p class="text-lg font-bold text-slate-900">{{ requiredSkillsCount }}</p>
          <p class="mt-0.5 text-[11px] font-medium uppercase tracking-wide text-slate-500">Required Skills</p>
        </div>
        <div class="rounded-xl border border-slate-200 bg-slate-50 p-3.5 text-center">
          <p class="text-lg font-bold text-slate-900">{{ averageWeight }}</p>
          <p class="mt-0.5 text-[11px] font-medium uppercase tracking-wide text-slate-500">Average Weight</p>
        </div>
      </div>
    </div>

    <div v-else class="mt-5 flex flex-1 flex-col items-center justify-center rounded-xl border border-dashed border-slate-200 bg-slate-50/50 px-4 py-10 text-center">
      <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>
      <p class="text-sm font-medium text-slate-500">Pilih career untuk mulai melakukan skill mapping</p>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  careers: { type: Array, required: true },
  selectedCareer: { type: [String, Number], default: '' },
  skills: { type: Array, default: () => [] },
  loading: { type: Boolean, default: false },
});

defineEmits(['select']);

const activeCareer = computed(() =>
  props.careers.find((c) => c.id === props.selectedCareer)
);

const checkedSkills = computed(() => props.skills.filter((s) => s.checked));
const requiredSkillsCount = computed(() => checkedSkills.value.length);

const averageWeight = computed(() => {
  if (checkedSkills.value.length === 0) return '0.0';
  const total = checkedSkills.value.reduce((sum, s) => sum + Number(s.weight || 0), 0);
  return (total / checkedSkills.value.length).toFixed(1);
});
</script>