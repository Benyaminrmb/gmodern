export const useUpdatePost = async (post_id: Number, request_data: any) => {
  const env_data = useRuntimeConfig()
  const token = useCookie('token')
  let data = null

  data = await $fetch(`/api/admin/post/${post_id}`, {
    baseURL: env_data.public.apiBase,
    method: 'PUT',
    body: request_data,
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
