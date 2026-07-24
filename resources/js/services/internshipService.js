import { useApi } from './api';

export const internshipService = {
  // Get all internships
  async getInternships(params = {}) {
    try {
      const response = await useApi().get('/internships', params);
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Get single internship
  async getInternship(id) {
    try {
      const response = await useApi().get(`/internships/${id}`);
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Create internship
  async createInternship(data) {
    try {
      const response = await useApi().post('/internships', data);
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Update internship
  async updateInternship(id, data) {
    try {
      const response = await useApi().put(`/internships/${id}`, data);
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Delete internship
  async deleteInternship(id) {
    try {
      const response = await useApi().delete(`/internships/${id}`);
      return response.data;
    } catch (error) {
      throw error;
    }
  }
};