<template>
  <div class="bg-white rounded-md shadow-sm p-6 border">
    <h2 class="text-xl font-semibold mb-4">My Profile</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div class="md:col-span-1 flex items-center">
        <img :src="avatar" alt="avatar" class="h-24 w-24 rounded-full" />
      </div>
      <div class="md:col-span-2">
        <p class="text-sm text-gray-600">Name</p>
        <p class="text-lg font-medium text-gray-800 mb-3">Student User</p>

        <p class="text-sm text-gray-600">Email</p>
        <p class="text-base text-gray-800 mb-3">student@example.com</p>

        <p class="text-sm text-gray-600">Education</p>
        <p class="text-base text-gray-800 mb-3">Bachelor in Computer Science</p>

        <p class="text-sm text-gray-600">Bio</p>
        <p class="text-base text-gray-800">A motivated student exploring data and software engineering careers.</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import useAuthStore from '@/stores/useAuthStore';
const auth = useAuthStore();
const avatar = computed(() => {
  if (auth.user && auth.user.avatar) return auth.user.avatar;
  return 'https://ui-avatars.com/api/?name=Student+User&background=10B981&color=fff';
});
</script>
