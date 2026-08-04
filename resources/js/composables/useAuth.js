import { ref, computed } from "vue";
import api from "@/services/api";

const user = ref(null);
const isProfileComplete = ref(false);
const loading = ref(false);

export function useAuth() {
    async function fetchMe() {
        loading.value = true;
        try {
            const { data } = await api.get("/auth/me");
            user.value = data.data;
            isProfileComplete.value = data.is_profile_complete;
        } finally {
            loading.value = false;
        }
    }

    function setAuthAfterLogin(responseData) {
        user.value = responseData.user;
        localStorage.setItem("token", responseData.token);
    }

    function logout() {
        user.value = null;
        isProfileComplete.value = false;
        localStorage.removeItem("token");
    }

    return {
        user: computed(() => user.value),
        isProfileComplete: computed(() => isProfileComplete.value),
        loading: computed(() => loading.value),
        fetchMe,
        setAuthAfterLogin,
        logout,
    };
}
