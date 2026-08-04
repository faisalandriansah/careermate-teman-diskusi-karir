import apiClient from "@/services/api";

export default {
    async getProfile() {
        const { data } = await apiClient.get("student/profile");
        return data;
    },

    async updateProfile(payload) {
        const { data } = await apiClient.put("student/profile", payload);
        return data;
    },
}; 