<template>
  <div class="flex h-full flex-col rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
    <div class="mb-4 flex flex-wrap items-center justify-between gap-2">
      <div class="flex items-center gap-2.5">
        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-600/10 text-blue-600">
          <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a4.5 4.5 0 10-4.5 4.5c1 0 1.9-.35 2.62-.94l6.13 6.13a3 3 0 105.3-2.79M10.5 6a4.5 4.5 0 004.5 4.5c.66 0 1.28-.15 1.83-.42" />
          </svg>
        </div>
        <div>
          <h2 class="text-sm font-semibold text-slate-900">Select Skills</h2>
          <p class="text-xs text-slate-500">Pilih skill & atur bobotnya</p>
        </div>
      </div>
      <span class="rounded-full bg-blue-600/10 px-3 py-1 text-xs font-semibold text-blue-700">
        Selected {{ checkedCount }} / {{ skills.length }} Skills
      </span>
    </div>

    <div class="relative mb-4">
      <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
      </svg>
      <input
        v-model="search"
        type="text"
        :disabled="disabled"
        placeholder="Cari skill..."
        class="w-full rounded-xl border border-slate-300 bg-white py-2.5 pl-9 pr-4 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 disabled:bg-slate-50 disabled:text-slate-400"
      />
    </div>

    <!-- Disabled state: belum pilih career -->
    <div v-if="disabled" class="flex flex-1 flex-col items-center justify-center rounded-xl border border-dashed border-slate-200 bg-slate-50/50 py-14 text-center">
      <p class="text-sm font-medium text-slate-400">Pilih career terlebih dahulu untuk menampilkan daftar skill</p>
    </div>

    <!-- Loading skeleton -->
    <div v-else-if="loading" class="space-y-2">
      <div v-for="n in 6" :key="n" class="h-12 w-full animate-pulse rounded-xl bg-slate-100"></div>
    </div>

    <!-- Skill List -->
    <div v-else class="max-h-[380px] flex-1 space-y-2 overflow-y-auto pr-1">
      <div
        v-for="skill in filteredSkills"
        :key="skill.id"
        class="flex items-center justify-between gap-3 rounded-xl border px-3.5 py-2.5 transition"
        :class="skill.checked
          ? 'border-blue-200 bg-blue-50/70'
          : 'border-slate-200 bg-white hover:border-slate-300 hover:bg-slate-50'"
      >
        <label class="flex min-w-0 flex-1 cursor-pointer items-center gap-2.5">
          <input
            type="checkbox"
            :checked="skill.checked"
            @change="$emit('toggle', skill.id)"
            class="h-4 w-4 shrink-0 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
          />
          <span class="truncate text-sm font-medium text-slate-700">{{ skill.name }}</span>
        </label>

        <div class="flex shrink-0 items-center gap-1.5">
          <span class="text-[11px] font-medium text-slate-400">Weight</span>
          <input
            type="number"
            min="1"
            max="10"
            :value="skill.weight ?? 5"
            :disabled="!skill.checked"
            @input="$emit('weight-change', { id: skill.id, weight: clampWeight($event.target.value) })"
            class="w-[68px] rounded-lg border border-slate-300 bg-white px-2 py-1.5 text-center text-sm font-medium text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 disabled:cursor-not-allowed disabled:border-slate-200 disabled:bg-slate-100 disabled:text-slate-400"
          />
        </div>
      </div>

      <div v-if="filteredSkills.length === 0" class="flex flex-col items-center justify-center py-10 text-center">
        <svg class="mb-2 h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
        </svg>
        <p class="text-sm text-slate-400">Skill tidak ditemukan</p>
      </div>
    </div>

    <div class="mt-5 flex items-center justify-between gap-3 border-t border-slate-100 pt-4">
      <button
        type="button"
        :disabled="disabled || loading"
        @click="$emit('reset')"
        class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:bg-slate-50 active:scale-[0.98] disabled:cursor-not-allowed disabled:opacity-50"
      >
        Reset
      </button>
      <button
        type="button"
        :disabled="disabled || saving"
        @click="$emit('save')"
        class="rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 active:scale-[0.98] disabled:cursor-not-allowed disabled:bg-slate-300"
      >
        {{ saving ? 'Menyimpan...' : 'Save Mapping' }}
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
  skills: { type: Array, required: true },
  loading: { type: Boolean, default: false },
  saving: { type: Boolean, default: false },
  disabled: { type: Boolean, default: false },
});

defineEmits(['toggle', 'weight-change', 'reset', 'save']);

const search = ref('');

const filteredSkills = computed(() => {
  if (!search.value.trim()) return props.skills;
  const q = search.value.toLowerCase();
  return props.skills.filter((s) => s.name.toLowerCase().includes(q));
});

const checkedCount = computed(() => props.skills.filter((s) => s.checked).length);
const clampWeight = (val) => Math.min(10, Math.max(1, Number(val) || 1));
</script>