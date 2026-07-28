import { defineStore } from "pinia";
import apiClient from "@/services/api";

export const useInternshipStore = defineStore("internship", {
    state: () => ({
        internships: [],
        loading: false,
        error: null,
    }),

    getters: {
        getAllInternships: (state) => state.internships,
        getInternshipById: (state) => (id) =>
            state.internships.find((internship) => internship.id === id),
    },

    actions: {
        async fetchInternships() {
            try {
                this.loading = true;
                const response = await apiClient.get("/admin/internships");
                this.internships = response.data.data ?? response.data;
                this.loading = false;
            } catch (error) {
                this.error = error.message;
                this.loading = false;
                throw error;
            }
        },

        async createInternship(internshipData) {
            try {
                this.loading = true;
                const response = await apiClient.post(
                    "/admin/internships",
                    internshipData,
                );
                this.internships.push(response.data.data);
                this.loading = false;
                return response.data;
            } catch (error) {
                this.error = error.message;
                this.loading = false;
                throw error;
            }
        },

        async updateInternship(id, internshipData) {
            try {
                this.loading = true;
                const response = await apiClient.put(
                    `/admin/internships/${id}`,
                    internshipData,
                );

                const index = this.internships.findIndex(
                    (internship) => internship.id === id,
                );
                if (index !== -1) {
                    this.internships[index] = response.data;
                }

                this.loading = false;
                return response.data;
            } catch (error) {
                this.error = error.message;
                this.loading = false;
                throw error;
            }
        },

        async deleteInternship(id) {
            try {
                this.loading = true;
                await apiClient.delete(`/admin/internships/${id}`);

                this.internships = this.internships.filter(
                    (internship) => internship.id !== id,
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
