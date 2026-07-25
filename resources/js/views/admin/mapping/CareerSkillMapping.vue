<template>
  <div class="space-y-6">
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
      <div class="mb-6">
        <h2 class="text-xl font-semibold text-slate-900">Career-Skill Mapping</h2>
        <p class="mt-1 text-sm text-slate-500">Hubungkan skill dengan karier yang relevan.</p>
      </div>

      <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
          <h3 class="mb-3 font-semibold text-slate-900">Select Career</h3>
          <select v-model="selectedCareer" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500">
            <option value="">Choose a career</option>
            <option value="software-engineer">Software Engineer</option>
            <option value="data-analyst">Data Analyst</option>
            <option value="project-manager">Project Manager</option>
          </select>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
          <h3 class="mb-3 font-semibold text-slate-900">Select Skills</h3>
          <div class="max-h-60 space-y-2 overflow-y-auto pr-2">
            <label v-for="skill in skills" :key="skill.id" class="flex items-center rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700">
              <input v-model="selectedSkills" :value="skill.id" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500" />
              <span class="ml-2">{{ skill.name }}</span>
            </label>
          </div>
        </div>
      </div>

      <div class="mt-6 flex justify-end">
        <button @click="saveMapping" class="rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
          Save Mapping
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const selectedCareer = ref('');
const selectedSkills = ref([]);
const skills = ref([
  { id: 1, name: 'JavaScript' },
  { id: 2, name: 'Python' },
  { id: 3, name: 'Data Analysis' },
  { id: 4, name: 'Project Management' },
  { id: 5, name: 'Communication' },
  { id: 6, name: 'Leadership' },
]);

const saveMapping = () => {
  console.log('Mapping saved:', { career: selectedCareer.value, skills: selectedSkills.value });
};
</script>