<template>
  <div class="space-y-6">
    <div class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)] sm:flex-row sm:items-center sm:justify-between">
      <div>
        <p class="text-sm font-medium text-blue-600">Data Management</p>
        <h2 class="mt-1 text-2xl font-semibold text-slate-900">Edit Skill</h2>
        <p class="mt-2 text-sm text-slate-500">Perbarui informasi skill dengan desain yang lebih bersih.</p>
      </div>
      <button
        @click="router.go(-1)"
        class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
      >
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back
      </button>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)]">
      <form @submit.prevent="handleSubmit" class="space-y-5">
        <div>
          <label class="mb-2 block text-sm font-medium text-slate-700">Skill Name</label>
          <input
            type="text"
            v-model="skill.name"
            placeholder="Enter skill name"
            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
          />
        </div>

        <div>
          <label class="mb-2 block text-sm font-medium text-slate-700">Description</label>
          <textarea
            v-model="skill.description"
            placeholder="Enter skill description"
            rows="4"
            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
          ></textarea>
        </div>

        <div>
          <label class="mb-2 block text-sm font-medium text-slate-700">Category</label>
          <select
            v-model="skill.category"
            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
          >
            <option value="">Select category</option>
            <option value="technical">Technical</option>
            <option value="soft-skill">Soft Skill</option>
            <option value="leadership">Leadership</option>
            <option value="communication">Communication</option>
          </select>
        </div>

        <div class="flex justify-end gap-3 pt-2">
          <button
            type="button"
            @click="router.go(-1)"
            class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
          >
            Cancel
          </button>
          <button
            type="submit"
            class="rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:from-blue-700 hover:to-cyan-600"
          >
            Update
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { useSkillStore } from '@/stores/useSkillStore';

const router = useRouter();
const route = useRoute();
const skillStore = useSkillStore();

const skill = ref({
  name: '',
  description: '',
  category: ''
});

onMounted(async () => {
  try {
    const skillId = route.params.id;
    const skillData = skillStore.getSkillById(parseInt(skillId));
    if (skillData) {
      skill.value = { ...skillData };
    }
  } catch (error) {
    console.error('Error fetching skill:', error);
  }
});

const handleSubmit = async () => {
  try {
    const skillId = route.params.id;
    await skillStore.updateSkill(parseInt(skillId), skill.value);
    router.push('/admin/skill');
  } catch (error) {
    console.error('Error updating skill:', error);
  }
};
</script>