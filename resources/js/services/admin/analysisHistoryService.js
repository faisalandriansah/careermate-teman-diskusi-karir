import apiClient from "@/services/api";

export const analysisHistoryService = {
    getHistory(params = {}) {
        return apiClient.get(`/admin/analysis/history`, { params });
    },
};