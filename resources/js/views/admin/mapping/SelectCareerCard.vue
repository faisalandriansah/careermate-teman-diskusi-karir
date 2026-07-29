<template>
  <div class="h-full rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
    <h2 class="mb-1 text-base font-semibold text-slate-900">Select Career</h2>
    <p class="mb-4 text-sm text-slate-500">Pilih career target untuk dipetakan skill-nya.</p>

    <select
      :value="selectedCareer"
      @change="$emit('select', $event.target.value)"
      class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
    >
      <option value="">Choose a career</option>
      <option v-for="career in careers" :key="career.id" :value="career.id">
        {{ career.name }}
      </option>
    </select>

    <div v-if="activeCareer" class="mt-5 space-y-4">
      <div class="rounded-xl border border-blue-100 bg-blue-50 p-4">
        <h3 class="text-sm font-semibold text-blue-900">{{ activeCareer.name }}</h3>
        <p class="mt-1 text-sm leading-relaxed text-blue-700">{{ activeCareer.description }}</p>
      </div>

      <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
        <span class="text-sm font-medium text-slate-600">Mapped Skills</span>
        <span class="rounded-full bg-blue-600 px-3 py-1 text-xs font-semibold text-white">
          {{ mappedCount }} skill{{ mappedCount === 1 ? '' : 's' }}
        </span>
      </div>
    </div>

    <div v-else class="mt-5 rounded-xl border border-dashed border-slate-200 p-4 text-center text-sm text-slate-400">
      Belum ada career yang dipilih
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  careers: { type: Array, required: true },
  selectedCareer: { type: String, default: '' },
  mappedCount: { type: Number, default: 0 },
});

defineEmits(['select']);

const activeCareer = computed(() =>
  props.careers.find((c) => c.id === props.selectedCareer)
);
</script>