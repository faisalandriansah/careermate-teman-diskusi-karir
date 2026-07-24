<template>
  <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-indigo-400 transition-colors duration-300">
    <input 
      type="file" 
      ref="fileInput"
      @change="handleFileChange"
      accept=".pdf,.doc,.docx"
      class="hidden"
    />
    
    <div class="flex flex-col items-center justify-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
      </svg>
      
      <h3 class="text-lg font-medium text-gray-900 mb-1">Upload your CV</h3>
      <p class="text-sm text-gray-500 mb-4">PDF, DOC, DOCX up to 5MB</p>
      
      <button
        @click="selectFile"
        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none"
      >
        Select File
      </button>
      
      <div v-if="fileName" class="mt-4 flex items-center text-sm text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        {{ fileName }}
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const fileInput = ref(null);
const fileName = ref('');

const emit = defineEmits(['file-selected']);

const selectFile = () => {
  fileInput.value.click();
};

const handleFileChange = (event) => {
  const file = event.target.files[0];
  if (file) {
    fileName.value = file.name;
    emit('file-selected', file);
  }
};

defineExpose({
  reset: () => {
    if (fileInput.value) {
      fileInput.value.value = '';
    }
    fileName.value = '';
  }
});
</script>