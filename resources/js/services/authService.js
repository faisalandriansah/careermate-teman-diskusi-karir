import { useApi } from './api';

export const authService = {
  // Login user
  async login(credentials) {
    try {
      const response = await useApi().post('/login', credentials);
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Logout user
  async logout() {
    try {
      const response = await useApi().post('/logout');
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Get current user
  async getCurrentUser() {
    try {
      const response = await useApi().get('/user');
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Check if user is authenticated
  isAuthenticated() {
    return !!localStorage.getItem('token');
  },

  // Get stored token
  getToken() {
    return localStorage.getItem('token');
  },

  // Set token
  setToken(token) {
    localStorage.setItem('token', token);
  },

  // Remove token
  removeToken() {
    localStorage.removeItem('token');
  }
};