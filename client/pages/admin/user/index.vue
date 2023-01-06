<script setup>
import {useGetUsers} from '../../../composables/admin/user/useGetUsers'

definePageMeta({
  layout: 'admin',
  middleware: ['admin'],
})
useHead({
  title: 'لیست کاربران -',
})

let users = await useGetUsers()
console.log('users', users)
</script>

<template>
  <div class="overflow-x-auto w-full">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table
        v-if="users"
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
            <th scope="col" class="px-6 py-3">نام</th>
            <th scope="col" class="px-6 py-3">نقش</th>
            <th scope="col" class="px-6 py-3">عملیات</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="user in users.data"
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
              <div v-if="user.is_admin" class="">
                <svg
                  class="w-6 h-6 fill-red-500"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 448 512">
                  <!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path
                    d="M206.7 378.1c10.23 7.832 24.32 7.832 34.55 0C282.6 346.3 384 259.6 384 173.6C384 65.83 312.3 0 224 0C135.6 0 64 65.83 64 173.6C64 259.6 165.4 346.3 206.7 378.1zM240 236c0-33.13 26.88-60 60-60h24c6.625 0 12 5.375 12 12v8C336 229.1 309.1 256 276 256h-24C245.4 256 240 250.6 240 244V236zM112 196v-8C112 181.4 117.4 176 124 176h24C181.1 176 208 202.9 208 236v8C208 250.6 202.6 256 196 256h-24C138.9 256 112 229.1 112 196zM319.7 352.5c-20.72 20.3-41.57 37.69-58.92 51.03C250.2 411.6 237.2 416 224 416s-26.23-4.43-36.78-12.51c-17.33-13.33-38.17-30.7-58.88-50.99C57.07 355.2 0 413.4 0 485.3C0 500.1 11.94 512 26.66 512H421.3C436.1 512 448 500.1 448 485.3C448 413.4 390.9 355.2 319.7 352.5z" />
                </svg>
              </div>
              <div v-else class="">
                <svg
                  class="w-6 h-6 fill-black dark:fill-white"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 448 512">
                  <!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path
                    d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z" />
                </svg>
              </div>
              <div class="pl-3">
                <div class="text-base font-semibold">
                  {{ user.name }}
                </div>
                <div class="font-normal text-gray-500">
                  {{ user.email }}
                </div>
              </div>
            </th>
            <td class="px-6 py-4">
              {{ user.is_admin ? 'مدیریت' : 'کاربر معمولی' }}
            </td>
            <td class="px-6 py-4">
              <button
                disabled
                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                ویرایش کاربر
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
