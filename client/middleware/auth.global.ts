import { useFetchUser } from "~/composables/auth/fetchUser";
// @ts-ignore
export default defineNuxtRouteMiddleware(async (to, from, nuxtApp) => {
    const token = useCookie("token");
    if (token.value) {
        // @ts-ignore
        const response = await useFetchUser();
    }
});
