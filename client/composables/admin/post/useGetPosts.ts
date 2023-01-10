export const useGetPosts = async (page: Number) => {
  const env_data = useRuntimeConfig()
  const token = useCookie('token')
  let data = null

  data = await $fetch(`/api/admin/post?page=${page}`, {
    baseURL: env_data.public.apiBase,
    method: 'GET',

    headers: {
      'Content-Type': 'application/json',
      Accept: 'application/json',
      Authorization: `Bearer ${token.value}`,
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
