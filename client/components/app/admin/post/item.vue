<script setup lang="ts">
import {useUpdatePost} from '~/composables/admin/post/useUpdatePost'

let props = defineProps({
  item: {
    required: true,
    type: Object,
  },
})
let status = ref(props.item.status === 'active')
const updateStatus = async (post: {id: Number; status: String}) => {
  const result = await useUpdatePost(post.id, {
    status: status.value,
  })
  if (result.success) {
      status = ref(result.data.status === 'active')
  }
}
</script>
<template>
  <tr
    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
    <td class="w-4 p-4">
      <div class="flex items-center">
        <input
          id="checkbox-table-search-1"
          type="checkbox"
          class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
      </div>
    </td>
    <th
      scope="row"
      class="flex gap-4 items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
      <div class="pl-3">
        <div class="text-base font-semibold">
          {{ props.item.id }}
        </div>
      </div>
      <img
        class="w-12 h-10"
        :src="props.item.image.medium"
        :alt="props.item.title" />
    </th>
    <td class="px-6 py-4">
        <nuxt-link :to="`/post/${props.item.id}`">
      {{ props.item.title }}
        </nuxt-link>
    </td>
    <td class="px-6 py-4">
      {{ props.item.status }}
      <input
        v-model="status"
        @change="updateStatus(props.item)"
        type="checkbox"
        class="toggle toggle-success"
        :checked="props.item.status === 'active'" />
    </td>
    <td class="px-6 py-4">
      {{ props.item.position }}
    </td>

    <td
      scope="row"
      class="flex gap-4 items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
      <div class="pl-3">
        <div class="text-base">
          {{ props.item.source.source.name }}
        </div>
      </div>
      <img
        class="w-4"
        :src="props.item.source.source.icon"
        :alt="props.item.title" />
    </td>
    <td class="px-6 py-4">
      <button
        disabled
        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
        ویرایش مقاله
      </button>
    </td>
  </tr>
</template>
