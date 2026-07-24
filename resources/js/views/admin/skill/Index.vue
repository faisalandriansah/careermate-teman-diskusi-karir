<template>
  <div>
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-gray-900">Manage Skills</h1>
      <router-link
        to="/admin/skills/create"
        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none"
      >
        Add New Skill
      </router-link>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="px-4 py-5 sm:px-6">
        <h2 class="text-lg leading-6 font-medium text-gray-900">Skills List</h2>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">List of all available skills</p>
      </div>
      <div class="border-t border-gray-200">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="skill in skills" :key="skill.id">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ skill.id }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ skill.name }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ skill.description }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <router-link 
                    :to="`/admin/skills/${skill.id}/edit`" 
                    class="text-indigo-600 hover:text-indigo-900 mr-3"
                  >
                    Edit
                  </router-link>
                  <button 
                    @click="deleteSkill(skill.id)" 
                    class="text-red-600 hover:text-red-900"
                  >
                    Delete
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <!-- Loading indicator -->
    <div v-if="loading" class="flex justify-center py-10">
      <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-500"></div>
    </div>
    
    <!-- Empty state -->
    <div v-if="!loading && skills.length === 0" class="text-center py-10">
      <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
      </svg>
      <h3 class="mt-2 text-sm font-medium text-gray-900">No skills</h3>
      <p class="mt-1 text-sm text-gray-500">Get started by creating a new skill.</p>
      <div class="mt-6">
        <router-link
          to="/admin/skills/create"
          class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none"
        >
          Add New Skill
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useCareerStore } from '../../../stores/career';
import { useApi } from '../../../services/api';

const router = useRouter();
const careerStore = useCareerStore();

const skills = computed(() => careerStore.skills);
const loading = computed(() => careerStore.loading);

onMounted(() => {
  fetchSkills();
});

const fetchSkills = async () => {
  try {
    await careerStore.getSkills();
  } catch (error) {
    console.error('Error fetching skills:', error);
  }
};

const deleteSkill = async (id) => {
  if (confirm('Are you sure you want to delete this skill?')) {
    try {
      await useApi().delete(`/skills/${id}`);
      // Refresh the skills list
      await fetchSkills();
    } catch (error) {
      console.error('Error deleting skill:', error);
      alert('Failed to delete skill. Please try again.');
    }
  }
};
</script>