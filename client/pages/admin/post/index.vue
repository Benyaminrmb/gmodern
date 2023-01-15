<script setup>
import {useGetPosts} from '../../../composables/admin/post/useGetPosts'
const route = useRoute()
const router = useRouter()
let page = ref(route.query.page ? route.query.page : 1)


definePageMeta({
  layout: 'admin',
  middleware: ['admin'],
})
useHead({
  title: 'لیست مقالات -',
})

let posts = await useGetPosts(page)
const changePage = async (new_page) => {
  router.push({
    query: {page: new_page},
  })
  posts = await useGetPosts(new_page)
}
</script>

<template>
  <div class="w-full flex flex-wrap gap-4">
    <div class="flex overflow-x-auto w-full">
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
            <app-admin-post-item v-for="item in posts.data.data" :item="item"/>
          </tbody>
        </table>
      </div>
    </div>
    <div class="flex flex-wrap w-full justify-center">
      <div class="btn-group">
        <button
          v-for="page in posts.data.links"
          v-html="page.label"
          @click="changePage(page.label)"
          :disabled="page.active || !page.url"
          class="btn"></button>
      </div>
    </div>
  </div>
</template>
