import apiClient from "@/services/api";

export const getInternships = (page = 1) => {
    return apiClient.get(`/admin/internships?page=${page}`);
};

export const getInternship = (id) => {
    return apiClient.get(`/admin/internships/${id}`);
};

export const createInternship = (data) => {
    return apiClient.post(`/admin/internships`, data);
};

export const updateInternship = (id, data) => {
    return apiClient.put(`/admin/internships/${id}`, data);
};

export const deleteInternship = (id) => {
    return apiClient.delete(`/admin/internships/${id}`);
};
