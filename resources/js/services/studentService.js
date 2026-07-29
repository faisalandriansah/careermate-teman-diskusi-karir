import apiClient from "./api";

export const studentService = {
    getAll(params = {}) {
        return apiClient.get(`/admin/students`, { params });
    },
    getById(id) {
        return apiClient.get(`/admin/students/${id}`);
    },
    delete(id) {
        return apiClient.delete(`/admin/students/${id}`);
    },
};
