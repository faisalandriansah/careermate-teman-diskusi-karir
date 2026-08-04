import { defineStore } from "pinia";
import apiClient from "@/services/api";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        token: localStorage.getItem("token") || null,
        user: JSON.parse(localStorage.getItem("user") || "null"),
        isProfileComplete: false,
    }),

    getters: {
        isAuthenticated: (state) => !!state.token,
        userRole: (state) => state.user?.role ?? null,
    },

    actions: {
        login(token, user) {
            this.token = token;
            this.user = user;

            localStorage.setItem("token", token);
            localStorage.setItem("user", JSON.stringify(user));
        },

        setUser(user) {
            this.user = user;
            localStorage.setItem("user", JSON.stringify(user));
        },

        async fetchMe() {
            const { data } = await apiClient.get("/auth/me");
            this.user = data.data;
            this.isProfileComplete = data.is_profile_complete;
            localStorage.setItem("user", JSON.stringify(data.data));
        },

        logout() {
            this.token = null;
            this.user = null;
            this.isProfileComplete = false;

            localStorage.removeItem("token");
            localStorage.removeItem("user");
        },
    },
});
