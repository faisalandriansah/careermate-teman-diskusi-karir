import axios from "axios";
import {
    getCacheKey,
    getCached,
    setCache,
    clearCache,
} from "@/utils/requestCache";

const apiClient = axios.create({
    baseURL: "/api",

    headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
    },
});

const isCacheable = (config) => {
    if (!config.method || config.method.toLowerCase() !== "get") return false;
    if (config.cache === false) return false;
    const url = config.url || "";
    if (url.includes("/auth/me")) return false;
    if (url.includes("/notifications")) return false;
    return true;
};

apiClient.interceptors.request.use((config) => {
    const token = localStorage.getItem("token");

    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }

    if (config.method && config.method.toLowerCase() !== "get") {
        clearCache();
        return config;
    }

    if (isCacheable(config)) {
        const key = getCacheKey(config);
        const cached = getCached(key);

        if (cached) {
            config.adapter = () =>
                Promise.resolve({
                    data: cached.data,
                    status: cached.status,
                    statusText: "OK",
                    headers: {},
                    config,
                    request: {},
                });
        }
    }

    return config;
});

apiClient.interceptors.response.use(
    (response) => {
        const config = response.config;

        if (isCacheable(config)) {
            const key = getCacheKey(config);
            setCache(key, {
                data: response.data,
                status: response.status,
            });
        }

        return response;
    },
    (error) => {
        if (error.response?.status === 401) {
            localStorage.removeItem("token");
            localStorage.removeItem("user");

            window.location.href = "/login";
        }

        return Promise.reject(error);
    },
);

export default apiClient;
