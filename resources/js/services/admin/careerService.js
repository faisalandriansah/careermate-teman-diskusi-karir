import apiClient from "@/services/api";

export const getCareers = (page = 1) => {
    return apiClient.get(`/admin/careers?page=${page}`);
};

export const getCareer = (id) => {
    return apiClient.get(`/admin/careers/${id}`);
};

export const createCareer = (data) => {
    return apiClient.post(`/admin/careers`, data);
};

export const updateCareer = (id, data) => {
    return apiClient.put(`/admin/careers/${id}`, data);
};

export const deleteCareer = (id) => {
    return apiClient.delete(`/admin/careers/${id}`);    
};

export default {
    getAll() {
        return apiClient.get('/admin/careers');
    },
};