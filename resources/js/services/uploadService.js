import { useApi } from '@/services/api';

export const uploadService = {
  // Upload CV
  async uploadCV(file, onUploadProgress = null) {
    const formData = new FormData();
    formData.append('cv', file);

    try {
      const response = await useApi().post('/upload-cv', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        },
        onUploadProgress: onUploadProgress
      });
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Get uploaded CV files
  async getUploadedFiles(params = {}) {
    try {
      const response = await useApi().get('/cv-files', params);
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Delete CV file
  async deleteCVFile(id) {
    try {
      const response = await useApi().delete(`/cv-files/${id}`);
      return response.data;
    } catch (error) {
      throw error;
    }
  }
};