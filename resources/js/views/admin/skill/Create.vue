<template>
  <div class="bg-white rounded-lg shadow p-6">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
      <h2 class="text-title-md2 font-semibold text-gray-800">Add New Skill</h2>
      <button 
        @click="$router.go(-1)" 
        class="flex items-center gap-2.5 rounded bg-gradient-to-r from-gray-500 to-gray-600 px-4 py-2 font-medium text-white hover:from-gray-600 hover:to-gray-700 transition-all duration-300"
      >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back
      </button>
    </div>

    <div class="rounded-lg border border-gray-200 bg-white shadow-lg">
      <div class="py-6 px-6 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
        <h4 class="text-xl font-semibold text-gray-800">Skill Details</h4>
      </div>
      
      <div class="p-6">
        <form @submit.prevent="handleSubmit">
          <div class="mb-6">
            <label class="mb-2.5 block text-gray-700">Skill Name</label>
            <input
              type="text"
              v-model="skill.name"
              placeholder="Enter skill name"
              class="w-full rounded-lg border-[1.5px] border-gray-300 bg-transparent py-3 px-4 text-gray-800 outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
            />
          </div>
          
          <div class="mb-6">
            <label class="mb-2.5 block text-gray-700">Description</label>
            <textarea
              v-model="skill.description"
              placeholder="Enter skill description"
              rows="4"
              class="w-full rounded-lg border-[1.5px] border-gray-300 bg-transparent py-3 px-4 text-gray-800 outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
            ></textarea>
          </div>
          
          <div class="mb-6">
            <label class="mb-2.5 block text-gray-700">Category</label>
            <select
              v-model="skill.category"
              class="w-full rounded-lg border-[1.5px] border-gray-300 bg-transparent py-3 px-4 text-gray-800 outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
            >
              <option value="">Select category</option>
              <option value="technical">Technical</option>
              <option value="soft-skill">Soft Skill</option>
              <option value="leadership">Leadership</option>
              <option value="communication">Communication</option>
            </select>
          </div>
          
          <div class="flex justify-end gap-4">
            <button
              type="button"
              @click="$router.go(-1)"
              class="flex items-center gap-2.5 rounded bg-gradient-to-r from-gray-500 to-gray-600 px-6 py-3 font-medium text-white hover:from-gray-600 hover:to-gray-700 transition-all duration-300"
            >
              Cancel
            </button>
            <button
              type="submit"
              class="flex items-center gap-2.5 rounded bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-3 font-medium text-white hover:from-blue-600 hover:to-indigo-700 transition-all duration-300"
            >
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useSkillStore } from '@/stores/useSkillStore';

const router = useRouter();
const skillStore = useSkillStore();

const skill = ref({
  name: '',
  description: '',
  category: ''
});

const handleSubmit = async () => {
  try {
    await skillStore.createSkill(skill.value);
    router.push('/admin/skill');
  } catch (error) {
    console.error('Error creating skill:', error);
  }
};
</script>