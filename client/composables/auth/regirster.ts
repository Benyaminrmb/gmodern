import { useAuth } from "~/stores/auth";
export const useAuthRegister = async (register_form:any) => {
    const env_data = useRuntimeConfig();
    const use_auth = useAuth();
    return await $fetch("/api/register", {
        baseURL: env_data.public.apiBase,
        method: "POST",
        body: register_form,
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
    })
        .then((res:any) => {
            // @ts-ignore
            use_auth.setUser(res.data.user);
            const token = useCookie("token");
            token.value = res.data.token;
            use_auth.setToken(res.data.token);
            return res;
        })
        .catch((error) => {
            return error.data;
        });
};
