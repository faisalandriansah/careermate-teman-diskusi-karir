import { defineStore } from 'pinia';

export default defineStore('auth', {
  state: () => ({
    user: null,
    isAuthenticated: false,
    token: localStorage.getItem('token') || null,
  }),

  getters: {
    getUser: (state) => state.user,
    isLoggedIn: (state) => !!state.token,
  },

  actions: {
    setToken(token) {
      this.token = token;
      localStorage.setItem('token', token);
    },

    clearToken() {
      this.token = null;
      this.user = null;
      this.isAuthenticated = false;
      localStorage.removeItem('token');
    },

    setUser(user) {
      this.user = user;
      this.isAuthenticated = true;
    },

    logout() {
      this.clearToken();
    },
  },
});