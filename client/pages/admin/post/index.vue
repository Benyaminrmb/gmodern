<script setup>
import {useGetPosts} from '../../../composables/admin/post/useGetPosts'
import {useInfiniteScroll,useVirtualList} from '@vueuse/core'
const route = useRoute()
const router = useRouter()
let page = ref(route.query.page ? route.query.page : 1)

const el = ref(null)
let loading = ref(false)
definePageMeta({
  layout: 'admin',
  middleware: ['admin'],
})
useHead({
  title: 'لیست مقالات -',
})
loading.value = true
let posts = ref(await useGetPosts(page.value))
loading.value = false
useInfiniteScroll(
  el,
  async () => {
    loading.value = true
    page.value++
    const new_post = await useGetPosts(page.value)
    let temporary_post = posts.value.data.data
    loading.value = false
    temporary_post.push(...new_post.data.data)
  },
  {distance: 5}
)
</script>

<template>
  <div class="w-full flex flex-wrap gap-4">

    <div class="flex overflow-x-auto w-full">
      <div
        ref="el"
        class="relative h-[500px] overflow-x-auto shadow-md sm:rounded-lg">
        <table
          v-if="posts"
          class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
          <thead
            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="p-4">
                <div class="flex items-center">
                  <input
                    id="checkbox-all-search"
                    type="checkbox"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                  <label for="checkbox-all-search" class="sr-only"
                    >checkbox</label
                  >
                </div>
              </th>
              <th scope="col" class="px-6 py-3">id</th>
              <th scope="col" class="px-6 py-3">عنوان</th>
              <th scope="col" class="px-6 py-3">وضعیت</th>
              <th scope="col" class="px-6 py-3">مکان</th>
              <th scope="col" class="px-6 py-3">منبع</th>
              <th scope="col" class="px-6 py-3">عملیات</th>
            </tr>
          </thead>
          <tbody>
            <app-admin-post-item
              v-for="item in posts.data.data"
              :item="item" />
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
