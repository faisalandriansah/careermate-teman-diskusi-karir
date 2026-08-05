import apiClient from "@/services/api";

export default {
    async uploadCV(file, onUploadProgress) {
        const formData = new FormData();
        formData.append("cv", file);

        const { data } = await apiClient.post("student/cv/upload", formData, {
            headers: { "Content-Type": "multipart/form-data" },
            onUploadProgress,
        });

        return data; // {message, data: CvFile}
    },

    async extract(cvFileId) {
        const { data } = await apiClient.post(`student/cv/${cvFileId}/extract`);
        return data;
    },

    async detectSkills(cvFileId) {
        const { data } = await apiClient.post(
            `student/cv/${cvFileId}/detect-skills`,
        );
        return data;
    },

    async matchCareer(analysisResultId) {
        const { data } = await apiClient.post(
            `student/analysis/${analysisResultId}/match-career`,
        );
        return data;
    },

    async generateRoadmap(analysisResultId) {
        const { data } = await apiClient.post(
            `student/analysis/${analysisResultId}/generate-roadmap`,
        );
        return data;
    },
};
