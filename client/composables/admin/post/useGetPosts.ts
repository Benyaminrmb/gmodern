import {useAdminPosts} from '~/stores/admin/posts'
export const useGetPosts = async (page: Number) => {
  const env_data = useRuntimeConfig()
  const token = useCookie('token')
  const use_admin_posts = useAdminPosts()
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
        use_admin_posts.setPost(res.data.data)

      return res
    })
    .catch((e) => {
      console.log(e)
      return e
    })
  return data
}
