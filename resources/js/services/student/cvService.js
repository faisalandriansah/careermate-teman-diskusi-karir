import apiClient from "@/services/api";

export default {
    async uploadCV(file, onUploadProgress) {
        const formData = new FormData();
        formData.append("cv", file);

        const { data } = await apiClient.post("student/cv/upload", formData, {
            headers: { "Content-Type": "multipart/form-data" },
            onUploadProgress,
        });

        return data;
    },
};