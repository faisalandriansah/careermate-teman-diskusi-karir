<template>
  <div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center gap-3">
      <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600/10 text-blue-600">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M11 4a7 7 0 100 14 7 7 0 000-14zm9 17l-4.35-4.35" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 3.5a2 2 0 012 2M9 20.5a2 2 0 01-2-2" opacity="0" />
        </svg>
      </div>
      <div>
        <h1 class="text-xl font-bold text-slate-900 sm:text-2xl">Career-Skill Mapping</h1>
        <p class="mt-0.5 text-sm text-slate-500">Hubungkan skill dengan karier untuk rekomendasi CareerMate AI</p>
      </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-5">
      <div class="lg:col-span-2">
        <SelectCareerCard
          :careers="careers"
          :selected-career="selectedCareer"
          :mapped-skills="mappedSkills"
          @select="handleSelectCareer"
        />
      </div>

      <div class="lg:col-span-3">
        <SelectSkillsCard
          :skills="skills"
          :mapped-skills="mappedSkills"
          @toggle="handleToggleSkill"
          @weight-change="handleWeightChange"
          @reset="handleReset"
          @save="handleSave"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import SelectCareerCard from './SelectCareerCard.vue';
import SelectSkillsCard from './SelectSkillsCard.vue';

// Dummy data — nanti diganti GET /skills
const skills = ref([
  { id: 1, name: 'PHP' },
  { id: 2, name: 'Laravel' },
  { id: 3, name: 'CodeIgniter' },
  { id: 4, name: 'MySQL' },
  { id: 5, name: 'PostgreSQL' },
  { id: 6, name: 'Git' },
  { id: 7, name: 'Docker' },
  { id: 8, name: 'REST API' },
  { id: 9, name: 'Vue.js' },
  { id: 10, name: 'React' },
  { id: 11, name: 'JavaScript' },
  { id: 12, name: 'Python' },
  { id: 13, name: 'HTML' },
  { id: 14, name: 'CSS' },
  { id: 15, name: 'Linux' },
  { id: 16, name: 'Communication' },
  { id: 17, name: 'Problem Solving' },
  { id: 18, name: 'Project Management' },
]);

// Dummy data — nanti diganti GET /careers
const careers = ref([
  {
    id: 'backend-developer',
    name: 'Backend Developer',
    description: 'Merancang dan membangun logika server, API, serta integrasi database untuk mendukung aplikasi.',
    defaultSkills: [
      { id: 1, weight: 10 },
      { id: 2, weight: 10 },
      { id: 4, weight: 9 },
      { id: 6, weight: 8 },
      { id: 7, weight: 7 },
      { id: 8, weight: 9 },
    ],
  },
  { id: 'frontend-developer', name: 'Frontend Developer', description: 'Membangun antarmuka pengguna yang interaktif, responsif, dan mudah digunakan.', defaultSkills: [] },
  { id: 'fullstack-developer', name: 'Full Stack Developer', description: 'Menguasai pengembangan sisi client maupun server dalam satu alur kerja penuh.', defaultSkills: [] },
  { id: 'ai-engineer', name: 'AI Engineer', description: 'Mengembangkan dan mengimplementasikan model machine learning ke dalam sistem produksi.', defaultSkills: [] },
  { id: 'data-analyst', name: 'Data Analyst', description: 'Mengolah dan menganalisis data untuk menghasilkan insight yang mendukung pengambilan keputusan.', defaultSkills: [] },
]);

const selectedCareer = ref('');
const mappedSkills = ref([]); // [{ id, weight }] — nanti diisi dari GET /careers/{id}/skills

const handleSelectCareer = (careerId) => {
  selectedCareer.value = careerId;
  const career = careers.value.find((c) => c.id === careerId);
  mappedSkills.value = career?.defaultSkills ? career.defaultSkills.map((s) => ({ ...s })) : [];
};

const handleToggleSkill = (skillId) => {
  const exists = mappedSkills.value.find((s) => s.id === skillId);
  if (exists) {
    mappedSkills.value = mappedSkills.value.filter((s) => s.id !== skillId);
  } else {
    mappedSkills.value.push({ id: skillId, weight: 5 });
  }
};

const handleWeightChange = ({ id, weight }) => {
  const target = mappedSkills.value.find((s) => s.id === id);
  if (target) target.weight = weight;
};

const handleReset = () => {
  const career = careers.value.find((c) => c.id === selectedCareer.value);
  mappedSkills.value = career?.defaultSkills ? career.defaultSkills.map((s) => ({ ...s })) : [];
};

const handleSave = () => {
  // nanti diganti POST /careers/{id}/skills
  console.log('Mapping saved:', { career: selectedCareer.value, skills: mappedSkills.value });
};
</script>