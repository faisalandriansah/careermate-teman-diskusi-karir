import { defineStore } from 'pinia';
import { useApi } from '../services/api';

export const useAnalysisStore = defineStore('analysis', {
  state: () => ({
    analysisResults: [],
    currentResult: null,
    roadmap: null,
    summary: '',
    loading: false,
    error: null
  }),

  actions: {
    async performCareerMatching(cvFileId) {
      this.loading = true;
      try {
        const response = await useApi().post('/analyze-cv', { cv_file_id: cvFileId });
        this.currentResult = response.data;
        this.analysisResults.unshift(response.data);
        return response.data;
      } catch (error) {
        console.error('Career matching error:', error);
        this.error = error.message;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async generateRoadmap({ careerTitle, ownedSkills, skillGap }) {
      this.loading = true;
      try {
        const response = await useApi().post('/generate-roadmap', {
          career_title: careerTitle,
          owned_skills: ownedSkills,
          skill_gap: skillGap
        });
        this.roadmap = response.data.roadmap;
        this.summary = response.data.summary;
        return response.data;
      } catch (error) {
        console.error('Generate roadmap error:', error);
        this.error = error.message;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async getAnalysisHistory() {
      this.loading = true;
      try {
        const response = await useApi().get('/analysis-results');
        this.analysisResults = response.data.data || response.data;
        return response.data;
      } catch (error) {
        console.error('Get analysis history error:', error);
        this.error = error.message;
        throw error;
      } finally {
        this.loading = false;
      }
    }
  }
});