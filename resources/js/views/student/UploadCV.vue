<template>
  <div>
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Upload CV</h1>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
          <h2 class="text-lg leading-6 font-medium text-gray-900">Upload Your CV</h2>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">Upload your resume/CV for career matching analysis</p>
        </div>
        <div class="border-t border-gray-200 p-6">
          <UploadBox @file-selected="handleFileSelected" ref="uploadBoxRef" />
          
          <div v-if="selectedFile" class="mt-6">
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                </svg>
                <span>{{ selectedFile.name }}</span>
              </div>
              <button 
                @click="removeFile" 
                class="text-red-600 hover:text-red-900"
              >
                Remove
              </button>
            </div>
            
            <div class="mt-6">
              <button
                @click="uploadFile"
                :disabled="uploading || !selectedFile"
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none disabled:opacity-50"
              >
                <span v-if="uploading">
                  <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  Uploading...
                </span>
                <span v-else>
                  Upload CV
                </span>
              </button>
            </div>
          </div>
          
          <ProgressBar 
            v-if="uploadProgress > 0" 
            :progress="uploadProgress" 
            :status="uploadStatus" 
          />
        </div>
      </div>
      
      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
          <h2 class="text-lg leading-6 font-medium text-gray-900">Instructions</h2>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">How to prepare your CV for best results</p>
        </div>
        <div class="border-t border-gray-200 p-6">
          <div class="space-y-4">
            <div class="flex items-start">
              <div class="flex-shrink-0 h-5 w-5 rounded-full bg-indigo-100 flex items-center justify-center mt-0.5">
                <div class="h-2 w-2 rounded-full bg-indigo-600"></div>
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">Supported Formats</p>
                <p class="mt-1 text-sm text-gray-500">Upload your CV in PDF, DOC, or DOCX format</p>
              </div>
            </div>
            
            <div class="flex items-start">
              <div class="flex-shrink-0 h-5 w-5 rounded-full bg-indigo-100 flex items-center justify-center mt-0.5">
                <div class="h-2 w-2 rounded-full bg-indigo-600"></div>
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">File Size Limit</p>
                <p class="mt-1 text-sm text-gray-500">Maximum file size is 5MB</p>
              </div>
            </div>
            
            <div class="flex items-start">
              <div class="flex-shrink-0 h-5 w-5 rounded-full bg-indigo-100 flex items-center justify-center mt-0.5">
                <div class="h-2 w-2 rounded-full bg-indigo-600"></div>
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">Include Key Information</p>
                <p class="mt-1 text-sm text-gray-500">Make sure your CV includes education, work experience, and skills</p>
              </div>
            </div>
            
            <div class="flex items-start">
              <div class="flex-shrink-0 h-5 w-5 rounded-full bg-indigo-100 flex items-center justify-center mt-0.5">
                <div class="h-2 w-2 rounded-full bg-indigo-600"></div>
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">Analysis Process</p>
                <p class="mt-1 text-sm text-gray-500">After upload, our system will analyze your skills and match them to suitable careers</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div v-if="error" class="mt-6 bg-red-50 border border-red-200 rounded-md p-4">
      <div class="flex">
        <div class="flex-shrink-0">
          <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
          </svg>
        </div>
        <div class="ml-3">
          <h3 class="text-sm font-medium text-red-800">{{ error }}</h3>
        </div>
      </div>
    </div>
    
    <div v-if="successMessage" class="mt-6 bg-green-50 border border-green-200 rounded-md p-4">
      <div class="flex">
        <div class="flex-shrink-0">
          <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
          </svg>
        </div>
        <div class="ml-3">
          <h3 class="text-sm font-medium text-green-800">{{ successMessage }}</h3>
          <div class="mt-2">
            <router-link 
              :to="`/student/result/${uploadedAnalysisId}`"
              class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none"
            >
              View Analysis
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import UploadBox from '@/components/upload/UploadBox.vue';
import ProgressBar from '@/components/upload/ProgressBar.vue';
import { uploadService } from '@/services/uploadService';
import { analysisService } from '@/services/analysisService';

const router = useRouter();
const uploadBoxRef = ref(null);
const selectedFile = ref(null);
const uploading = ref(false);
const uploadProgress = ref(0);
const uploadStatus = ref('');
const error = ref('');
const successMessage = ref('');
const uploadedAnalysisId = ref(null);

const handleFileSelected = (file) => {
  selectedFile.value = file;
  error.value = '';
  successMessage.value = '';
  uploadedAnalysisId.value = null;
};

const removeFile = () => {
  selectedFile.value = null;
  uploadBoxRef.value.reset();
  error.value = '';
  successMessage.value = '';
  uploadedAnalysisId.value = null;
};

const uploadFile = async () => {
  if (!selectedFile.value) {
    error.value = 'Please select a file first';
    return;
  }

  uploading.value = true;
  error.value = '';
  uploadProgress.value = 0;
  uploadStatus.value = 'Starting upload...';

  try {
    const result = await uploadService.uploadCV(
      selectedFile.value,
      (progressEvent) => {
        const progress = Math.round((progressEvent.loaded * 100) / progressEvent.total);
        uploadProgress.value = progress;
        uploadStatus.value = `Uploading... ${progress}%`;
      }
    );

    // Perform career matching after successful upload
    successMessage.value = 'CV uploaded successfully! Analyzing your skills now...';
    
    // Get the CV file ID from the upload response
    const cvFileId = result.cv_file.id;
    
    // Perform career matching
    const analysisResult = await analysisService.performCareerMatching(cvFileId);
    
    // Update success message and store analysis ID
    successMessage.value = 'CV analyzed successfully! Click the button below to view your results.';
    uploadedAnalysisId.value = analysisResult.id;
    
  } catch (err) {
    console.error('Upload error:', err);
    let errorMessage = 'An error occurred while uploading or analyzing the file.';
    
    if (err.response?.data?.message) {
      errorMessage = err.response.data.message;
    } else if (err.response?.data?.errors) {
      errorMessage = Object.values(err.response.data.errors)[0][0];
    }
    
    error.value = errorMessage;
  } finally {
    uploading.value = false;
    uploadProgress.value = 0;
    uploadStatus.value = '';
  }
};
</script>