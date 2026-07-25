import { defineStore } from "pinia";
import axios from "axios";

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
                const response = await axios.get("/api/careers");
                this.careers = response.data;
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
                const response = await axios.post("/api/careers", careerData);
                this.careers.push(response.data);
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
                const response = await axios.put(
                    `/api/careers/${id}`,
                    careerData,
                );

                const index = this.careers.findIndex(
                    (career) => career.id === id,
                );
                if (index !== -1) {
                    this.careers[index] = response.data;
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
                await axios.delete(`/api/careers/${id}`);

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

export default useCareerStore;
