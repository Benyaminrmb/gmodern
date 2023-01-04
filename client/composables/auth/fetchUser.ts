import { useAuth } from "../../stores/auth";

export const useFetchUser = async () => {
    const env_data = useRuntimeConfig();
    const use_auth = useAuth();
    const token = useCookie("token");
    return await $fetch("/api/user", {
        baseURL: env_data.public.apiBase,
        method: "GET",
        headers: {
            Authorization: "Bearer " + token.value,
            "Content-Type": "application/json",
            Accept: "application/json",
        },
    })
        .then((res) => {
            // @ts-ignore
            use_auth.setUser(res.data);
            return res;
        })
        .catch((error) => {
            return error.data;
        });
};
