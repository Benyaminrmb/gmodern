import { useAuth } from "~/stores/auth";
interface awd {
    dd: string;
}
export const useAuthLogin = async (login_form:any) => {
    const env_data = useRuntimeConfig();
    const use_auth = useAuth();
    return await $fetch("/api/login", {
        baseURL: env_data.public.apiBase,
        method: "POST",
        body: login_form,
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
