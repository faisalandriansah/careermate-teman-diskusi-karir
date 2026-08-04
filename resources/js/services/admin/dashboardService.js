import apiClient from "@/services/api";

export default {
    getDashboardData() {
        return apiClient.get("/admin/dashboard");
    },
};
