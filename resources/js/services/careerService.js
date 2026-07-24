import { useApi } from './api';

export const careerService = {
  // Get all careers
  async getCareers(params = {}) {
    try {
      const response = await useApi().get('/careers', params);
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Get single career
  async getCareer(id) {
    try {
      const response = await useApi().get(`/careers/${id}`);
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Create career
  async createCareer(data) {
    try {
      const response = await useApi().post('/careers', data);
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Update career
  async updateCareer(id, data) {
    try {
      const response = await useApi().put(`/careers/${id}`, data);
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Delete career
  async deleteCareer(id) {
    try {
      const response = await useApi().delete(`/careers/${id}`);
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Get skills for mapping
  async getSkills() {
    try {
      const response = await useApi().get('/skills');
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Get career skills mapping
  async getCareerSkills(careerId) {
    try {
      const response = await useApi().get(`/careers/${careerId}/skills`);
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Map skills to career
  async mapSkillsToCareer(careerId, skillIds) {
    try {
      const response = await useApi().post(`/careers/${careerId}/skills`, { 
        skill_ids: Array.isArray(skillIds) ? skillIds : [skillIds] 
      });
      return response.data;
    } catch (error) {
      throw error;
    }
  }
};