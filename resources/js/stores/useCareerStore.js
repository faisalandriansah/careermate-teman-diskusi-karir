import { defineStore } from "pinia";
import apiClient from "@/services/api";

export const useCareerStore = defineStore("career", {
    state: () => ({
        careers: [],
        loading: false,
        error: null,
    }),

    getters: {
        getAllCareers: (state) => state.careers,
        getCareerById: (state) => (id) =>
            state.careers.find((career) => career.id === id),
    },

    actions: {
        async fetchCareers() {
            try {
                this.loading = true;
                const response = await apiClient.get("/admin/careers");
                this.careers = response.data.data ?? response.data;
                this.loading = false;
            } catch (error) {
                this.error = error.message;
                this.loading = false;
                throw error;
            }
        },

        async createCareer(careerData) {
            try {
                this.loading = true;
                const response = await apiClient.post(
                    "/admin/careers",
                    careerData,
                );

                this.careers.push(response.data.data);
                this.loading = false;
                return response.data;
            } catch (error) {
                this.error = error.message;
                this.loading = false;
                throw error;
            }
        },

        async updateCareer(id, careerData) {
            try {
                this.loading = true;
                const response = await apiClient.put(
                    `/admin/careers/${id}`,
                    careerData,
                );

                const index = this.careers.findIndex(
                    (career) => career.id === id,
                );
                if (index !== -1) {
                    this.careers[index] = response.data.data;
                }

                this.loading = false;
                return response.data;
            } catch (error) {
                this.error = error.message;
                this.loading = false;
                throw error;
            }
        },

        async deleteCareer(id) {
            try {
                this.loading = true;
                await apiClient.delete(`/admin/careers/${id}`);

                this.careers = this.careers.filter(
                    (career) => career.id !== id,
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
