import apiClient from "./api";

export default {
    getDashboardData() {
        return apiClient.get("/admin/dashboard");
    },
};
