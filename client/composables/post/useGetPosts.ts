export const useGetPost = async (id: Number|String|String[]) => {
  const env_data = useRuntimeConfig()
  let data = null
  data = await $fetch(`/api/post/${id}`, {
    baseURL: env_data.public.apiBase,
    method: 'GET',
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
