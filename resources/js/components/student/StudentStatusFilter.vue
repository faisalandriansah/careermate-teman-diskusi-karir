<template>
  <select
    class="block w-full min-w-[150px] pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md"
    v-model="selectedStatus"
    @change="emitStatusFilter"
  >
    <option value="all">Semua Status</option>
    <option value="active">Aktif</option>
    <option value="pending">Pending</option>
    <option value="inactive">Non-Aktif</option>
  </select>
</template>

<script setup>
import { ref, defineEmits } from 'vue';

const emit = defineEmits(['status-filter-changed']);
const selectedStatus = ref('all');

const emitStatusFilter = () => {
  emit('status-filter-changed', selectedStatus.value);
};
</script>