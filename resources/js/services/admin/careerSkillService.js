import apiClient from "@/services/api";

export default {
    getCareerSkills(careerId) {
        return apiClient.get(`/admin/careers/${careerId}/skills`);
    },
    saveCareerSkills(careerId, skills) {
        return apiClient.put(`/admin/careers/${careerId}/skills`, { skills });
    },
};