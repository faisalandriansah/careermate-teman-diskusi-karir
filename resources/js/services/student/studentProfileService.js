import apiClient from "@/services/api";

export default {
    async getProfile() {
        const { data } = await apiClient.get("student/profile");
        return data;
    },

    async updateProfile(payload) {
        const { data } = await apiClient.put("student/profile", payload);
        return data;
    },

    async uploadPhoto(file) {
        const formData = new FormData();
        formData.append("photo", file);

        const { data } = await apiClient.post(
            "student/profile/photo",
            formData,
            {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            },
        );
        return data;
    },
};
