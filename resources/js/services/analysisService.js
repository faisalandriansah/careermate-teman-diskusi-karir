import { useApi } from '@/services/api';

export const analysisService = {
  // Perform career matching analysis
  async performCareerMatching(cvFileId) {
    try {
      const response = await useApi().post('/analyze-cv', { cv_file_id: cvFileId });
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Generate AI roadmap
  async generateRoadmap({ careerTitle, ownedSkills, skillGap }) {
    try {
      const response = await useApi().post('/generate-roadmap', {
        career_title: careerTitle,
        owned_skills: ownedSkills,
        skill_gap: skillGap
      });
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Get analysis history
  async getAnalysisHistory(params = {}) {
    try {
      const response = await useApi().get('/analysis-results', params);
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Get single analysis result
  async getAnalysisResult(id) {
    try {
      const response = await useApi().get(`/analysis-results/${id}`);
      return response.data;
    } catch (error) {
      throw error;
    }
  }
};