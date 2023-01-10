export const useGetIndexPosts = async (page: Number | any) => {
  const env_data = useRuntimeConfig()
  let data = null

  data = await $fetch(`/api/get/posts?page=${page}`, {
    baseURL: env_data.public.apiBase,
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      Accept: 'application/json',
    },
  })
    .then((res: any) => {
      return res
    })
    .catch((e) => {
      console.log(e)
      return e
    })
  return data
}
