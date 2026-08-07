import apiClient from "@/services/api";

export default {
    async getResult(analysisId) {
        const { data } = await apiClient.get(`student/analysis/${analysisId}`);
        return data;
    },
    async getLatest() {
        const { data } = await apiClient.get("student/analysis/latest");
        return data;
    },
};
