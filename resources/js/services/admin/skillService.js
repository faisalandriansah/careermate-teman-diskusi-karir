import apiClient from "@/services/api";

export const getSkills = (page = 1) => {
    return apiClient.get(`/admin/skills?page=${page}`);
};

export const getSkill = (id) => {
    return apiClient.get(`/admin/skills/${id}`);
};

export const createSkill = (data) => {
    return apiClient.post("/admin/skills", data);
};

export const updateSkill = (id, data) => {
    return apiClient.put(`/admin/skills/${id}`, data);
};

export const deleteSkill = (id) => {
    return apiClient.delete(`/admin/skills/${id}`);
};
