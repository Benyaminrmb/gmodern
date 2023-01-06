export const useGetIndexPosts = async (page: Number|any) => {
    const env_data = useRuntimeConfig();
    await $fetch(`/api/get/posts?page=${page}`, {
        baseURL: env_data.public.apiBase,
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
    }).then((res:any) => {
        return res;
    });
    return true;
};
