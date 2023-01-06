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
            <tr
              v-for="item in posts.data.data"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <td class="w-4 p-4">
                <div class="flex items-center">
                  <input
                    id="checkbox-table-search-1"
                    type="checkbox"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                  <label for="checkbox-table-search-1" class="sr-only"
                    >checkbox</label
                  >
                </div>
              </td>
              <th
                scope="row"
                class="flex gap-4 items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                <div class="pl-3">
                  <div class="text-base font-semibold">
                    {{ item.id }}
                  </div>
                </div>
                <img
                  class="w-12 h-10"
                  :src="item.image.medium"
                  :alt="item.title" />
              </th>
              <td class="px-6 py-4">
                {{ item.title }}
              </td>
              <td class="px-6 py-4">
                {{ item.status }}
              </td>
              <td class="px-6 py-4">
                {{ item.position }}
              </td>

              <td
                scope="row"
                class="flex gap-4 items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                <div class="pl-3">
                  <div class="text-base">
                    {{ item.source.source.name }}
                  </div>
                </div>
                <img
                  class="w-4"
                  :src="item.source.source.icon"
                  :alt="item.title" />
              </td>
              <td class="px-6 py-4">
                <button
                  disabled
                  class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                  ویرایش مقاله
                </button>
              </td>
            </tr>
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
