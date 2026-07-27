import { defineStore } from "pinia";
import apiClient from "@/services/api";

export const useSkillStore = defineStore("skill", {
    state: () => ({
        skills: [],
        loading: false,
        error: null,
    }),

    getters: {
        getAllSkills: (state) => state.skills,
        getSkillById: (state) => (id) =>
            state.skills.find((skill) => skill.id === id),
    },

    actions: {
        async fetchSkills() {
            try {
                this.loading = true;

                const response = await apiClient.get("/admin/skills");

                this.skills = response.data.data ?? response.data;

                this.loading = false;
            } catch (error) {
                this.error = error.message;
                this.loading = false;
                throw error;
            }
        },

        async createSkill(skillData) {
            try {
                this.loading = true;

                const response = await apiClient.post(
                    "/admin/skills",
                    skillData
                );

                this.skills.push(response.data.data);

                this.loading = false;

                return response.data;
            } catch (error) {
                this.error = error.message;
                this.loading = false;
                throw error;
            }
        },

        async updateSkill(id, skillData) {
            try {
                this.loading = true;

                const response = await apiClient.put(
                    `/admin/skills/${id}`,
                    skillData
                );

                const index = this.skills.findIndex(
                    (skill) => skill.id === id
                );

                if (index !== -1) {
                    this.skills[index] = response.data.data;
                }

                this.loading = false;

                return response.data;
            } catch (error) {
                this.error = error.message;
                this.loading = false;
                throw error;
            }
        },

        async deleteSkill(id) {
            try {
                this.loading = true;

                await apiClient.delete(`/admin/skills/${id}`);

                this.skills = this.skills.filter(
                    (skill) => skill.id !== id
                );

                this.loading = false;
            } catch (error) {
                this.error = error.message;
                this.loading = false;
                throw error;
            }
        },
    },
});