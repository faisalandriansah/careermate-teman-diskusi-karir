import { defineStore } from 'pinia';
import { useApi } from '../services/api';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: localStorage.getItem('token') || null,
    user: null,
    loading: false
  }),

  getters: {
    isAuthenticated: (state) => !!state.token
  },

  actions: {
    async login(credentials) {
      this.loading = true;
      try {
        const response = await useApi().post('/login', credentials);
        const { token, user } = response.data;

        this.token = token;
        this.user = user;
        
        // Simpan token di localStorage
        localStorage.setItem('token', token);

        // Set header authorization untuk permintaan selanjutnya
        useApi().defaults.headers.common['Authorization'] = `Bearer ${token}`;
        
        return { success: true, user };
      } catch (error) {
        console.error('Login error:', error);
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async logout() {
      try {
        await useApi().post('/logout');
      } catch (error) {
        console.error('Logout error:', error);
      } finally {
        this.token = null;
        this.user = null;
        localStorage.removeItem('token');
        delete useApi().defaults.headers.common['Authorization'];
      }
    },

    async getCurrentUser() {
      if (!this.token) return null;

      try {
        const response = await useApi().get('/user');
        this.user = response.data;
        return response.data;
      } catch (error) {
        console.error('Get user error:', error);
        // Jika token tidak valid, lakukan logout
        if (error.response?.status === 401) {
          this.logout();
        }
        return null;
      }
    },

    setToken(token) {
      this.token = token;
      localStorage.setItem('token', token);
      useApi().defaults.headers.common['Authorization'] = `Bearer ${token}`;
    }
  }
});