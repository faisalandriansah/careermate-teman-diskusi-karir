import apiClient from "@/services/api";

export default {
    async getResult(analysisId) {
        const { data } = await apiClient.get(`student/analysis/${analysisId}`);
        return data;
    },

    async getHistory() {
        const { data } = await apiClient.get("student/analysis/history");
        return data;
    },
    async getLatest() {
        const { data } = await apiClient.get("student/analysis/latest");
        return data;
    },

    async getResult(analysisId) {
        const { data } = await apiClient.get(`student/analysis/${analysisId}`); // khusus download pdf
        return data;
    },

    getPdfUrl(analysisId) {
        return `${apiClient.defaults.baseURL}/student/analysis/${analysisId}/pdf`; 
    },
};
