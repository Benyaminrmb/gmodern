import { usePosts } from "~/stores/posts";

export const useGetIndexPosts = async () => {
    const env_data = useRuntimeConfig();
    const use_posts = usePosts();
    await $fetch("/api/get/posts", {
        baseURL: env_data.public.apiBase,
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
    }).then((res) => {
        // @ts-ignore
        return use_posts.setIndexPosts(res.data);
    });
    return true;
};
