import { defineStore } from "pinia";
import apiClient from "@/services/api";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        token: localStorage.getItem("token") || null,
        user: JSON.parse(localStorage.getItem("user") || "null"),
        isProfileComplete:
            localStorage.getItem("is_profile_complete") === "1",
    }),

    getters: {
        isAuthenticated: (state) => !!state.token,
        userRole: (state) => state.user?.role ?? null,
    },

    actions: {
        login(token, user) {
            this.token = token;
            this.user = user;
            this.isProfileComplete = user?.student_profile ? user.student_profile.university && user.student_profile.major && user.student_profile.semester && user.student_profile.phone : false;

            localStorage.setItem("token", token);
            localStorage.setItem("user", JSON.stringify(user));
            localStorage.setItem(
                "is_profile_complete",
                this.isProfileComplete ? "1" : "0",
            );
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
            localStorage.setItem(
                "is_profile_complete",
                this.isProfileComplete ? "1" : "0",
            );
        },

        logout() {
            this.token = null;
            this.user = null;
            this.isProfileComplete = false;

            localStorage.removeItem("token");
            localStorage.removeItem("user");
            localStorage.removeItem("is_profile_complete");
        },
    },
});
