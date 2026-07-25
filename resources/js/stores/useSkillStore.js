import { defineStore } from "pinia";
import axios from "axios";

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
                const response = await axios.get("/api/skills");
                this.skills = response.data;
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
                const response = await axios.post("/api/skills", skillData);
                this.skills.push(response.data);
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
                const response = await axios.put(
                    `/api/skills/${id}`,
                    skillData,
                );

                const index = this.skills.findIndex((skill) => skill.id === id);
                if (index !== -1) {
                    this.skills[index] = response.data;
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
                await axios.delete(`/api/skills/${id}`);

                this.skills = this.skills.filter((skill) => skill.id !== id);
                this.loading = false;
            } catch (error) {
                this.error = error.message;
                this.loading = false;
                throw error;
            }
        },
    },
});

export default useSkillStore;
