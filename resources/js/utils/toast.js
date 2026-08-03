import { push } from "notivue";

export const notify = {
    success: (message) => push.success(message),
    error: (message) => push.error(message),
    warning: (message) => push.warning(message),
    info: (message) => push.info(message),

    async run(promise, { success, error = "Terjadi kesalahan, coba lagi." }) {
        try {
            const result = await promise;
            if (success) notify.success(success);
            return result;
        } catch (err) {
            const message = err?.response?.data?.message || error;
            notify.error(message);
            throw err;
        }
    },
};
