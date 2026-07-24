import { defineStore } from 'pinia';
import { useApi } from '../services/api';

export const useCareerStore = defineStore('career', {
  state: () => ({
    careers: [],
    career: null,
    skills: [],
    internships: [],
    careerSkills: [],
    loading: false,
    error: null
  }),

  actions: {
    async getCareers(params = {}) {
      this.loading = true;
      try {
        const response = await useApi().get('/careers', params);
        this.careers = response.data.data || response.data;
        return response.data;
      } catch (error) {
        console.error('Get careers error:', error);
        this.error = error.message;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async getCareer(id) {
      this.loading = true;
      try {
        const response = await useApi().get(`/careers/${id}`);
        this.career = response.data;
        return response.data;
      } catch (error) {
        console.error('Get career error:', error);
        this.error = error.message;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async createCareer(data) {
      this.loading = true;
      try {
        const response = await useApi().post('/careers', data);
        this.careers.push(response.data);
        return response.data;
      } catch (error) {
        console.error('Create career error:', error);
        this.error = error.message;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async updateCareer(id, data) {
      this.loading = true;
      try {
        const response = await useApi().put(`/careers/${id}`, data);
        const index = this.careers.findIndex(career => career.id === id);
        if (index !== -1) {
          this.careers[index] = response.data;
        }
        this.career = response.data;
        return response.data;
      } catch (error) {
        console.error('Update career error:', error);
        this.error = error.message;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async deleteCareer(id) {
      this.loading = true;
      try {
        await useApi().delete(`/careers/${id}`);
        this.careers = this.careers.filter(career => career.id !== id);
      } catch (error) {
        console.error('Delete career error:', error);
        this.error = error.message;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async getSkills() {
      this.loading = true;
      try {
        const response = await useApi().get('/skills');
        this.skills = response.data.data || response.data;
        return response.data;
      } catch (error) {
        console.error('Get skills error:', error);
        this.error = error.message;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async getSkill(id) {
      this.loading = true;
      try {
        const response = await useApi().get(`/skills/${id}`);
        return response.data;
      } catch (error) {
        console.error('Get skill error:', error);
        this.error = error.message;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async createSkill(data) {
      this.loading = true;
      try {
        const response = await useApi().post('/skills', data);
        // Add the new skill to the skills array if it exists
        if (this.skills) {
          this.skills.push(response.data);
        }
        return response.data;
      } catch (error) {
        console.error('Create skill error:', error);
        this.error = error.message;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async updateSkill(id, data) {
      this.loading = true;
      try {
        const response = await useApi().put(`/skills/${id}`, data);
        // Update the skill in the skills array if it exists
        const index = this.skills.findIndex(skill => skill.id === id);
        if (index !== -1) {
          this.skills[index] = response.data;
        }
        return response.data;
      } catch (error) {
        console.error('Update skill error:', error);
        this.error = error.message;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async deleteSkill(id) {
      this.loading = true;
      try {
        await useApi().delete(`/skills/${id}`);
        // Remove the skill from the skills array if it exists
        this.skills = this.skills.filter(skill => skill.id !== id);
      } catch (error) {
        console.error('Delete skill error:', error);
        this.error = error.message;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async getCareerSkills(careerId) {
      this.loading = true;
      try {
        const response = await useApi().get(`/careers/${careerId}/skills`);
        this.careerSkills = response.data.data || response.data;
        return response.data;
      } catch (error) {
        console.error('Get career skills error:', error);
        this.error = error.message;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async mapSkillsToCareer(careerId, skillIds) {
      this.loading = true;
      try {
        const response = await useApi().post(`/careers/${careerId}/skills`, { skill_ids: skillIds });
        this.careerSkills = response.data.data || response.data;
        return response.data;
      } catch (error) {
        console.error('Map skills to career error:', error);
        this.error = error.message;
        throw error;
      } finally {
        this.loading = false;
      }
    }
  }
});